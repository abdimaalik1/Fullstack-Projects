<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url(img/m1.jpeg);
            background-position: center;
            background-size: cover;
        }
        .reg-container {
            width: 100%;
        }
        h2 {
            text-align: center;
            color: hsl(200,100%,50%);
            padding: 1rem 0;
        }
        .form-container {
            /* width: 80%; */
            margin: 0 auto;
            background-color: hsla(0,80%,60%,.5);
            border-radius: .4em;
        }
        .content-cont {
            /* margin: 1rem 0; */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 1rem 0;
        }
        .content-cont img {
            width: 100px;
            border-radius: 50%

        }
    </style>
</head>
<body>
    <div class="reg-container row">
        <h2>Registration Page</h2>
        <div class="form-container col-10 col-sm-6 col-md-8 col-lg-4">
            <div class="content-cont">
                <img src="img\pexels-charliehelenrobinson-4531306.jpg" alt="">
                <a href="hospital_register.php" class="btn mt-2 btn-success">Register As a Hospital</a>
            </div>
            <div class="content-cont">
                <img src="img\download.jpeg" alt="">
                <a href="receiver_register.php" class="btn mt-2 btn-primary">Register As a Reciever</a>
            </div>
        </div>
    </div>
</body>
</html>