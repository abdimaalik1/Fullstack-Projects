<?php
session_start();
if(isset($_COOKIE["taken"])) {
    header("location: front.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <!-- <link rel="stylesheet" href="sytle.css"> -->
    <link rel="stylesheet" href="botstrap_css/bootstrap.min.css">
    <link rel="stylesheet" href="font/all.min.css">
    <link rel="stylesheet" href="font/fontawesome.min.css">
    <style>
        .checkbox {
            accent-color: hsl(100,80%,60%,.8);
            transform: scale(1.3);
        }
    </style>
</head>
<body>
   <div class="error mx-5 pt-2">
   <?php
            if(!empty($_SESSION["incorrect"])) {
                echo '
                <div class="alert alert-danger alert-dismissible  show" role="alert">
                    <strong>Error!</strong> '.$_SESSION["incorrect"].'.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                ';
                unset($_SESSION["incorrect"]);
            }
        ?>
   </div>
    <div class="login-container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card mx-2" style="width: 100%; max-width: 450px;">
            <div class="card-header user" style="background-color: hsl(100,80%,60%,.8);">
                <h4 class="text-light py-3 text-center">LOGIN PAGE</h4>
            </div>
            <div class="body py-1">
                <form action="login_check.php" method="post" class="py-3 px-2">
                    <label for="" class="form-label pt-1">Email</label>
                    <div class="input-group py-1">
                        <span class="input-group-text">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <?php
                            if(!empty($_SESSION["u_email"])) {
                                echo '
                                    <input type="text" class="form-control" name="email" id="" required placeholder="Enter Your Email" value="'.$_SESSION["u_email"].'">
                                ';
                                unset($_SESSION["u_email"]);
                            }else {
                                echo '
                                <input type="text" class="form-control" name="email" id="" required placeholder="Enter Your Email">
                                ';
                            }
                        ?>
                    </div>
                    <label for="" class="form-label pt-1">Password</label>
                    <div class="input-group py-1">
                        <span class="input-group-text">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                            <input type="password" class="form-control" name="password" id="" placeholder="Enter Your Password">
                        </div>
                        <div class="m-2">
                        <input type="checkbox" class="checkbox" id="checkbox" name="remember"> 
                        <label for="checkbox" class="form-check-label">Remember Me</label>
                        </div>
                    <button type="submit" name="submit" value="Login" class="btn btn-primary mt-3" style="width: 100%;background-color: hsl(100,80%,60%,.8);border:1px solid hsl(100,80%,60%,.8);">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="bootstrap_js/bootstrap.bundle.min.js"></script>
</body>
</html>