

<?php
    include("reciever_page.php");
    include("conn_db.php");

    $r_id = $_SESSION["r_id"];

    $sql = "SELECT * FROM receiver WHERE R_ID = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$r_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,td,th {
            border-bottom: 1px solid #222;
            border-collapse: collapse;
            /* font-weight: 200; */
        }
        table {
            width: 60vw;
            text-align: center;
        }
        table tr th {
            color: #fff;
            background-color: hsl(200,100%,50%);
            padding: .8rem 0;
            text-transform: uppercase;   
        }
        table tr td {
            padding: .5rem 0;
        }
        .f {
            background-color: #eee;
        }
        .blood-color {
            color: hsl(0,80%,60%);
        }
        .table-container {
            display: flex;
            justify-content: center; 
        }
        .form-cont {
            max-width: 500px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
        }
        form {
            width: 100%;
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
.blood-cont {
    width: 100%;
    border: 1px solid hsl(200,100%,30%);
    border-radius: .3em;
    padding: .8rem .5rem;
    background-color: white;
}
    </style>
</head>
<body>
<div class="form-cont">
    <form action="#" method="post" class="mt-3 mb-2">
    <div class="lab-inp-cont">
                            <label for="blood">Blood Groub:</label> <br>
                            <input hidden type="text" name="blood" value="<?php echo $row['R_BLOOD'] ?>">
                            <div class="blood-cont"><?php echo $row['R_BLOOD'] ?></div>
                        </div>
                <div class="lab-inp-cont">
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city" placeholder="Enter City Name">
                </div>
                <button type="submit" name="submit" value="Search" class="mt-2">Search</button>
            </form>
    </div>
<div class="table-container">
<?php
        if(isset($_POST["submit"])) {
            $blood = $_POST["blood"];
            $city = $_POST["city"];
            $available = "Available";

            $sql1 = "SELECT * FROM donor WHERE D_BLOOD = ? AND H_CITY = ? AND ACTION = ?";
            $stmt1 = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt1,$sql1);
            mysqli_stmt_bind_param($stmt1,"sss",$blood,$city,$available);
            mysqli_stmt_execute($stmt1);
            $result1 = mysqli_stmt_get_result($stmt1);
            if(mysqli_num_rows($result1) > 0) {
                echo '<table>
                    <tr>
                        <th>#</th>
                        <th>H.Name</th>
                        <th>H.Email</th>
                        <th>H.Phone</th>
                        <th>H.City</th>
                        <th>H.Address</th>
                        <th>H.Blood</th>
                        <th>Action</th>
                    </tr>';

                while($row1 = mysqli_fetch_assoc($result1)) {
                    echo '
            <tr>
                     <td>'.$row1["D_ID"].'</td>
                        <td>'.$row1["H_NAME"].'</td>
                        <td>'.$row1["H_EMAIL"].'</td>
                        <td>'.$row1["H_PHONE"].'</td>
                        <td>'.$row1["H_CITY"].'</td>
                        <td>'.$row1["H_ADDRESS"].'</td>
                        <td class="blood-color">'.$row1["D_BLOOD"].'</td>
            
                ';
                $sql2 = "SELECT * FROM request_tb WHERE D_ID = ? AND R_ID = ?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt,$sql2);
                mysqli_stmt_bind_param($stmt,"ii",$row1["D_ID"],$r_id);
                mysqli_stmt_execute($stmt);
                $result2 = mysqli_stmt_get_result($stmt);
                $row2 = mysqli_fetch_assoc($result2);
                $num_rows = mysqli_num_rows($result2);
                if($num_rows == 0) {
                    echo '
                    <td>
                        <a href="search_check.php?h_id='.$row1["H_ID"].'&d_id='.$row1["D_ID"].'"  class="btn btn-primary ">Request</a>
                    </td>
                    ';
                }else {
                    if($row2["ACTION"] == "Requested") {
                        echo '
                        <td>
                            <span class="btn btn-info text-white">Requested</span>
                        </td>
                            ';
                    }
                    elseif($row2["ACTION"] == "Rejected") {
                        echo '
                        <td>
                            <span class="btn btn-info text-white">Rejected</span>
                        </td>
                            ';
                    }
                    elseif($row2["ACTION"] == "Accepted") {
                        echo '
                        <td>
                            <span class="btn btn-info text-white">Accepted</span>
                        </td>
                            ';
                    }
                }
                echo '
                </tr> 
                ';
               }
               echo '</table>';
            } else {
                echo "No Result Found";
            }
        }

?>

</div>
</body>
</html>