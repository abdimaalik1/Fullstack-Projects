
<?php

    include("conn_db.php");
    $h_id = $_SESSION["h_id"];
    $sql = "SELECT * FROM hospital WHERE H_ID = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$h_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if(empty($_SESSION["h_id"])) {
        header("location: hospital_login.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/all.min.css">
    <link rel="stylesheet" href="font/fontawesome.min.css">
    <style>
        body{
            height: 100vh;
            overflow: hidden;
            margin: 0;
            padding: 0;
            background-color: rgb(225, 241, 255);
        }
        header {
            background-image: none;
        }
        nav {
            background-color: hsla(0, 80%, 60%,.5);
        }
        .flex-container {
            display: grid;
            grid-template-columns: 280px 1fr;
            grid-template-rows: 1fr;
        }
        aside {
            height: 91.5vh;
            overflow: auto;
            background-color: hsl(200,100%,30%);
        }
        .home-profile {
            border-bottom: 1px solid black;
        }
        .home-profile .profile-cont {
            display: flex;flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .home-profile .profile-cont img {
            width: 100px;
            border-radius: 50%;
            margin: .5rem 0;
        }
        .list-cont {
            margin-top: 2rem;
        }
        .list-cont ul {
            list-style: none;
        }
        .list-cont ul li {
            padding: .5rem 0;
            font-size: 1.2rem;
            /* border-top: 1px solid black;
            border-bottom: 1px solid black; */
        }
        .list-cont ul li a {
            color: #FFF;
            text-decoration: none;
        }
        .content-cont {
            height: 90vh;
            overflow: auto;
            overflow-x: hidden;
            margin: .5rem;
        }
        .card-blood {
            width: 300px;
            background-color: #FFF;
            border-radius: .3rem;
            box-shadow: 0 0 5px 0 #777;
        }
        .img-right {
            display: flex;
            justify-content: end;
        }
        .card-blood p {
            font-size: 1.5rem;
            /* padding: .5rem; */
        }
        .card-blood img {
            width: 80px;
            padding-bottom: .5rem;
        }
    </style>
</head>
<body>
    <header>
        <nav class="d-flex justify-content-between align-items-center">
            <div class="logo  p-3">
                <a href="home.php" class="text-white text-uppercase text-decoration-none">Blood donate</a>
            </div>
            <div class="logout  p-3">
                <a href="logout_hosp.php" class="btn btn-danger text-uppercase ">Logout</a>
            </div>
        </nav>
    </header>

    <div class="flex-container">
        <aside>
            <div class="side-cont">
                <div class="home-profile">
                    <div class="profile-cont">
                    <?php
                            echo '
                            <a href="update_profile_hosp.php?h_id='.$row['H_ID'].'"> <img src="profile/'.$row['H_IMAGE'].'" alt="Logo"> </a>
                            ';
                        ?>
                    <h2 class="text-danger text-center"><?php echo $row["H_NAME"] ?></h2>
                    </div>
                </div>
                <div class="list-cont">
                    <ul>
                        <li><a href="total_blood.php">
                            <span class="pe-1"><i class="fa-solid fa-store"></i></span>
                        Total bloods</a></li>
                        <li><a href="available_blood.php">
                            <span class="pe-1"><i class="fa-solid fa-door-open"></i></span>
                        Availabe blood sample</a></li>
                        <li><a href="add_blood.php">
                        <span class="pe-1"><i class="fa-solid fa-address-card"></i></span>    
                        Add Blood</a></li>
                        <li><a href="blood_request.php">
                        <span class="pe-1"><i class="fa-solid fa-code-pull-request"></i></span>    
                        Blood Request</a></li>
                    </ul>
                </div>
            </div>
        </aside>

        <div class="content-cont">

        
           
