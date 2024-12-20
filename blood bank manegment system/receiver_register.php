<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reciever Registration</title>
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
    <h2>Reciever Registration</h2>
    <div class="form-cont">
    <form action="rec_reg.php" method="post" class="mt-3 mb-2">
                        <div class="lab-inp-cont">
                            <label for="name">Name:</label>
                            <?php
                                if(!empty($_SESSION["name"])) {
                                    $name = $_SESSION["name"];
                                    echo ' <input type="text" id="name" name="name" placeholder="Enter Reciever Name" value="'.$name.'">';
                                } else {
                                    echo '<input type="text" id="name" name="name" placeholder="Enter Reciever Name">'; 
                                }
                            ?>
                        </div>
                        <div class="lab-inp-cont">
                            <label for="blood">Blood Groub:</label> <br>
                            <select name="blood" id="blood">
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
                            <label for="gender">Gender:</label> <br>
                            <select name="gender" id="gender">
                                <option selected value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="lab-inp-cont">
                            <label for="email">Email:</label>
                            <?php
                                if(!empty($_SESSION["email"])) {
                                    $email = $_SESSION["email"];
                                    echo '<input type="email" id="email" name="email" placeholder="Enter Reciever E-mail" value="'.$email.'">';
                                } else {
                                    echo '<input type="email" id="email" name="email" placeholder="Enter Reciever E-mail">'; 
                                }
                            ?>
                            
                        </div>
                        <div class="lab-inp-cont">
                            <label for="password">Password:</label>
                            <?php
                                if(!empty($_SESSION["password"])) {
                                    $password = $_SESSION["password"];
                                    echo '<input type="password" id="password" name="password" placeholder="Enter Reciever Password" value="'.$password.'">';
                                } else {
                                    echo '<input type="password" id="password" name="password" placeholder="Enter Reciever Password">'; 
                                }
                            ?>
                        </div>
                        <div class="lab-inp-cont">
                            <label for="phone">Phone:</label>
                            <?php
                                if(!empty($_SESSION["phone"])) {
                                    $phone = $_SESSION["phone"];
                                    echo '<input type="number" id="phone" name="phone" placeholder="Enter Reciever Phone" value="'.$phone.'">';
                                } else {
                                    echo '<input type="number" id="phone" name="phone" placeholder="Enter Reciever Phone">'; 
                                }
                            ?>
                        </div>
                        <div class="lab-inp-cont">
                            <label for="city">City:</label>
                            <?php
                                if(!empty($_SESSION["city"])) {
                                    $city = $_SESSION["city"];
                                    echo ' <input type="text" id="city" name="city" placeholder="Enter Reciever City" value="'.$city.'">';
                                } else {
                                    echo ' <input type="text" id="city" name="city" placeholder="Enter Reciever City">'; 
                                }
                            ?>
                        </div>
                        <div>
                    <?php
                    if(!empty($_SESSION["r_empty"])) {
                        session_destroy();
                        $empty = $_SESSION["r_empty"];
                        echo "<p class='error'>$empty</p>";
                    } 
                    elseif(!empty($_SESSION["r_emailtaken"])) {
                        session_destroy();
                        $emailtaken = $_SESSION["r_emailtaken"];
                        echo "<p class='error'>$emailtaken</p>";
                    }
                    elseif(!empty($_SESSION["r_passinvalid"])) {
                        session_destroy();
                        $passinvalid = $_SESSION["r_passinvalid"];
                        echo "<p class='error'>$passinvalid</p>";
                    }
                    elseif(!empty($_SESSION["r_phoneinvalid"])) {
                        session_destroy();
                        $phoneinvalid = $_SESSION["r_phoneinvalid"];
                        echo "<p class='error'>$phoneinvalid</p>";
                    }
                    elseif(!empty($_SESSION["r_cityinvalid"])) {
                        session_destroy();
                        $cityinvalid = $_SESSION["r_cityinvalid"];
                        echo "'.<p class='error'>$cityinvalid</p>";
                    }
                    ?>
                </div>
                        <button type="submit" name="submit" value="Send">Send</button>
                    </form>
    </div>
    
</body>
</html>