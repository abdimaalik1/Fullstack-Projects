

<?php
    session_start();
    include("conn_db.php");

    $h_id = $_GET["h_id"];
    if(empty($h_id)) {
        header("location: available_blood.php");
    }

    $sql1 = "SELECT * FROM hospital WHERE H_ID = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql1);
    mysqli_stmt_bind_param($stmt,"i",$h_id);
    mysqli_stmt_execute($stmt);
    $result1 = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result1);

    $requred = "";
    $phoneinvalid = "";
    $phonegreeter = "";

    $bigimage = "";
    $imageerror = "";
    $filetype = "";

    if(isset($_POST["updatesubmit"])) {
        $h_name = $_POST["h_name"];
        $h_email = $_POST["h_email"];
        $h_phone = $_POST["h_phone"];
        $h_city = $_POST["h_city"];
        $h_address = $_POST["h_address"];

    
        $fileimage = $_FILES["file"];
        $imagename = $fileimage["name"];
        $imagetype = $fileimage["type"];
        $imagetmpname = $fileimage["tmp_name"];
        $imageerror = $fileimage["error"];
        $imagesize= $fileimage["size"];
    
        $fileext = explode(".",$imagename);
        $fileactualext = strtolower(end($fileext));
        $allowed = array("jpg","jpeg","png","webp");

        if(empty($h_name) || empty($h_email) || empty($h_phone) || empty($h_city) || empty($h_address)) {
            $requred = "All Feilds are required";
        } else {
            if(strlen($h_phone) < 7) {
                $phoneinvalid = "Phone number can't less then 7digits";
            } else {
                
                if(strlen($h_phone) > 15) {
                    $phonegreeter = "Phone number can't greeter then 15digits";
                }  else {
                    //
                        if($imagesize > 0) {
                            if(in_array($fileactualext,$allowed)) {
                                if($imageerror === 0) {
                                    if($imagesize <= 2000000) {
                                        $imagenewname = $imagename . uniqid("",true) . "." . $fileactualext;
                                        $imagedestination = "profile/". $imagenewname;
                        
                        
                                                $sql = "UPDATE hospital SET H_IMAGE = ? WHERE H_ID = ?";
                                                $stmt = mysqli_stmt_init($conn);
                                                    mysqli_stmt_prepare($stmt,$sql);
                                                    mysqli_stmt_bind_param($stmt,"si",$imagenewname,$h_id);
                                                    mysqli_stmt_execute($stmt);
                        
                                                    move_uploaded_file($imagetmpname,$imagedestination);
                                                   // unlink();

                                                $sql2 = "UPDATE hospital SET H_NAME = ?, H_EMAIL = ?, H_PHONE = ?, H_CITY = ?, H_ADDRESS = ? WHERE H_ID = ?";
                                                    $stmt1 = mysqli_stmt_init($conn);
                                                    mysqli_stmt_prepare($stmt1,$sql2);
                                                    mysqli_stmt_bind_param($stmt1,"sssssi",$h_name,$h_email,$h_phone,$h_city,$h_address,$h_id);
                                                    mysqli_stmt_execute($stmt1);
                                                    header("location: available_blood.php?upload=success");
                
                                    } else { 
                                        $bigimage = "Image is too big!";
                                        
                                    }
                                } else {
                                    $imageerror = "Image error";
                                }
                        
                            } else { 
                                $filetype = "You need to upload proper file type!";
                            }
                        } else {
                            $sql2 = "UPDATE hospital SET H_NAME = ?, H_EMAIL = ?, H_PHONE = ?, H_CITY = ?, H_ADDRESS = ? WHERE H_ID = ?";
                            $stmt1 = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmt1,$sql2);
                            mysqli_stmt_bind_param($stmt1,"sssssi",$h_name,$h_email,$h_phone,$h_city,$h_address,$h_id);
                            mysqli_stmt_execute($stmt1);
                            header("location: available_blood.php?upload=success");
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

<?php
include("hospital_page.php");

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
                    <input type="text" id="name" name="h_name" placeholder="Enter Hospital Name" value="<?php echo $row["H_NAME"]  ?>">
                </div>
                <div class="lab-inp-cont">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="h_email" placeholder="Enter Hospital Email" value="<?php echo $row["H_EMAIL"]; ?>">         
                </div>
                <div class="lab-inp-cont">
                    <label for="phone">Phone:</label>
                    <input type="number" id="phone" name="h_phone" placeholder="Enter Hospital Phone" value="<?php echo $row["H_PHONE"]; ?>">
                </div>
                <div class="lab-inp-cont">
                    <label for="city">city:</label>
                    <input type="text" id="city" name="h_city" placeholder="Enter Hospital city" value="<?php echo $row["H_CITY"]; ?>">
                </div>
                <div class="lab-inp-cont">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="h_address" placeholder="Enter Hospital address" value="<?php echo $row["H_ADDRESS"]; ?>">
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
                         elseif(!empty($bigimage)) {
                             echo '<p class="error"> '.$bigimage.' </p>';
                        }
                         elseif(!empty($imageerror)) {
                             echo '<p class="error"> '.$imageerror.' </p>';
                        }
                         elseif(!empty($filetype)) {
                             echo '<p class="error"> '.$filetype.' </p>';
                        }
                    
                    ?>
                </div>
    
                <button type="submit" name="updatesubmit" value="update">Update</button>
            </form>
</div>
</body>
</html>