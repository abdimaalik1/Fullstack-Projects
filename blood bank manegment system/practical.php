










<?php
    include("reciever_page.php");
    include("conn_db.php");
    $r_ir = $_GET["r_id"];
    if(empty($r_id)) {
        header("location: search_blood.php");
    }

    $sql1 = "SELECT * FROM receiver WHERE R_ID = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql1);
    mysqli_stmt_bind_param($stmt,"i",$r_id);
    mysqli_stmt_execute($stmt);
    $result1 = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result1);
    $r_gender = $row["R_GENDER"];
    $r_blood = $row["R_BLOOD"];

    $requred = "";
    $phoneinvalid = "";
    $phonegreeter = "";

    $_SESSION["bigimage"] = "";
    $_SESSION["imageerror"] = "";
    $_SESSION["filetype"] = "";

    if(isset($_POST["updatesubmit"])) {
        $r_name = $_POST["r_name"];
        $r_email = $_POST["r_email"];
        $r_phone = $_POST["r_phone"];
        $r_gender = $_POST["r_gender"];

    
        $fileimage = $_FILES["file"];
        $imagename = $fileimage["name"];
        $imagetype = $fileimage["type"];
        $imagetmpname = $fileimage["tmp_name"];
        $imageerror = $fileimage["error"];
        $imagesize= $fileimage["size"];
    
        $fileext = explode(".",$imagename);
        $fileactualext = strtolower(end($fileext));
        $allowed = array("jpg","jpeg","png","webp");

        if(empty($r_name) || empty($r_email) || empty($r_phone) ) {
            $requred = "All Feilds are required";
        } else {
            if(strlen($r_phone) < 7) {
                $phoneinvalid = "Phone number can't less then 7digits";
            } else {
                
                if(strlen($r_phone) > 15) {
                    $phonegreeter = "Phone number can't greeter then 15digits";
                }  else {
                    //
                        if($imagesize > 0) {
                            if(in_array($fileactualext,$allowed)) {
                                if($imageerror === 0) {
                                    if($imagesize <= 2000000) {
                                        $imagenewname = $imagename . uniqid("",true) . "." . $fileactualext;
                                        $imagedestination = "profile/". $imagenewname;
                        
                        
                                                $sql = "UPDATE receiver SET R_IMAGE = ? WHERE R_ID = ?";
                                                $stmt = mysqli_stmt_init($conn);
                                                    mysqli_stmt_prepare($stmt,$sql);
                                                    mysqli_stmt_bind_param($stmt,"si",$imagenewname,$r_id);
                                                    mysqli_stmt_execute($stmt);
                        
                                                    move_uploaded_file($imagetmpname,$imagedestination);

                                                $sql2 = "UPDATE receiver SET R_NAME = ?, R_GENDER = ?, R_EMAIL = ?, R_PHONE = ? WHERE R_ID = ?";
                                                    $stmt1 = mysqli_stmt_init($conn);
                                                    mysqli_stmt_prepare($stmt1,$sql2);
                                                    mysqli_stmt_bind_param($stmt1,"ssssi",$r_name,$r_gender,$r_email,$r_phone,$r_id);
                                                    mysqli_stmt_execute($stmt1);
                                                    header("location: search_blood.php?upload=success");
                
                                    } else { 
                                        $_SESSION["bigimage"] = "Image is too big!";
                                        
                                    }
                                } else {
                                    $_SESSION["imageerror"] = "Image error";
                                }
                        
                            } else { 
                                $_SESSION["filetype"] = "You need to upload proper file type!";
                            }
                        } else {
                            $sql2 = "UPDATE receiver SET R_NAME = ?, R_GENDER = ?, R_EMAIL = ?, R_PHONE = ? WHERE R_ID = ?";
                            $stmt1 = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmt1,$sql2);
                            mysqli_stmt_bind_param($stmt1,"ssssi",$r_name,$r_gender,$r_email,$r_phone,$r_id);
                            mysqli_stmt_execute($stmt1);
                            header("location: search_blood.php");
                        }
                    //
                    
                    // 
                    
                    // 
                }
            }
           
        }
        // 
      

            
           
       
        
        //
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update blood</title>
    <style>
