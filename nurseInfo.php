<!-- Programmer Name: 43
     This file shows information of the specified nurse -->

<!DOCTYPE html>
<html>
<head>
        <title>Nurse Information</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="mainmenu.css">
</head>
<body>
        <h2>Nurse Information</h2>
	<!-- Form to look at specified nurse -->
	<form action="nurseInfo.php" method="post">
        Select a nurse:  <br>
        <select name="nurseid">
        	<option value="">Select Nurse</option>
	 	<?php
 		 // Put the nurses in database as options in select form
 		include 'listNurse.php';
 		?>
        </select><br>

        <input type="submit" value="Select Nurse">
        </form>
	
	<?php
 	 include "connecttodb.php";
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         // Get the nurseid from nurse that was specified
         $nurseid = $_POST['nurseid'];

         // Check if nurse id was selected
         if (empty($nurseid)){
                die("You must select a nurse to view. Press back button to return to Nurse Information page.");
         }

	 // SQL query to look at nurse's supervisor
	 $supQuery = "SELECT n1.nurseid AS 'nurseid', n1.firstname AS 'nFirst', n1.lastname AS 'nLast', n2.firstname AS 'sFirst', n2.lastname AS 'sLast' FROM nurse AS n1 LEFT JOIN nurse AS n2 ON n1.reporttonurseid = n2.nurseid WHERE n1.nurseid = '$nurseid'";
	 
	 // SQL query to look at all the doctors the nurses worked for
	 $docQuery = "SELECT d.firstname AS 'dFirst', d.lastname AS 'dLast' FROM nurse n JOIN workingfor w ON n.nurseid = w.nurseid JOIN doctor d ON w.docid = d.docid WHERE n.nurseid = '$nurseid'";
	 
	 // SQL query to look at total hours given a nurse
	 $hourQuery = "SELECT SUM(hours) as 'totalHr' FROM workingfor, nurse WHERE nurse.nurseid=workingfor.nurseid AND nurse.nurseid = '$nurseid'"; 
	 
	 $hourResult = mysqli_query($connection,$hourQuery);
	 $supResult = mysqli_query($connection,$supQuery);
	 $docResult = mysqli_query($connection,$docQuery);	
         if (!$supResult || !$docResult) {
                 die("databases query failed.");
         }
	 // Displaying nurse's information of first name, last name, and supervisor name
         while ($row = mysqli_fetch_assoc($supResult)) {
                echo "<h3>Nurse: ".$row['nFirst']." ".$row['nLast']."</h3>";
		echo "Nurse ID: ".$row['nurseid'];
		// Check to see if supervisor is null
		$supervisorName = isset($row['sFirst']) && isset($row['sLast']) ? $row['sFirst']." ".$row['sLast'] : "No Supervisor";
		echo "<h4> Supervisor: </h4>".$supervisorName;
	 }
	// Listing the doctors the nurse worked with using docQuery
	echo "<h4>Doctors assigned to:</h4>";
        echo "<ul>";
	while ($item = mysqli_fetch_assoc($docResult)){
		echo "<li>".$item['dFirst']." ".$item['dLast']."</li>";	
	}
	echo "</ul>";
        
	// Showing total hours	
	while ($num = mysqli_fetch_assoc($hourResult)){
		// Check if hours are null
		$totalHours = isset($num['totalHr']) && $num['totalHr'] !== NULL ? $num['totalHr'] : "No Hours Recorded";
		echo "<h4>Total Hours: </h4>".$totalHours." hours";
        }

         mysqli_free_result($supResult);
	 mysqli_free_result($docResult);
 	}
	?>
<br></br>
<a href="mainmenu.php">Go back to main page</a>
</body>
</html>
