<! Programmer Name: 43
   This file is for listing the patients when having a select form -->
<?php
 // Put the patients in database as options in select form
 include 'connecttodb.php';

 $query = "SELECT ohip, firstname, lastname FROM patient";
 $result = mysqli_query($connection, $query);

 if (!$result) {
	die("Database query failed.");
 }
 // Populate the dropdown with patient names and ohips
 while ($row = mysqli_fetch_assoc($result)) {
	echo '<option value="'.$row["ohip"].'">'.$row["firstname"].' '.$row["lastname"].'</option>';
 }

 mysqli_free_result($result);
 ?>
