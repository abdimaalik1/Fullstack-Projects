<?php
$documentName = "Profile";
include("dashboard.php");
$sql = "SELECT * FROM users_tb WHERE ID = ?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt,$sql);
mysqli_stmt_bind_param($stmt,"i",$u_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

?>
        <div class="cont-prof">
        <div class="card-prof">
            <div class="logo my-2">
                <img src="img/<?php echo htmlspecialchars($row["IMAGE"]) ?>" class="img-logo shadow p-2" style="width: 80px; border: 9999px;"  alt="">
            </div>

            <div class="user my-4 px-2">
                <h5 class="">UserID: <span class="lead txt">
                    <?php echo htmlspecialchars($row["ID"]); ?>
                </span></h5>
                <h5 class="">UserName: <span class="lead txt">
                <?php echo htmlspecialchars($row["NAME"]); ?>
                </span></h5>
                <h5 class="">UserEmail: <span class="lead txt">
                <?php echo htmlspecialchars($row["EMAIL"]); ?>
                </span></h5>
                <h5 class="">UserPhone: <span class="lead txt">
                <?php echo htmlspecialchars($row["PHONE"]); ?>
                </span></h5>
            </div>
        </div>
        </div>            
<?php
    include("footer.php");
?>