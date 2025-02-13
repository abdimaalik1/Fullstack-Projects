<?php
session_start();
include("dashboard.php");
if(isset($_POST["submit"])) {
        if(isset($_SESSION["csrf_token"]) && isset($_POST["csrf_token"])) {
            if($_SESSION["csrf_token"] == $_POST["csrf_token"]) {
               
                $name = filter_input(INPUT_POST, 'l_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $date = filter_input(INPUT_POST, 'l_date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $sql3 = "INSERT INTO location_tb (NAME,DATE)
                VALUES (?,?)";
            
                $stmt = mysqli_stmt_init($conn);
                if(mysqli_stmt_prepare($stmt,$sql3)) {
                    mysqli_stmt_bind_param($stmt,"ss",$name,$date);
                    mysqli_stmt_execute($stmt);
                       
                    $_SESSION["l_save"] = "SAVED ONE RECORD";
                    header("location: location.php");
                }
                       

            }   else {
                    //  invalid token
                $_SESSION["invalid_token"] = "Invalid Token";
                header("location: location.php");
            }
                } else {
                    // empty_token
                    $_SESSION["empty_token"] = "Token NOT Set";
                        header("location: location.php");
                } 
        } 
            
    
    
    
    ?>