


<?php
    include("conn_db.php");
    $d_id = $_GET["d_id"];

    $sql1 = "DELETE FROM donor WHERE D_ID = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql1);
    mysqli_stmt_bind_param($stmt,"i",$d_id);
    mysqli_stmt_execute($stmt);

    header("location: available_blood.php");






?>