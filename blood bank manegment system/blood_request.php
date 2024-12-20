

<?php
session_start();
    include("hospital_page.php");
    include("conn_db.php");
    
    $h_id = $_SESSION["h_id"];
 
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
<div class="table-container">
  <?php
           $sql = "SELECT * FROM request_tb WHERE H_ID = ? ORDER BY RQ_ID DESC";
           $stmt = mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"i",$h_id);
           mysqli_stmt_execute($stmt);
           $result = mysqli_stmt_get_result($stmt);

           $num_rows = mysqli_num_rows($result);

        if($num_rows > 0) {
         echo '   <table>
            <tr>
                    <th>#</th>
                    <th>R.Name</th>
                    <th>R.Gender</th>
                    <th>R.Email</th>
                    <th>R.Phone</th>
                    <th>R.Blood</th>
                    <th>Action</th>
        
                </tr>';
        
        
                   while($row = mysqli_fetch_assoc($result)) {
                        echo '
                        <tr>
                    <td>'.$row["D_ID"].'</td>
                    <td>'.$row["R_NAME"].'</td>
                    <td>'.$row["R_GENDER"].'</td>
                    <td>'.$row["R_EMAIL"].'</td>
                    <td>'.$row["R_PHONE"].'</td>
                    <td class="blood-color">'.$row["R_BLOOD"].'</td>
                      ';
                      if($row["ACTION"] == "Requested") {
                            echo '
                                <td class="">
                                <a href="reject.php?d_id='.$row["D_ID"].'" class="btn btn-danger">Reject</a>
                                <a href="accept.php?d_id='.$row["D_ID"].'" class="btn btn-success">Accept</a>
                                </td>
                            ';
                      } elseif($row["ACTION"] == "Accepted") {
                            echo '
                            <td>
                            <span class="btn btn-success">Accepted</span>
                            </td>
                            ';
                      } elseif($row["ACTION"] == "Rejected") {
                            echo '
                            <td>
                                <span class="btn btn-danger">Rejected</span>
                            </td>
                                ';
                      }
               echo ' </tr>';
               
            }
            
            echo '</table>';
           
        } else {
            echo "There Is No Request";
        }

?>
   
</div>
</body>
</html>