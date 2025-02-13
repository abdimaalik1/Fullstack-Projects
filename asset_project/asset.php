<?php
    $documentName = "Assets";
    include("dashboard.php");
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
    if(!empty($_SESSION["a_update"])) {
        echo '
        <div class="alert alert-success alert-dismissible  show " style="margin: 1rem" role="alert">
            <strong>Updade!</strong> '.$_SESSION["a_update"].'.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        ';
        unset($_SESSION['a_update']);
    }
    if(!empty($_SESSION["a_delete"])) {
        echo '
        <div class="alert alert-success alert-dismissible  show " style="margin: 1rem" role="alert">
            <strong>Delete!</strong> '.$_SESSION["a_delete"].'.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        ';
        unset($_SESSION['a_delete']);
    }

       if(!empty($_SESSION["a_save"])) {
        echo '
         <div class="alert alert-success alert-dismissible  show " style="margin: 1rem" role="alert">
            <strong>Success!</strong>'.$_SESSION["a_save"].'.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        ';
        unset($_SESSION['a_save']);
    }
    if(!empty($_SESSION["invalid_token"])) {
        echo '
        <div class="alert alert-danger alert-dismissible  show " style="margin: 1rem" role="alert">
            <strong>Error!</strong> '.$_SESSION["invalid_token"].'.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        ';
        unset($_SESSION['invalid_token']);
    }
    if(!empty($_SESSION["empty_token"])) {
        echo '
        <div class="alert alert-danger alert-dismissible  show " style="margin: 1rem" role="alert">
            <strong>Error!</strong> '.$_SESSION["empty_token"].'.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        ';
        unset($_SESSION['empty_token']);
    }
?>
    <div class="cont">
        <div class="form-cont">
    <div class="card">
        <div class="card-header text-light" style="background-color: hsla(100,80%,60%,.8)">
            <h3>Add Asset</h3>
        </div>
        <div class="body py-2" style="background-color:hsl(100, 100%, 96%)">
            <form action="asset_check.php" method="post" class="px-2">
                <div class="row my-2">
                    <div class="col-md-6 col-lg-3 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-id-card"></i>
                            </span>
                            <input class="form-control" type="number" disabled name="d_id" placeholder="ID">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-user"></i>
                            </span>
                            <input class="form-control" type="text" name="a_name" required placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-table"></i>
                            </span>
                            <input class="form-control" type="text" name="a_category" placeholder="Enter Category" required>
                        </div>
                    </div>
                <div class="col-md-6 col-lg-3 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-calendar-days"></i>
                            </span>
                            <input class="form-control" type="date" name="a_date" required>
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
                                   $sql = "SELECT * FROM location_tb";
                                   $query = mysqli_query($conn,$sql);
                                   while($row = mysqli_fetch_assoc($query)) {
                                        echo '
                                            <option value="'.htmlspecialchars($row["ID"]).'">'.htmlspecialchars($row["NAME"]).'</option>
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
                                   $sql4 = "SELECT * FROM condition_tb";
                                   $query4 = mysqli_query($conn,$sql4);
                                   while($row = mysqli_fetch_assoc($query4)) {
                                        echo '
                                            <option value="'.htmlspecialchars($row["ID"]).'">'.htmlspecialchars($row["NAME"]).'</option>
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
                            <input class="form-control" type="text" name="a_assigned_to" required placeholder="Assigned To">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-chart-simple"></i>
                            </span>
                            <input class="form-control" type="text" name="a_note" required placeholder="Notes">
                            <!-- hidden token -->
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">
                        </div>
                    </div>
                </div>
                
                <!-- buttons -->
                <div class="row my-2">
                    <div class="col-sm-6 mb-2 mb-sm-0 my-sm-2">
                        
                        <button type="submit" name="submit" value="Save" class="btn btn-success d-block" style="width: 100%;">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span class="ps-1">Save</span>
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


    <!-- table -->
     <div class="table-cont">
        <?php
        // displaying table
        $sql2 = "SELECT asset_tb.ID, asset_tb.NAME, asset_tb.CATEGORY, asset_tb.DATE,location_tb.NAME AS LOCATION,condition_tb.NAME AS `CONDITION`, asset_tb.ASSIGNED_TO, asset_tb.NOTES
                FROM asset_tb 
                INNER JOIN location_tb on asset_tb.LOCATION_ID = location_tb.ID
                INNER JOIN condition_tb on asset_tb.CONDITION_ID = condition_tb.ID ORDER BY asset_tb.ID DESC";
        $query2 = mysqli_query($conn,$sql2);
       $num_rows = mysqli_num_rows($query2);
     if($num_rows > 0) {
        echo '
            <table class="tb-a">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>CATEGORY</th>
                    <th>CONDITION</th>
                    <th>LOCATION</th>
                    <th>ASSIGNED TO</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
';?>
<?php
                    while($row = mysqli_fetch_assoc($query2)) {
                        echo '
                            <tr>
                    <td data-title="ID">'.htmlspecialchars($row["ID"]).'</td>
                    <td data-title="NAME">'.htmlspecialchars($row["NAME"]).'</td>
                    <td data-title="CATEGORY">'.htmlspecialchars($row["CATEGORY"]).'</td>
                    <td data-title="CONDITION">'.htmlspecialchars($row["CONDITION"]).'</td>
                    <td data-title="LOCATION">'.htmlspecialchars($row["LOCATION"]).'</td>
                    <td data-title="ASSIGNED TO">'.htmlspecialchars($row["ASSIGNED_TO"]).'</td>
                    <td data-title="ACTION">
                       <a style="text-decoration:none" href="asset_update.php?a_id='.htmlspecialchars($row["ID"]).'"> <button class="btn btn-info">UPDATE</button> </a>
                       <a style="text-decoration:none" href="asset_delete.php?a_id='.htmlspecialchars($row["ID"]).'"> <button class="btn btn-danger">DELETE</button> </a>
                    </td>
                </tr>
                        ';
                    }
        echo'    
        </tbody>
        </table>';
        
     } else {
        echo '<p class="text-center">No Record Saved</p>';
     }
        ?>
        
     </div>
    </div>
<?php
    include("footer.php");
?>