<?php
session_start();
include("conn.php");
$id = filter_input(INPUT_GET, 'l_id', FILTER_SANITIZE_NUMBER_INT);
$sql1 = "DELETE FROM location_tb WHERE ID = ?";
$stmt = mysqli_stmt_init($conn);

if(mysqli_stmt_prepare($stmt,$sql1)) {
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    $_SESSION["l_delete"] = "DELETED ONE RECORD";
    header("location: location.php");
}

?>