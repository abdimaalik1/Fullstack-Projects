<?php
session_start();
include("conn.php");
if(isset($_SESSION["u_id"])) {
    $u_id = $_SESSION["u_id"];
} else if( isset($_COOKIE["taken"])) {
    $taken = $_COOKIE["taken"];
    $sql = "SELECT U_ID FROM user_sessions WHERE TAKEN = ?";
    $stmt = mysqli_stmt_init($conn);
    if(mysqli_stmt_prepare($stmt,$sql)) {
        mysqli_stmt_bind_param($stmt,"s",$taken);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $u_id = htmlspecialchars($row["U_ID"]);
    }
    
}


// xarayn logout-ka uu samaynayo 
$action = "Logout";
date_default_timezone_set('Africa/Nairobi');
$date = date("l jS \of F Y h:i:s A");
$sql = "INSERT INTO system_tb (USER_ID,ACTION,DATE)
VALUES (?,?,?)";
$stmt = mysqli_stmt_init($conn);
if(mysqli_stmt_prepare($stmt,$sql)) {
    mysqli_stmt_bind_param($stmt,"iss",$u_id,$action,$date);
    mysqli_stmt_execute($stmt);

    // delete taken in database
    if(isset($_COOKIE["taken"])) {
        $taken = $_COOKIE["taken"];
        $sql = "DELETE FROM user_sessions WHERE TAKEN = ?";
            $stmt = mysqli_stmt_init($conn);
            if(mysqli_stmt_prepare($stmt,$sql)) {
                mysqli_stmt_bind_param($stmt,"s",$taken);
                mysqli_stmt_execute($stmt); 
                // delete taken in cookie
                setcookie("taken","", time() - 1);
            }
    }

    session_destroy();
    unset($_SESSION["u_id"]);
    header("location: login.php");
}





?>