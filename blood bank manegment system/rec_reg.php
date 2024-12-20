

<?php
    session_start();
    include("conn_db.php");


    
    $_SESSION["r_empty"] = "";
    $_SESSION["r_emailtaken"] = "";
    $_SESSION["r_passinvalid"] = "";
    $_SESSION["r_phoneinvalid"] = "";
    $_SESSION["r_cityinvalid"] = "";
    $_SESSION["r_success"] = "";

    $_SESSION["name"] = ""; 
    $_SESSION["blood"] = ""; 
    $_SESSION["email"] = ""; 
    $_SESSION["password"] = ""; 
    $_SESSION["phone"] = ""; 
    $_SESSION["city"] = ""; 

    if(isset($_POST["submit"])) {
        $name = $_POST["name"];
        $blood = $_POST["blood"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $phone = $_POST["phone"];
        $city = $_POST["city"];
        $gender = $_POST["gender"];


        
        if(empty($name) || empty($email) || empty($password) || empty($phone) || empty($city)) {
            $_SESSION["r_empty"] = "All feilds are required";

            $_SESSION["name"] = $name; 
            $_SESSION["blood"] = $blood; 
            $_SESSION["email"] = $email; 
            $_SESSION["phone"] = $phone; 
            $_SESSION["city"] = $city; 

            header("location: receiver_register.php");
    } else {
        $sql = "SELECT * FROM receiver WHERE R_EMAIL = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $num_rows = mysqli_num_rows($result);
    if($num_rows > 0) {
        $_SESSION["name"] = $name; 
        $_SESSION["blood"] = $blood; 
        $_SESSION["email"] = $email; 
        $_SESSION["password"] = $password; 
        $_SESSION["phone"] = $phone; 
        $_SESSION["city"] = $city; 
        $_SESSION["r_emailtaken"] = "Email al-ready taken";
        header("location: receiver_register.php");
    } else {
       if(strlen($password) <  4) {
        $_SESSION["name"] = $name; 
        $_SESSION["blood"] = $blood; 
        $_SESSION["email"] = $email; 
        $_SESSION["password"] = $password; 
        $_SESSION["phone"] = $phone; 
        $_SESSION["city"] = $city; 
        $_SESSION["r_passinvalid"] = "Password can't less than 4dig/char";
        header("location: receiver_register.php");
       } else {
        if(strlen($phone) < 7) {
            $_SESSION["name"] = $name; 
            $_SESSION["blood"] = $blood; 
            $_SESSION["email"] = $email; 
            $_SESSION["password"] = $password; 
            $_SESSION["phone"] = $phone; 
            $_SESSION["city"] = $city; 
            $_SESSION["r_phoneinvalid"] = "Phone can't less than 7digits";
            header("location: receiver_register.php");
       } else {
            if(strlen($city) > 20) {
                $_SESSION["name"] = $name; 
                $_SESSION["blood"] = $blood; 
                $_SESSION["email"] = $email; 
                $_SESSION["password"] = $password; 
                $_SESSION["phone"] = $phone; 
                $_SESSION["city"] = $city; 
                $_SESSION["r_cityinvalid"] = "City can't greeter than 20chars";
                header("location: receiver_register.php");
            } else {
                     $sql = "INSERT INTO receiver (R_NAME,R_GENDER,R_BLOOD,R_EMAIL,R_PASSWORD,R_PHONE,R_CITY)
                            VALUES (?,?,?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt,$sql);
                    mysqli_stmt_bind_param($stmt,"sssssis",$name,$gender,$blood,$email,$password,$phone,$city);
                    mysqli_stmt_execute($stmt);
                    header("location: reciever_login.php");
            }
       }
    }
} 
      
        
    }
}
 


?>