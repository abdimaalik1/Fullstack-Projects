
<?php
    session_start();
    include("conn_db.php");
    $_SESSION["emailorpasswrong"] = "";
    
    $_SESSION["email"] = "";

    if(!empty($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM receiver WHERE R_EMAIL = ? AND R_PASSWORD = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"ss",$email,$password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if($num_rows > 0 ) {
        $_SESSION["r_id"] = $row["R_ID"];
        header("location: search_blood.php");
    } else {
        $_SESSION["email"] = $email;
        $_SESSION["emailorpasswrong"] = "Email or password wrong";
        header("location: reciever_login.php");
    }
}

?>