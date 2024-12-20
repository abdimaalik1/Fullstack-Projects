

<?php
    session_start();
    include("conn_db.php");
    
    $h_id = $_SESSION["h_id"];

    $sql = "SELECT * FROM hospital WHERE H_ID = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$h_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $hosp_id = $row["H_ID"];
    $hosp_name = $row["H_NAME"];
    $hosp_email= $row["H_EMAIL"];
    $hosp_phone = $row["H_PHONE"];
    $hosp_city = $row["H_CITY"];
    $hosp_address = $row["H_ADDRESS"];

    $requred = "";
    $phoneinvalid = "";
    $phonegreeter = "";

    $name = "";
    $email = "";
    $phone = "";

    if(!empty($_POST["submit"])) {
        $d_name = $_POST["d_name"];
        $d_gender = $_POST["d_gender"];
        $d_blood = $_POST["d_blood"];
        $d_email = $_POST["d_email"];
        $d_phone = $_POST["d_phone"];

        if(empty($d_name) || empty($d_blood) || empty($d_email) || empty($d_phone) ) {
            $name = $d_name;
            $email = $d_email;
            $phone = $d_phone;
            $requred = "All Feilds are required";
        } else {
            if(strlen($d_phone) < 7) {
                $name = $d_name;
                $email = $d_email;
                $phone = $d_phone;
                $phoneinvalid = "Phone number can't less then 7digits";
            } else {
                if(strlen($d_phone) > 15) {
                    $name = $d_name;
                    $email = $d_email;
                    $phone = $d_phone;
                    $phonegreeter = "Phone number can't greeter then 15digits";
                } else {
                        $sql = "INSERT INTO donor (H_ID,H_NAME,H_EMAIL,H_PHONE,H_CITY,H_ADDRESS,D_NAME,D_GENDER,D_EMAIL,D_PHONE,D_BLOOD)
                                VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                        $stmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($stmt,$sql);
                        mysqli_stmt_bind_param($stmt,"ississsssis",$hosp_id,$hosp_name,$hosp_email,$hosp_phone,$hosp_city,$hosp_address,$d_name,$d_gender,$d_email,$d_phone,$d_blood);
                        mysqli_stmt_execute($stmt);
        
                        header("location: available_blood.php");
                    }
                }
           
        }
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
    <title>Add blood</title>
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
        <h2 class="text-center text-primary mt-5">Add donor</h2>
<form action="add_blood.php" method="post" class="mt-3 mb-2">
                <div class="lab-inp-cont">
                    <label for="name">Name:</label>
                    <?php
                    if(!empty($name)) {
                        echo '<input type="text" id="name" name="d_name" placeholder="Enter Donor Name" value="'.$name.'">';
                    } else {
                        echo '<input type="text" id="name" name="d_name" placeholder="Enter Donor Name">';
                    }
                    ?>
                </div>
                <div class="lab-inp-cont">
                            <label for="gender">Gender:</label> <br>
                            <select name="d_gender" id="gender">
                                <option selected value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                <div class="lab-inp-cont">
                            <label for="blood">Blood Groub:</label> <br>
                            <select name="d_blood"  id="blood">
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option selected value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                <div class="lab-inp-cont">
                    <label for="email">Email:</label>
                    <?php
                    if(!empty($email)) {
                        echo '<input type="email" id="email" name="d_email"  placeholder="Enter Donor E-mail" value="'.$email.'">';
                    } else {
                        echo '<input type="email" id="email" name="d_email"  placeholder="Enter Donor E-mail">';
                    }
                    ?>
                </div>
                <div class="lab-inp-cont">
                    <label for="phone">Phone:</label>
                    <?php
                    if(!empty($phone)) {
                        echo '<input type="number" id="phone" name="d_phone"  placeholder="Enter Donor Phone" value="'.$phone.'">';
                    } else {
                        echo '<input type="number" id="phone" name="d_phone"  placeholder="Enter Donor Phone">';
                    }
                    ?>
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
                <button type="submit" name="submit" value="Add">Add</button>
            </form>
</div>
</body>
</html>