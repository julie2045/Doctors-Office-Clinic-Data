<!-- Programmer Name: 43
     This file lists all of the nurse for select bar -->

 <?php
 // Put the nurses in database as options in select form
 include 'connecttodb.php';

 $query = "SELECT nurseid, firstname, lastname, reporttonurseid FROM nurse";
 $result = mysqli_query($connection, $query);

 if (!$result) {
 	die("Database query failed.");
 }
 // Populate the dropdown with nurses names
 while ($row = mysqli_fetch_assoc($result)) {
 echo '<option value="'.$row["nurseid"].'">'.$row["firstname"].' '.$row["lastname"].'</option>';
 }

 mysqli_free_result($result);
?>
