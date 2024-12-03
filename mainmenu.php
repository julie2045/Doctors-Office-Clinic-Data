<!--Programmer Name: 43-->
<!--This file is the main page-->
<!DOCTYPE html>
<html>
<head>
      	<title>Doctors Office Clinic Data</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="mainmenu.css">
</head>

<body>

<?php
 include "connecttodb.php";
?>
<div class="heading-box">
	<h1>Doctors Office Clinic Data</h1>
</div>
<h2>Registered Patients</h2>

<!-- Form to select sorting patients and weight/height unit options --> 
<form action="mainmenu.php" method="post">
	<input type="radio" name="orderType" value="1">Order By Last Name (Ascending)<br>
	<input type="radio" name="orderType" value="2">Order By Last Name (Descending)<br>
	<input type="radio" name="orderType" value="3">Order By First Name (Ascending)<br>
	<input type="radio" name="orderType" value="4">Order By First Name (Descending)<br>

<!-- Select weight unit (pounds or kilograms) -->
	<label for="weightUnit">Select Weight Unit:</label>
	<select name="weightUnit" id="weightUnit">
		<option value="kg">Kilograms (kg)</option>
		<option value="lbs">Pounds (lbs)</option>
	</select>

<!-- Select height unit (Metric, Feet, Inches) -->
	<label for="heightUnit">Select Height Unit:</label>
	<select name="heightUnit" id="heightUnit">
        	<option value="metric">Metric (m)</option>
        	<option value="ft_inch">Feet and Inches (ft/inch)</option>
    	</select><br>

    	<input type="submit" value="Sort Patients and Change Units">
</form>

<!-- Link to different pages to modify/view information of database -->
<ul>
	<br><li><a href="addNewPatient.php">Add a New Patient</a></li>
	<li><a href="deletePatient.php">Delete an Existing Patient</a></li>
	<li><a href="modifyWeight.php">Modify Weight of Patient</a></li>
	<li><a href="noPatDoctors.php">List of Doctors with No Patients</a></li>
	<li><a href="allDoctors.php">List of Doctors and their Patients</a></li>
        <li><a href="nurseInfo.php">View Nurse Information</a></li><br>
</ul>

<?php
 include "listPatients.php";
 mysqli_close($connection);
?>

</body>
</html>
