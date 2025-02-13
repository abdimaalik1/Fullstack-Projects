<?php
    $documentName = "Update Location";
    include("dashboard.php");

    $id = filter_input(INPUT_GET, 'l_id', FILTER_SANITIZE_NUMBER_INT);


    $sql1 = "SELECT * FROM location_tb WHERE ID = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql1);
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if(isset($_POST["submit"])) {
        $name = filter_input(INPUT_POST, 'l_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date = filter_input(INPUT_POST, 'l_date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sql3 = "UPDATE location_tb SET NAME = ?, DATE = ? WHERE ID = ?";
    
        $stmt = mysqli_stmt_init($conn);
        if(mysqli_stmt_prepare($stmt,$sql3)) {
            mysqli_stmt_bind_param($stmt,"ssi",$name,$date,$id);
            mysqli_stmt_execute($stmt);
            $_SESSION["l_update"] = "UPDATED ONE RECORD";
            header("location: location.php");
        }
        
    }
?>
    <div class="cont">
        <div class="form-cont">
    <div class="card">
        <div class="card-header text-light" style="background-color: hsla(100,80%,60%,.8)">
            <h3>Update Location</h3>
        </div>
        <div class="body py-2" style="background-color:hsl(100, 100%, 96%)">
            <form action="#" method="post" class="px-2">
                <div class="row my-2">
                    <div class="col-md-6 col-lg-4 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-id-card"></i>
                            </span>
                            <input class="form-control" type="number" disabled name="l_id" placeholder="ID" value="<?php echo htmlspecialchars($row["ID"]) ?>">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-building"></i>
                            </span>
                            <input class="form-control" type="text" name="l_name" required placeholder="Enter Location Name"value="<?php echo htmlspecialchars($row["NAME"]) ?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-calendar-days"></i>
                            </span>
                            <input class="form-control" type="date" name="l_date" required value="<?php echo htmlspecialchars($row["DATE"]) ?>">
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
</div>
<?php
    include("footer.php");
?>