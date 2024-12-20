

<?php
    session_start();
    include("conn_db.php");


    
    $_SESSION["empty"] = "";
    $_SESSION["emailtaken"] = "";
    $_SESSION["passinvalid"] = "";
    $_SESSION["phoneinvalid"] = "";
    $_SESSION["cityinvalid"] = "";
    $_SESSION["addressinvalid"] = "";
    $_SESSION["success"] = "";

    $_SESSION["name"] = ""; 
    $_SESSION["email"] = ""; 
    $_SESSION["password"] = ""; 
    $_SESSION["phone"] = ""; 
    $_SESSION["city"] = ""; 
    $_SESSION["address"] = ""; 
    
    
    if(isset($_POST["submit"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $phone = $_POST["phone"];
        $city = $_POST["city"];
        $address = $_POST["address"];

        if(empty($name) || empty($email) || empty($password) || empty($phone) || empty($city) || empty($address)) {
            
            $_SESSION["name"] = $name; 
            $_SESSION["email"] = $email; 
            $_SESSION["password"] = $password; 
            $_SESSION["phone"] = $phone; 
            $_SESSION["city"] = $city; 
            $_SESSION["address"] = $address;
            $_SESSION["empty"] = "All feilds are required";
            header("location: hospital_register.php");

        }
        else {

            $sql = "SELECT * FROM hospital WHERE H_EMAIL = ?";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt,$sql);
                    mysqli_stmt_bind_param($stmt,"s",$email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $num_rows = mysqli_num_rows($result);
                if($num_rows > 0) {
                    $_SESSION["name"] = $name; 
                    $_SESSION["email"] = $email; 
                    $_SESSION["password"] = $password; 
                    $_SESSION["phone"] = $phone; 
                    $_SESSION["city"] = $city; 
                    $_SESSION["address"] = $address;
                    $_SESSION["emailtaken"] = "Email al-ready taken";
                    header("location: hospital_register.php");
                }else {
                   if(strlen($password) <  4) {
                    $_SESSION["name"] = $name; 
                    $_SESSION["email"] = $email; 
                    $_SESSION["password"] = $password; 
                    $_SESSION["phone"] = $phone; 
                    $_SESSION["city"] = $city; 
                    $_SESSION["address"] = $address;
                    $_SESSION["passinvalid"] = "Password can't less than 4dig/char";
                    header("location: hospital_register.php");
                   } else {
                    if(strlen($phone) < 7) {
                        $_SESSION["name"] = $name; 
                        $_SESSION["email"] = $email; 
                        $_SESSION["password"] = $password; 
                        $_SESSION["phone"] = $phone; 
                        $_SESSION["city"] = $city; 
                        $_SESSION["address"] = $address;
                        $_SESSION["phoneinvalid"] = "Phone can't less than 7digits";
                        header("location: hospital_register.php");
                   } else {
                        if(strlen($city) > 20) {
                            $_SESSION["name"] = $name; 
                            $_SESSION["email"] = $email; 
                            $_SESSION["password"] = $password; 
                            $_SESSION["phone"] = $phone; 
                            $_SESSION["city"] = $city; 
                            $_SESSION["address"] = $address;
                            $_SESSION["cityinvalid"] = "City can't greeter than 20chars";
                            header("location: hospital_register.php");
                        } else {
                            if(strlen($address) > 20) {
                                $_SESSION["name"] = $name; 
                                $_SESSION["email"] = $email; 
                                $_SESSION["password"] = $password; 
                                $_SESSION["phone"] = $phone; 
                                $_SESSION["city"] = $city; 
                                $_SESSION["address"] = $address;
                                $_SESSION["addressinvalid"] = "Address can't greeter than 20chars";
                                header("location: hospital_register.php");
                            } else {
                                $sql = "INSERT INTO hospital (H_NAME,H_EMAIL,H_PASSWORD,H_PHONE,H_CITY,H_ADDRESS)
                                        VALUES (?,?,?,?,?,?)";
                                $stmt = mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($stmt,$sql);
                                mysqli_stmt_bind_param($stmt,"sssiss",$name,$email,$password,$phone,$city,$address);
                                mysqli_stmt_execute($stmt);
                                
                                header("location: hospital_login.php");
                            }
                }
            }
        }
    
    
    
    
        }
    }
    

    } 

?>