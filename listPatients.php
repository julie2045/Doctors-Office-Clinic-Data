<!-- Programmer Name: 43 
     File lists the patients in database --> 

<?php
 include 'connecttodb.php';
?>

<?php
 // Default values for weight and height unit
 $weightUnit = "kg";
 $heightUnit = "metric";
 
 // Check if a weight unit was selected
 if (isset($_POST['weightUnit'])) {
	$weightUnit = $_POST['weightUnit']; // Get selected weight unit
 }

 // Check if a height unit was selected
 if (isset($_POST['heightUnit'])) {
        $heightUnit = $_POST['heightUnit']; // Get selected height unit
 }

 $query = "SELECT patient.*, doctor.firstname AS 'Doctor First Name', doctor.lastname AS 'Doctor Last Name' FROM patient LEFT JOIN doctor ON patient.treatsdocid = doctor.docid";
 
 if (isset($_POST['orderType'])){
	$whichOrder = $_POST["orderType"];

 	if ($whichOrder == "1") {
		$query .= " ORDER BY patient.lastname";
		echo "<h3>Patients ordered by last name ascending</h3>";
	}

 	elseif ($whichOrder == "2") {
		$query .= " ORDER BY patient.lastname DESC";
		echo "<h3>Patients ordered by last name descending</h3>";
	}

 	elseif ($whichOrder == "3") {
		$query .= " ORDER BY patient.firstname";
		echo "<h3>Patients ordered by first name ascending</h3>";
	}

 	elseif ($whichOrder == "4") {
		$query .= " ORDER BY patient.firstname DESC";
		echo "<h3>Patients ordered by first name descending</h3>";
	}
 }

 $result = mysqli_query($connection,$query);

 if (!$result) {
        die("databases query failed.");
 }

 // Display data in table format
 echo "<table border='1'>";
 echo "<tr>";
 echo "<th>OHIP</th>";
 echo "<th>First Name</th>";
 echo "<th>Last Name</th>";
 echo "<th>Weight (". strtoupper($weightUnit) .")</th>";
 echo "<th>Height (". ucfirst($heightUnit) .")</th>";
 echo "<th>Doctor First Name</th>";
 echo "<th>Doctor Last Name</th>";
 echo "</tr>";

 while ($row = mysqli_fetch_assoc($result)) {
 	// Convert weight if needed
        if ($weightUnit == 'lbs') {
            $weight = $row['weight'] * 2.20462; // Convert kg to lbs
        } 
	else {
            $weight = $row['weight']; // Use kg as is
        }

	// Convert height if needed
        if ($heightUnit == 'ft_inch') {
            $heightInFeet = $row['height'] * 3.28084;  // Convert meters to feet
            $feet = floor($heightInFeet);
            $inches = round(($heightInFeet - $feet) * 12);  // Convert remaining feet to inches
            $height = $feet . " ft " . $inches . " inches";
        } 
	else {
            $height = $row['height'] . " m";  // Metric (meters)
        }

	echo "<tr>";
	echo "<td>".$row['ohip']."</td>";
	echo "<td>".$row['firstname']."</td>";
	echo "<td>".$row['lastname']."</td>";
	echo "<td>".number_format($weight, 2)."</td>";
	echo "<td>".$height."</td>";
	echo "<td>".$row['Doctor First Name']."</td>";
	echo "<td>".$row['Doctor Last Name']."</td>";
	echo "</tr>";
 }

 echo "</table>";
 	
mysqli_free_result($result);
?>
