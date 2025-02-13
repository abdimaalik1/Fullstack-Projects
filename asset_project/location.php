<?php
$documentName = "Departments";
    include("dashboard.php");
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
    if(!empty($_SESSION["l_update"])) {
        echo '
        <div class="alert alert-success alert-dismissible  show " style="margin: 1rem" role="alert">
            <strong>Updade!</strong> '.$_SESSION["l_update"].'.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        ';
        unset($_SESSION['l_update']);
    }

    if(!empty($_SESSION["l_delete"])) {
        echo '
        <div class="alert alert-success alert-dismissible  show " style="margin: 1rem" role="alert">
            <strong>Delete!</strong> '.$_SESSION["l_delete"].'.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        ';
        unset($_SESSION['l_delete']);
    }

    if(!empty($_SESSION["l_save"])) {
        echo '
         <div class="alert alert-success alert-dismissible  show " style="margin: 1rem" role="alert">
            <strong>Success!</strong>'.$_SESSION["l_save"].'.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        ';
        unset($_SESSION['l_save']);
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
            <h3>Add Location</h3>
        </div>
        <div class="body py-2" style="background-color:hsl(100, 100%, 96%)">
            <form action="location_check.php" method="post" class="px-2">
                <div class="row my-2">
                    <div class="col-md-6 col-lg-4 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-id-card"></i>
                            </span>
                            <input class="form-control" type="number" disabled name="l_id" placeholder="ID">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-building"></i>
                            </span>
                            <input class="form-control" type="text" name="l_name" required placeholder="Enter Location Name">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-calendar-days"></i>
                            </span>
                            <input class="form-control" type="date" name="l_date" required>
                            <!-- hidden token -->
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"] ?>">
                        </div>
                    </div>
                </div>
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
        $sql2 = "SELECT * FROM location_tb ORDER BY ID DESC";
        $query2 = mysqli_query($conn,$sql2);
       $num_rows = mysqli_num_rows($query2);
     if($num_rows > 0) {
        echo '
            <table class="tb-a">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>REG DATE</th>
                    <th>ACTION</tr>
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
                    <td data-title="REG DATE">'.htmlspecialchars($row["DATE"]).'</td>
                    <td data-title="ACTION">
                        <a style="text-decoration:none" href="location_update.php?l_id='.htmlspecialchars($row["ID"]).'"> <button class="btn btn-info">UPDATE</button> </a>
                        <a style="text-decoration:none" href="location_delete.php?l_id='.htmlspecialchars($row["ID"]).'"><button class="btn btn-danger">DELETE</button> </a>
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
</body>
</html>
<?php
    include("footer.php");
?>