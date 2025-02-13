<?php
    session_start();
    include("conn.php");

if(isset($_POST["submit"])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sql = "SELECT * FROM users_tb WHERE EMAIL = ?";
    $stmt = mysqli_stmt_init($conn);
    if(mysqli_stmt_prepare($stmt,$sql)) {
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $num_rows = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if($num_rows > 0) {
            if(password_verify($password,$row["PASSWORD"])) {
                // update session id
                session_regenerate_id(true);
                $u_id = htmlspecialchars($row["ID"]);
                $_SESSION["u_id"] = $u_id;

                if(isset($_POST["remember"])) {
                    $taken = bin2hex(random_bytes(32));
                    $expire_at = time() + (86400 * 30);
                    // inserting taken in database
                    $sql = "INSERT INTO user_sessions (U_ID, TAKEN, EXPIRE_AT)
                    VALUES(?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(mysqli_stmt_prepare($stmt,$sql)) {
                        mysqli_stmt_bind_param($stmt,"isi",$u_id,$taken,$expire_at);
                        mysqli_stmt_execute($stmt);
                        // inserting taken in cookie whith secure
                        setcookie("taken",$taken,[
                            'expires' => time() + (86400 * 30), // 30 days
                            'path' => '/',
                            'secure' => false, // localhost don't agree secure => true
                            'httponly' => true, // Ka hortagaya JavaScript inuu akhriyo
                            'samesite' => 'Strict' //Ka hortagaya CSRF attacks
                        ]);
                    }

                }
                 // xaraynta login-ka uu sameeyey 
                        $action = "Login";
                        date_default_timezone_set('Africa/Nairobi');
                        $date = date("l jS \of F Y h:i:s A");
                        $sql = "INSERT INTO system_tb (USER_ID,ACTION,DATE)
                        VALUES (?,?,?)";
                        $stmt = mysqli_stmt_init($conn);
                        if(mysqli_stmt_prepare($stmt,$sql)) {
                            mysqli_stmt_bind_param($stmt,"iss",$u_id,$action,$date);
                            mysqli_stmt_execute($stmt);
                        }
                header("location: front.php");
            } else {
                $_SESSION["incorrect"] = "Email Or Password Is Wrong";
                $_SESSION["u_email"] = $email;
                header("location: login.php");
            }
           
        } else {
            $_SESSION["incorrect"] = "Email Or Password Is Wrong";
            $_SESSION["u_email"] = $email;
            header("location: login.php");
        }
    }
}
?>