
<?php
    session_start();
   include("hospital_page.php");
    include("conn_db.php");

    $h_id = $_SESSION["h_id"];
    $available = "Available";
    $sql = "SELECT * FROM donor WHERE H_ID = ? AND ACTION = ? ORDER BY D_ID DESC";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"is",$h_id,$available);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $num_rows = mysqli_num_rows($result);
    
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
    </style>
</head>
<body>

<div class="table-container">   `
    <?php

    if($num_rows > 0) {
        echo '
        <table>
        <tr>
        <th>#</th>
            <th>D.Name</th>
            <th>D.Gender</th>
            <th>D.Email</th>
            <th>D.Phone</th>
            <th>D.Blood</th>
            <th>Action</th>
        </tr>';

       
       
       
       while($row = mysqli_fetch_assoc($result)) {
        $_SESSION["d_id"] = $row["D_ID"];
        echo '<tr>
            <td>'.$row["D_ID"].'</td>
            <td>'.$row["D_NAME"].'</td>
            <td>'.$row["D_GENDER"].'</td>
            <td>'.$row["D_EMAIL"].'</td>
            <td>'.$row["D_PHONE"].'</td>
            <td class="blood-color">'.$row["D_BLOOD"].'</td>
            <td>
                <a href="update_donor.php?d_id='.$row["D_ID"].'" class="btn btn-info">Update</a>
                <a href="delete_donor.php?d_id='.$row["D_ID"].'" class="btn btn-danger">Delete</a>
            </td>
        </tr>';

       }
       
     echo '   </table>';

    } else {
        echo "No Available Blood";
    }

    ?>

</div>
</body>
</html>