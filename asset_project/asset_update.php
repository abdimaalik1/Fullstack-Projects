<?php
    $documentName = "Update Asset";
    include("dashboard.php");
   
    $id = filter_input(INPUT_GET, 'a_id', FILTER_SANITIZE_NUMBER_INT);
    $check = $_GET['a_id'];
    $sql1 = "SELECT asset_tb.ID, asset_tb.NAME, asset_tb.CATEGORY, asset_tb.DATE,location_tb.NAME AS LOCATION,condition_tb.NAME AS `CONDITION`, asset_tb.ASSIGNED_TO, asset_tb.NOTES
                FROM asset_tb 
                INNER JOIN location_tb on asset_tb.LOCATION_ID = location_tb.ID
                INNER JOIN condition_tb on asset_tb.CONDITION_ID = condition_tb.ID  WHERE asset_tb.ID = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql1);
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // inserting record
    if(isset($_POST["submit"])) {
        $name = filter_input(INPUT_POST, 'a_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $category = filter_input(INPUT_POST, 'a_category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date = filter_input(INPUT_POST, 'a_date', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        $location = filter_input(INPUT_POST, 'a_location', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        $condition = filter_input(INPUT_POST, 'a_condition', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        $assigned_to = filter_input(INPUT_POST, 'a_assigned_to', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        $note = filter_input(INPUT_POST, 'a_note', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


        $sql3 = "UPDATE asset_tb SET NAME = ?, CATEGORY = ?, DATE = ?, LOCATION_ID = ?, CONDITION_ID = ?, ASSIGNED_TO = ?, NOTES = ? WHERE ID = ?";
    
        $stmt = mysqli_stmt_init($conn);
        if(mysqli_stmt_prepare($stmt,$sql3)) {
            mysqli_stmt_bind_param($stmt,"sssiissi",$name,$category,$date,$location,$condition,$assigned_to,$note,$id);
            mysqli_stmt_execute($stmt);
            $_SESSION["a_update"] = "UPDATED ONE RECORD.";
            header("location: asset.php");
    }
}
?>
    <div class="cont">
        <div class="form-cont">
    <div class="card">
        <div class="card-header text-light" style="background-color: hsla(100,80%,60%,.8)">
            <h3>Update Asset</h3>
        </div>
        <div class="body py-2" style="background-color:hsl(100, 100%, 96%)">
            <form action="#" method="post" class="px-2">
                <div class="row my-2">
                    <div class="col-md-6 col-lg-3 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-id-card"></i>
                            </span>
                            <input class="form-control" type="number" disabled name="d_id" placeholder="ID" value="<?php echo htmlspecialchars($row["ID"]) ?>">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-user"></i>
                            </span>
                            <input class="form-control" type="text" name="a_name" required placeholder="Enter Name" value="<?php echo htmlspecialchars($row["NAME"]) ?>">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-table"></i>
                            </span>
                            <input class="form-control" type="text" name="a_category" placeholder="Enter Category" required value="<?php echo htmlspecialchars($row["CATEGORY"]) ?>">
                        </div>
                    </div>
                <div class="col-md-6 col-lg-3 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-calendar-days"></i>
                            </span>
                            <input class="form-control" type="date" name="a_date" required value="<?php echo htmlspecialchars($row["DATE"]) ?>">
                        </div>
                    </div>
                    </div>
                    <div class="row my-2">
                    <div class="col-md-6 col-lg-3 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-building"></i>
                            </span>
                            <select class="form-select" name="a_location" id="">
                            <?php
                                   $sql = "SELECT * FROM location_tb WHERE NAME != ?";
                                   $stmt = mysqli_stmt_init($conn);
                                   mysqli_stmt_prepare($stmt,$sql);
                                   mysqli_stmt_bind_param($stmt,"s",$row["LOCATION"]);
                                   mysqli_stmt_execute($stmt);
                                   $result = mysqli_stmt_get_result($stmt);
                                   // trick ann u isticmaalay saan pin ugu qabto location uu horey u doortay
                                   echo '<option value="'.htmlspecialchars($row["ID"]).'" selected>'.htmlspecialchars($row["LOCATION"]).'</option>';
                                   while($row1 = mysqli_fetch_assoc($result)) {
                                        echo '
                                            <option value="'.htmlspecialchars($row1["ID"]).'">'.htmlspecialchars($row1["NAME"]).'</option>
                                        ';
                                   } 
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-fan"></i>
                            </span>
                            <select class="form-select" name="a_condition" id="">
                            <?php
                                   $sql = "SELECT * FROM condition_tb WHERE NAME != ?";
                                   $stmt = mysqli_stmt_init($conn);
                                   mysqli_stmt_prepare($stmt,$sql);
                                   mysqli_stmt_bind_param($stmt,"s",$row["CONDITION"]);
                                   mysqli_stmt_execute($stmt);
                                   $result = mysqli_stmt_get_result($stmt);
                                   // trick ann u isticmaalay saan pin ugu qabto condition uu horey u doortay
                                   echo '<option value="'.htmlspecialchars($row["ID"]).'" selected>'.htmlspecialchars($row["CONDITION"]).'</option>';
                                   while($row1 = mysqli_fetch_assoc($result)) {
                                        echo '
                                            <option value="'.htmlspecialchars($row1["ID"]).'">'.htmlspecialchars($row1["NAME"]).'</option>
                                        ';
                                   } 
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-user"></i>
                            </span>
                            <input class="form-control" type="text" name="a_assigned_to" required placeholder="Assigned To" value="<?php echo htmlspecialchars($row["ASSIGNED_TO"]) ?>">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-chart-simple"></i>
                            </span>
                            <input class="form-control" type="text" name="a_note" required placeholder="Notes" value="<?php echo htmlspecialchars($row["NOTES"]) ?>">
                        </div>
                    </div>
                </div>
                
                <!-- buttons -->
                <div class="row my-2">
                    <div class="col-sm-6 mb-2 mb-sm-0 my-sm-2">
                        
                        <button type="submit" name="submit" value="Save" class="btn btn-success d-block" style="width: 100%;">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span class="ps-1">UPDATE</span>
                        </button>
                    </div>
                    <div class="col-sm-6 mb-2 mb-sm-0 my-sm-2">
                        <button type="reset" class="btn btn-warning text-light" style="width: 100%;">
                        <i class="fa-solid fa-rotate-right"></i>
                        <span class="ps-1">Reset</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php
    include("footer.php");
?>