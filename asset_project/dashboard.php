<?php
    session_start();
    include("conn.php");
    if(isset($_SESSION["u_id"])) {
        $u_id = $_SESSION["u_id"];
    } else if(isset($_COOKIE["taken"])) {
        $taken = $_COOKIE["taken"];
        $sql = "SELECT U_ID,EXPIRE_AT FROM user_sessions WHERE TAKEN = ?";
        $stmt = mysqli_stmt_init($conn);
        if(mysqli_stmt_prepare($stmt,$sql)) {
            mysqli_stmt_bind_param($stmt,"s",$taken);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $num_rows = mysqli_num_rows($result);

            if($num_rows > 0) {
                if(time() < $row["EXPIRE_AT"]) {
                    $u_id = htmlspecialchars($row["U_ID"]);
                } else {
                    $sql = "DELETE FROM user_sessions WHERE TAKEN = ?";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt,$sql);
                    mysqli_stmt_bind_param($stmt,"s",$taken);
                    mysqli_stmt_execute($stmt);

                    header("location: login.php");
                }
            } else {
               setcookie("taken", "", time() - 1); 
               header("location: login.php");
            }
        }
    } else {
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $documentName ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="font/all.min.css">
    <link rel="stylesheet" href="font/fontawesome.min.css">
    <link rel="stylesheet" href="botstrap_css/bootstrap.min.css">
    <!--  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard">
        <div class="nav">
            <div class="logo">
                <a href="front.php" style="text-decoration: none;">
                <span>CITYCOT</span>
                </a>
            </div>
            <div class="profile" style="cursor: pointer;">
                <div class="my-2 mx-3 ">
                    <div class="dropdown">
                        <img src="img/default.png" class="dropdown-toggle" data-bs-toggle="dropdown" width="50px" alt="">
                      <ul class="dropdown-menu mt-2">
                        <li><a href="profile.php" class="dropdown-item">Profile</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a href="logout.php" class="dropdown-item">Logout</a></li>
                      </ul>
                    </div>
                   </div>
            </div>
        </div>
        <div class="side">
            <ul>
                <li>
                    <a href="front.php">
                    <span class="icon">
                        <i class="fa-solid fa-house"></i>
                    </span> 
                    <span class="list">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="asset.php">
                    <span class="icon">
                        <i class="fa-solid fa-gear"></i>
                    </span> 
                    <span class="list">Assets</span>
                    </a>
                </li>
                <li>
                    <a href="employees.php">
                    <span class="icon">
                        <i class="fa-solid fa-user"></i>
                    </span> 
                    <span class="list">Employees</span>
                    </a>
                </li>
                <li>
                    <a href="location.php">
                    <span class="icon">
                        <i class="fa-solid fa-building"></i>
                    </span> 
                    <span class="list">Locations</span>
                    </a>
                </li>
                <li class="bottom">
                    <a href="system.php">
                    <span class="icon">
                        <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
                    </span> 
                    <span class="list">System</span>
                    </a>
                </li>
                <li class="bottom2">
                    <a href="logout.php">
                    <span class="icon">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </span> 
                    <span class="list">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content">

       