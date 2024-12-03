<!-- Programmer Name: 43
     This file shows the list of doctors without patients. -->

<!DOCTYPE html>
<html>
<head>
        <title>List of Doctors with No Patients</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="mainmenu.css">
</head>
<body>
        <h2>List of Doctors with No Patients</h2>
	<?php
 		include "connecttodb.php";
		$query = "SELECT docid, doctor.firstname AS 'docFirst', doctor.lastname AS 'docLast' FROM doctor LEFT JOIN patient on doctor.docid=patient.treatsdocid WHERE patient.firstname IS NULL ORDER BY doctor.firstname, doctor.lastname";
		$result = mysqli_query($connection,$query); 
		if (!$result) {
     			die("databases query failed.");
 		}
		echo "<ul>";
 		// Iterating through table produced from query
 		while ($row = mysqli_fetch_assoc($result)) {
			echo "<li> DocID: ".$row['docid']." | Dr. ".$row['docFirst']." ".$row['docLast']."</li>";
		}
		mysqli_free_result($result);
		echo "</ul>";
	?>

<a href="mainmenu.php">Go back to main page</a>
</body>
</html>              
