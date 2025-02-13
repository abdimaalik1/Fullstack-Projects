<?php
session_start();
include("dashboard.php");
if(isset($_POST["submit"])) {
        if(isset($_SESSION["csrf_token"]) && isset($_POST["csrf_token"])) {
            if($_SESSION["csrf_token"] == $_POST["csrf_token"]) {
               
                $name = filter_input(INPUT_POST, 'e_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, 'e_email', FILTER_SANITIZE_EMAIL);
                $phone = filter_input(INPUT_POST, 'e_phone', FILTER_SANITIZE_NUMBER_INT);

                $sql3 = "INSERT INTO employee_tb (NAME,EMAIL,PHONE)
                VALUES (?,?,?)";
            
                $stmt = mysqli_stmt_init($conn);
                if(mysqli_stmt_prepare($stmt,$sql3)) {
                    mysqli_stmt_bind_param($stmt,"sss",$name,$email,$phone);
                    mysqli_stmt_execute($stmt);
                       
                    $_SESSION["e_save"] = "SAVED ONE RECORD";
                    header("location: employees.php");

                    }
                } else {
                    // invalid token
                    $_SESSION["invalid_token"] = "Invalid Token";
                    header("location: employees.php");
                }
        } else {
            // empty_token
            $_SESSION["empty_token"] = "Token NOT Set";
                header("location: employees.php");
        } 
            
        } 
    
    
    ?>