


<?php
    session_start();
    include("conn_db.php");
    $r_id = $_SESSION["r_id"];
    $h_id = $_GET["h_id"];
    $D_ID = $_GET["d_id"];
$sql1 = "SELECT * FROM receiver WHERE R_ID = ?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt,$sql1);
mysqli_stmt_bind_param($stmt,"i",$r_id);
mysqli_stmt_execute($stmt);
$result1 = mysqli_stmt_get_result($stmt);
$row1 = mysqli_fetch_assoc($result1);


$R_ID = $row1["R_ID"];
$R_NAME = $row1["R_NAME"];
$R_EMAIL = $row1["R_EMAIL"];
$R_PHONE = $row1["R_PHONE"];
$R_BLOOD = $row1["R_BLOOD"];
$R_GENDER = $row1["R_GENDER"];

$sql2 = "SELECT * FROM hospital WHERE H_ID = ?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt,$sql2);
mysqli_stmt_bind_param($stmt,"i",$h_id);
mysqli_stmt_execute($stmt);
$result2 = mysqli_stmt_get_result($stmt);
$row2 = mysqli_fetch_assoc($result2);

$H_ID = $row2["H_ID"];
$H_NAME = $row2["H_NAME"];
$H_EMAIL = $row2["H_EMAIL"];
$H_PHONE = $row2["H_PHONE"];
$H_CITY = $row2["H_CITY"];
$H_ADDRESS = $row2["H_ADDRESS"];

$sql3 = "INSERT INTO request_tb (H_ID,H_NAME,H_EMAIL,H_PHONE,H_CITY,H_ADDRESS,D_ID,R_ID,R_NAME,R_GENDER,R_EMAIL,R_PHONE,R_BLOOD)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt,$sql3);
mysqli_stmt_bind_param($stmt,"ississiisssis",$H_ID,$H_NAME,$H_EMAIL,$H_PHONE,$H_CITY,$H_ADDRESS,$D_ID,$R_ID,$R_NAME,$R_GENDER,$R_EMAIL,$R_PHONE,$R_BLOOD);
mysqli_stmt_execute($stmt);

$requested = "Requested";
$sql4 = "UPDATE donor SET ACTION = ? WHERE D_ID = ?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt,$sql4);
mysqli_stmt_bind_param($stmt,"si",$requested,$D_ID);
mysqli_stmt_execute($stmt);

header("location: requested_blood.php");

?>