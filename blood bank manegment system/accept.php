



<?php
include("conn_db.php");
$d_id = $_GET["d_id"];
$accepted = "Accepted";

$sql = "UPDATE request_tb SET ACTION = ? WHERE D_ID = ?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt,$sql);
mysqli_stmt_bind_param($stmt,"si",$accepted,$d_id);
mysqli_stmt_execute($stmt);

$taked = "Taked";
$sql1 = "UPDATE donor SET ACTION = ? WHERE D_ID = ?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt,$sql1);
mysqli_stmt_bind_param($stmt,"si",$taked,$d_id);
mysqli_stmt_execute($stmt);


header("location: blood_request.php");

?>