<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reciever Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url(img/m1.jpeg);
            background-position: center;
            background-size: cover;
        }
        .form-cont {
            width: 500px;
            background-color: hsla(0, 80%, 60%,.5);
            padding: 0.5rem 1rem;
        }
        form label {
            color: #000;
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
h2 {
    color:hsl(200,100%,50%);
}
        .error {
            text-align: center;
            color: red;
            font-size: 1.2rem;
        }
    </style>
    <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <h2>Reciever Login</h2>
    <div class="form-cont">
    <form action="rec_login.php" method="post" class="mt-3 mb-2">
                    
                        <div class="lab-inp-cont">
                            <label for="email">Email:</label>
                        <?php
                            if(!empty($_SESSION["email"])) {
                                $email = $_SESSION["email"];
                                echo '<input type="email" id="email" name="email" placeholder="Enter Receiver E-mail" value="'.$email.'">';
                            } else {
                                echo '<input type="email" id="email" name="email" placeholder="Enter Receiver E-mail">';
                            }
                        ?>
                        </div>
                        <div class="lab-inp-cont">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" placeholder="Enter Reciever Password">
                        </div>
                        <div>
                    <?php
                    if(!empty($_SESSION["emailorpasswrong"])) {
                        $wrongemail = $_SESSION["emailorpasswrong"];
                        echo "'.<p class='error'>$wrongemail</p>";
                        session_destroy();
                    } 
                    ?>
                </div>
                        <button type="submit" name="submit" value="Send">Send</button>
                    </form>
    </div>
    
</body>
</html>