form {
    max-width: 500px;
    margin: 0 auto;
}
form .lab-inp-cont {

}
form input,
form textarea,
form select {
    width: 100%;
    border: 1px solid hsl(200,100%,30%);
    border-radius: .3em;
    outline: none;
    padding: .8rem .5rem;
}
form textarea {
    min-height: 70px;
    max-height: 80px;
}
form input:focus,
form textarea:focus {
    border-color: hsl(200,100%,50%);
    box-shadow: 0 0 5px 0 hsl(200,100%,50%);
} 
form button {

    background-color: hsl(200,100%,50%);
    border: 1px solid hsl( 200,100%,30%);
    width: 100%;
    border-radius: .3em;
    cursor: pointer;
    font-size: inherit;
    padding: .8rem;
    color: #fff;
    margin-top: .5rem;
}
form button:hover,
form button:focus {
    background-color: hsl( 200,100%,30%);
    box-shadow: 0 0 5px 0 hsl(200,100%,30%);
}
.blood-cont {
    width: 100%;
    border: 1px solid hsl(200,100%,30%);
    border-radius: .3em;
    padding: .8rem .5rem;
    background-color: white;
}
.error {
    text-align: center;
    color: red;
}
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center text-primary mt-5">Update Profile</h2>
<form action="#" method="post" enctype="multipart/form-data" class="mt-3 mb-2">
                <div class="lab-inp-cont">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="r_name" placeholder="Enter Donor Name" value="<?php echo $row["R_NAME"]  ?>">
                </div>
                <div class="lab-inp-cont">
                            <label for="gender">Gender:</label> <br>
                            <select name="r_gender"  id="gender">
                                <?php
                                    if($r_gender == "Male") {
                                        echo '<option selected value="Male">Male</option>';
                                    } else {
                                        echo '<option value="Male">Male</option>';
                                    }
                                    if($r_gender == "Female") {
                                        echo '<option selected value="Female">Female</option>';
                                    } else {
                                        echo '<option value="Female">Female</option>';
                                    }
                                    ?>
                            </select>
                        </div>
                <div class="lab-inp-cont">
                            <label for="blood">Blood Groub:</label> <br>
                            <div class="blood-cont"><?php echo $row['R_BLOOD'] ?></div>
                        </div>
                <div class="lab-inp-cont">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="r_email" placeholder="Enter Donor Email" value="<?php echo $row["R_EMAIL"]; ?>">         
                </div>
                <div class="lab-inp-cont">
                    <label for="phone">Phone:</label>
                    <input type="number" id="phone" name="r_phone" placeholder="Enter Donor Phone" value="<?php echo $row["R_PHONE"]; ?>">
                </div>
                <div class="lab-inp-cont">
                <label for="phone">Image:</label>
                    <input type="file" name="file">
                </div>
                <div> 
                    <?php
                        if(!empty($requred)) {
                            echo '<p class="error"> '.$requred.' </p>';
                        } elseif(!empty($phoneinvalid)) {
                            echo '<p class="error"> '.$phoneinvalid.' </p>';
                        }
                         elseif(!empty($phonegreeter)) {
                             echo '<p class="error"> '.$phonegreeter.' </p>';
                        }
                         elseif(!empty($_SESSION["bigimage"])) {
                             echo '<p class="error"> '.$_SESSION["bigimage"].' </p>';
                        }
                         elseif(!empty($_SESSION["imageerror"])) {
                             echo '<p class="error"> '.$_SESSION["imageerror"].' </p>';
                        }
                         elseif(!empty($_SESSION["filetype"])) {
                             echo '<p class="error"> '.$_SESSION["filetype"].' </p>';
                        }
                    
                    ?>
                </div>
    
                <button type="submit" name="updatesubmit" value="update">Update</button>
            </form>
</div>
</body>
</html>