<?php
    $documentName = "Dashboard";
    include("dashboard.php");
    include("conn.php");
    $sql = "SELECT * FROM asset_tb";
    $query = mysqli_query($conn,$sql);
    $num_rows = mysqli_num_rows($query);

    $sql2 = "SELECT * FROM employee_tb";
    $query2 = mysqli_query($conn,$sql2);
    $num_rows2 = mysqli_num_rows($query2);

    $sql3 = "SELECT * FROM location_tb";
    $query3 = mysqli_query($conn,$sql3);
    $num_rows3 = mysqli_num_rows($query3);

    $sql4 = "SELECT * FROM users_tb";
    $query4 = mysqli_query($conn,$sql4);
    $num_rows4 = mysqli_num_rows($query4);

?>

<div class="cont ps-3 pe-2 py-3 ">
    <div class="row-cont ">
        <div class="">
            <div class="cards card-1">
                <div class="card-icon">
                <i class="fa-solid fa-gear"></i>
                </div>
                <div class="card-num">
                    <?php
                        if($num_rows > 0) {
                            echo htmlspecialchars($num_rows);
                        } else {
                            echo 0;
                        }
                    ?>
                </div>
                <div class="card-name">
                    Assets
                </div>
            </div>
        </div>
        <div class="">
        <div class="cards card-2">
        <div class="card-icon">
        <i class="fa-solid fa-user"></i>
                </div>
                <div class="card-num">
                <?php
                        if($num_rows2 > 0) {
                            echo htmlspecialchars($num_rows2);
                        } else {
                            echo 0;
                        }
                    ?>
                </div>
                <div class="card-name">
                Employees
                </div>
        </div>
        </div>
        <div class="">
        <div class="cards card-3">
        <div class="card-icon">
        <i class="fa-solid fa-building"></i>
                </div>
                <div class="card-num">
                <?php
                        if($num_rows3 > 0) {
                            echo htmlspecialchars($num_rows3);
                        } else {
                            echo 0;
                        }
                    ?>
                </div>
                <div class="card-name">
                    Locations
                </div>
        </div>
        </div>
        <div class="">
        <div class="cards card-4">
        <div class="card-icon">
        <i class="fa-solid fa-user"></i>
                </div>
                <div class="card-num">
                <?php
                        if($num_rows4 > 0) {
                            echo htmlspecialchars($num_rows4);
                        } else {
                            echo 0;
                        }
                    ?>
                </div>
                <div class="card-name">
                    Users
                </div>
        </div>
        </div>
    </div>
</div>


<?php
    include("footer.php");
?>