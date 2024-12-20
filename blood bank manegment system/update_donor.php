






<?php
    session_start();
    include("conn_db.php");
    $d_id = $_GET["d_id"];
    if(empty($d_id)) {
        header("location: available_blood.php");
    }

   


    $requred = "";
    $phoneinvalid = "";
    $phonegreeter = "";

    

    if(isset($_POST["updatesubmit"])) {
        $d_name = $_POST["d_name"];
        $d_blood = $_POST["d_blood"];
        $d_email = $_POST["d_email"];
        $d_phone = $_POST["d_phone"];

        if(empty($d_name) || empty($d_blood) || empty($d_email) || empty($d_phone) ) {
            $requred = "All Feilds are required";
        } else {
            if(strlen($d_phone) < 7) {
                $phoneinvalid = "Phone number can't less then 7digits";
            } else {
                
                if(strlen($d_phone) > 15) {
                    $phonegreeter = "Phone number can't greeter then 15digits";
                }  else {
                    $sql2 = "UPDATE donor SET D_NAME = ?, D_BLOOD = ?, D_EMAIL = ?, D_PHONE = ? WHERE D_ID = ?";
                    $stmt1 = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt1,$sql2);
                    mysqli_stmt_bind_param($stmt1,"ssssi",$d_name,$d_blood,$d_email,$d_phone,$d_id);
                    mysqli_stmt_execute($stmt1);
                    header("location: available_blood.php");
                }
            }
           
        }
    }
?>
<?php
     include("hospital_page.php");
     $sql1 = "SELECT * FROM donor WHERE D_ID = ?";
     $stmt = mysqli_stmt_init($conn);
     mysqli_stmt_prepare($stmt,$sql1);
     mysqli_stmt_bind_param($stmt,"i",$d_id);
     mysqli_stmt_execute($stmt);
     $result1 = mysqli_stmt_get_result($stmt);
     $row = mysqli_fetch_assoc($result1);
     $d_blood = $row["D_BLOOD"];
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
.error {
    text-align: center;
    color: red;
}
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center text-primary mt-5">Update donor</h2>
<form action="#" method="post" class="mt-3 mb-2">
                <div class="lab-inp-cont">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="d_name" placeholder="Enter Donor Name" value="<?php echo $row["D_NAME"]  ?>">
                    
                </div>
                <div class="lab-inp-cont">
                            <label for="blood">Blood Groub:</label> <br>
                            <select name="d_blood"  id="blood">
                                <?php
                                    if($d_blood == "A+") {
                                        echo '<option selected value="A+">A+</option>';
                                    } else {
                                        echo '<option value="A+">A+</option>';
                                    }

                                    if($d_blood == "A-") {
                                        echo '<option selected value="A-">A-</option>';
                                    } else {
                                        echo '<option value="A-">A-</option>';
                                    }

                                    if($d_blood == "B+") {
                                        echo '<option selected value="B+">B+</option>';
                                    } else {
                                        echo '<option value="B+">B+</option>';
                                    }

                                    if($d_blood == "B-") {
                                        echo '<option selected value="B-">B-</option>';
                                    } else {
                                        echo '<option value="B-">B-</option>';
                                    }

                                    if($d_blood == "AB+") {
                                        echo '<option selected value="AB+">AB+</option>';
                                    } else {
                                        echo '<option value="AB+">AB+</option>';
                                    }

                                    if($d_blood == "AB-") {
                                        echo '<option selected value="AB-">AB-</option>';
                                    } else {
                                        echo '<option value="AB-">AB-</option>';
                                    }

                                    if($d_blood == "O+") {
                                        echo '<option selected value="O+">O+</option>';
                                    } else {
                                        echo '<option value="O+">O+</option>';
                                    }
                                    if($d_blood == "O-") {
                                        echo '<option selected value="O-">O-</option>';
                                    } else {
                                        echo '<option value="O-">O-</option>';
                                    }
                                ?>
                            </select>
                        </div>
                <div class="lab-inp-cont">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="d_email" placeholder="Enter Donor Email" value="<?php echo $row["D_EMAIL"]; ?>">         
                </div>
                <div class="lab-inp-cont">
                    <label for="phone">Phone:</label>
                    <input type="number" id="phone" name="d_phone" placeholder="Enter Donor Phone" value="<?php echo $row["D_PHONE"]; ?>">
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
                    ?>
                </div>
                <button type="submit" name="updatesubmit" value="update">Update</button>
            </form>
</div>
</body>
</html>