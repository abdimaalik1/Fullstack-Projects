<?php
$documentName = "Login | Logout";
?>
<?php
    include("dashboard.php");
?>
    <!-- table -->
    <div class="table-cont">
        <?php
        // displaying table
        $sql2 = "SELECT users_tb.NAME, users_tb.EMAIL, users_tb.USER_TYPE, system_tb.DATE, system_tb.ACTION FROM system_tb
        INNER JOIN users_tb ON system_tb.USER_ID = users_tb.ID";
        $query2 = mysqli_query($conn,$sql2);
       $num_rows = mysqli_num_rows($query2);
     if($num_rows > 0) {
        echo '
            <table class="tb-a">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ACTION</th>
                    <th>DATE</th>
                    <th>USER_TYPE</th>
                </tr>
            </thead>
            <tbody>
';
?>
<?php
                    while($row = mysqli_fetch_assoc($query2)) {
                        echo '
                            <tr>
                            <td data-title="NAME">'.$row["NAME"].'</td>
                            <td data-title="EMAIL">'.$row["EMAIL"].'</td>
                            <td data-title="ACTION">'.$row["ACTION"].'</td>
                            <td data-title="PHONE">'.$row["DATE"].'</td>
                            <td data-title="PHONE">'.$row["USER_TYPE"].'</td>
                </tr>
                        ';
                    }
        echo'    
        </tbody>
        </table>';
        
     } else {
        echo '<p class="text-center">No Record Saved</p>';
     }
        ?>
        
     </div>
<?php
    include("footer.php");
?>