
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
            margin: 0 auto;
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
    
    <div class="cont">

    
<?php
$sql2 = "SELECT * FROM request_tb WHERE R_ID = ? ORDER BY RQ_ID DESC";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt,$sql2);
mysqli_stmt_bind_param($stmt,"i",$r_id);
mysqli_stmt_execute($stmt);
$result2 = mysqli_stmt_get_result($stmt);
$num_rows2 = mysqli_num_rows($result2);

if($num_rows2 > 0) {
    echo '<table>
    <tr>
        <th>#</th>
        <th>H.Name</th>
        <th>H.Email</th>
        <th>H.Phone</th>
        <th>H.City</th>
        <th>H.Address</th>
        <th>H.Blood</th>
        <th>Status</th>
    </tr>';

while($row2 = mysqli_fetch_assoc($result2)) {
    echo '
<tr>
     <td>'.$row2["D_ID"].'</td>
        <td>'.$row2["H_NAME"].'</td>
        <td>'.$row2["H_EMAIL"].'</td>
        <td>'.$row2["H_PHONE"].'</td>
        <td>'.$row2["H_CITY"].'</td>
        <td>'.$row2["H_ADDRESS"].'</td>
        <td class="blood-color">'.$row2["R_BLOOD"].'</td>
         <td>
            <span class="btn btn-info text-white">'.$row2["ACTION"].'</span>
        </td>
';
}
} else {
    echo '<p class="text-center text-primary mt-5">No Requested Blood';
}

?>

</div>
</body>
</html>