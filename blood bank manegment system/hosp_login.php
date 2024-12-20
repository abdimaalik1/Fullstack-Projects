
<?php
    session_start();
    include("conn_db.php");
    $_SESSION["emailorpasswrong"] = "";
    
    $_SESSION["email"] = "";

    if(isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM hospital WHERE H_EMAIL = ? AND H_PASSWORD = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"ss",$email,$password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if($num_rows > 0 ) {
        $_SESSION["h_id"] = $row["H_ID"];
        header("location: available_blood.php");
    } else {
        $_SESSION["email"] = $email;
        $_SESSION["emailorpasswrong"] = "Email or password wrong";
        header("location: hospital_login.php");
    }
}

?>