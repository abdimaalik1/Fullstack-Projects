

<?php
session_start();
    include("hospital_page.php");

    include("conn_db.php");
    $h_id = $_SESSION["h_id"];
    $aPlus = "A+";
    $aMin = "A-";
    $bPlus = "B+";
    $bMin = "B-";
    $abPlus = "AB+";
    $abMin = "AB-";
    $oPlus = "O+";
    $oMin = "O-";
    $available = "Available";

   



?>
    
    <div class="cards row justify-content-center" style="gap: 1rem;">
    
    <div class="card-blood col-md-6 col-lg-4 col-xl-3">
        <div class="img-right">
            <img src="img/a+.png" alt="">
        </div>
        <p>
            <?php
                 $sql = "SELECT * FROM donor WHERE H_ID = ? AND D_BLOOD = ? AND ACTION = ?";
                 $stmt = mysqli_stmt_init($conn);
                 mysqli_stmt_prepare($stmt,$sql);
                 mysqli_stmt_bind_param($stmt,"iss",$h_id,$aPlus,$available);
                 mysqli_stmt_execute($stmt);
                 $result = mysqli_stmt_get_result($stmt);
                 $num_rows = mysqli_num_rows($result);
                 if($num_rows > 0) {
                     echo $num_rows;
                 } else {
                    echo 0;
                 }
            ?>
        </p>
    </div>
    <div class="card-blood col-md-6 col-lg-4 col-xl-3">
        <div class="img-right">
            <img src="img/a-.png" alt="" style="width: 45px; margin-top: .5rem;">
        </div>
        <p class="">
        <?php
                 $sql = "SELECT * FROM donor WHERE H_ID = ? AND D_BLOOD = ? AND ACTION = ?";
                 $stmt = mysqli_stmt_init($conn);
                 mysqli_stmt_prepare($stmt,$sql);
                 mysqli_stmt_bind_param($stmt,"iss",$h_id,$aMin,$available);
                 mysqli_stmt_execute($stmt);
                 $result = mysqli_stmt_get_result($stmt);                 
                 $num_rows = mysqli_num_rows($result);
                 if($num_rows > 0) {
                     echo $num_rows;
                 } else {
                    echo 0;
                 }
            ?>
        </p>
    </div>
    <div class="card-blood col-md-6 col-lg-4 col-xl-3">
        <div class="img-right">
            <img src="img/b+.png" alt="">
        </div>
        <p>
        <?php
                 $sql = "SELECT * FROM donor WHERE H_ID = ? AND D_BLOOD = ? AND ACTION = ?";
                 $stmt = mysqli_stmt_init($conn);
                 mysqli_stmt_prepare($stmt,$sql);
                 mysqli_stmt_bind_param($stmt,"iss",$h_id,$bPlus,$available);
                 mysqli_stmt_execute($stmt);
                 $result = mysqli_stmt_get_result($stmt);
                 $num_rows = mysqli_num_rows($result);
                 if($num_rows > 0) {
                     echo $num_rows;
                 } else {
                    echo 0;
                 }
            ?>
        </p>
    </div>
    <div class="card-blood col-md-6 col-lg-4 col-xl-3">
        <div class="img-right">
            <img src="img/b-.png" alt="">
        </div>
        <p>
        <?php
                 $sql = "SELECT * FROM donor WHERE H_ID = ? AND D_BLOOD = ? AND ACTION = ?";
                 $stmt = mysqli_stmt_init($conn);
                 mysqli_stmt_prepare($stmt,$sql);
                 mysqli_stmt_bind_param($stmt,"iss",$h_id,$bMin,$available);
                 mysqli_stmt_execute($stmt);
                 $result = mysqli_stmt_get_result($stmt); 
                $num_rows = mysqli_num_rows($result);
                 if($num_rows > 0) {
                     echo $num_rows;
                 } else {
                    echo 0;
                 }
            ?>
        </p>
    </div>
    <div class="card-blood col-md-6 col-lg-4 col-xl-3">
        <div class="img-right">
            <img src="img/ab+.png" alt="">
        </div>
        <p>
        <?php
                 $sql = "SELECT * FROM donor WHERE H_ID = ? AND D_BLOOD = ? AND ACTION = ?";
                 $stmt = mysqli_stmt_init($conn);
                 mysqli_stmt_prepare($stmt,$sql);
                 mysqli_stmt_bind_param($stmt,"iss",$h_id,$abPlus,$available);
                 mysqli_stmt_execute($stmt);
                 $result = mysqli_stmt_get_result($stmt);;
                 $num_rows = mysqli_num_rows($result);
                 if($num_rows > 0) {
                     echo $num_rows;
                 } else {
                    echo 0;
                 }
            ?>
        </p>
    </div>
    <div class="card-blood col-md-6 col-lg-4 col-xl-3">
        <div class="img-right">
            <img src="img/ab-.png" alt="">
        </div>
        <p>
        <?php
                 $sql = "SELECT * FROM donor WHERE H_ID = ? AND D_BLOOD = ? AND ACTION = ?";
                 $stmt = mysqli_stmt_init($conn);
                 mysqli_stmt_prepare($stmt,$sql);
                 mysqli_stmt_bind_param($stmt,"iss",$h_id,$abMin,$available);
                 mysqli_stmt_execute($stmt);
                 $result = mysqli_stmt_get_result($stmt);
                 $num_rows = mysqli_num_rows($result);
                 if($num_rows > 0) {
                     echo $num_rows;
                 } else {
                    echo 0;
                 }
            ?>
        </p>
    </div>
    <div class="card-blood col-md-6 col-lg-4 col-xl-3">
        <div class="img-right">
            <img src="img/o+.png" alt="">
        </div>
        <p>
        <?php
                 $sql = "SELECT * FROM donor WHERE H_ID = ? AND D_BLOOD = ? AND ACTION = ?";
                 $stmt = mysqli_stmt_init($conn);
                 mysqli_stmt_prepare($stmt,$sql);
                 mysqli_stmt_bind_param($stmt,"iss",$h_id,$oPlus,$available);
                 mysqli_stmt_execute($stmt);
                 $result = mysqli_stmt_get_result($stmt);
                 $num_rows = mysqli_num_rows($result);
                 if($num_rows > 0) {
                     echo $num_rows;
                 } else {
                    echo 0;
                 }
            ?>
        </p>
    </div>
    <div class="card-blood col-md-6 col-lg-4 col-xl-3">
        <div class="img-right">
            <img src="img/o-.png" alt="">
        </div>
        <p>
        <?php
                 $sql = "SELECT * FROM donor WHERE H_ID = ? AND D_BLOOD = ? AND ACTION = ?";
                 $stmt = mysqli_stmt_init($conn);
                 mysqli_stmt_prepare($stmt,$sql);
                 mysqli_stmt_bind_param($stmt,"iss",$h_id,$oMin,$available);
                 mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);                 
                $num_rows = mysqli_num_rows($result);
                 if($num_rows > 0) {
                     echo $num_rows;
                 } else {
                    echo 0;
                 }
            ?>
        </p>
    </div>
    </div>
<?php
    include("footer.php")
?>


