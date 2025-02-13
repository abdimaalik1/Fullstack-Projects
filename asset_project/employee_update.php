<?php
$documentName = "Update Employee";
    include("dashboard.php");
    $id = filter_input(INPUT_GET, 'e_id', FILTER_SANITIZE_NUMBER_INT);

    $sql1 = "SELECT * FROM employee_tb WHERE ID = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql1);
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if(isset($_POST["submit"])) {
        $name = filter_input(INPUT_POST, 'e_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'e_email', FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, 'e_phone', FILTER_SANITIZE_NUMBER_INT);
        $sql3 = "UPDATE employee_tb SET NAME = ?, EMAIL = ?, PHONE = ? WHERE ID = ?";
    
        $stmt = mysqli_stmt_init($conn);
        if(mysqli_stmt_prepare($stmt,$sql3)) {
            mysqli_stmt_bind_param($stmt,"sssi",$name,$email,$phone,$id);
            mysqli_stmt_execute($stmt);
            $_SESSION["e_update"] = "UPDATED ONE RECORD.";
            header("location: employees.php");
        }
        
    }
?>
    <div class="cont">
        <div class="form-cont">
    <div class="card">
        <div class="card-header text-light" style="background-color: hsla(100,80%,60%,.8)">
            <h3>Update Employee</h3>
        </div>
        <div class="body py-2" style="background-color:hsl(100, 100%, 96%)">
            <form action="#" method="post" class="px-2">
                <div class="row my-2">
                    <div class="col-md-6 col-lg-4 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-id-card"></i>
                            </span>
                            <input class="form-control" type="number" disabled name="e_id" placeholder="ID" value="<?php echo htmlspecialchars($row["ID"]) ?>">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-user"></i>
                            </span>
                            <input class="form-control" type="text" name="e_name" required placeholder="Enter Name" value="<?php echo htmlspecialchars($row["NAME"]) ?>">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input class="form-control" type="email" name="e_email" placeholder="Enter Email" required value="<?php echo htmlspecialchars($row["EMAIL"]) ?>">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 p-xs-2 mb-2 mb-sm-0 my-sm-2">
                        <div class="input-group">
                            <span class="input-group-text">
                            <i class="fa-solid fa-phone"></i>
                            </span>
                            <input class="form-control" type="phone" name="e_phone" placeholder="Enter Phone" required value="<?php echo htmlspecialchars($row["PHONE"]) ?>">
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

</div>
<?php
    include("footer.php");
?>