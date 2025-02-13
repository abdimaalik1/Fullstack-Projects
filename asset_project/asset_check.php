<?php
session_start();
include("dashboard.php");
if(isset($_POST["submit"])) {
        if(isset($_SESSION["csrf_token"]) && isset($_POST["csrf_token"])) {
            if($_SESSION["csrf_token"] == $_POST["csrf_token"]) {
                $name = filter_input(INPUT_POST, 'a_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $category = filter_input(INPUT_POST, 'a_category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $date = filter_input(INPUT_POST, 'a_date', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
                $location = filter_input(INPUT_POST, 'a_location', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
                $condition = filter_input(INPUT_POST, 'a_condition', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
                $assigned_to = filter_input(INPUT_POST, 'a_assigned_to', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
                $note = filter_input(INPUT_POST, 'a_note', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        
                $sql3 = "INSERT INTO asset_tb (NAME,CATEGORY,DATE,LOCATION_ID,CONDITION_ID,ASSIGNED_TO,NOTES)
                VALUES (?,?,?,?,?,?,?)";
            
                $stmt = mysqli_stmt_init($conn);
                if(mysqli_stmt_prepare($stmt,$sql3)) {
                    mysqli_stmt_bind_param($stmt,"sssiiss",$name,$category,$date,$location,$condition,$assigned_to,$note);
                    mysqli_stmt_execute($stmt);

                    $_SESSION["a_save"] = "SAVED ONE RECORD";
                    header("location: asset.php");
                       
            }
            } else {
                // invalid token
                $_SESSION["invalid_token"] = "Invalid Token";
                header("location: asset.php");
            }
            
        } else {
            // empty_token
            $_SESSION["empty_token"] = "Token NOT Set";
                header("location: asset.php");
        }
    }
    ?>