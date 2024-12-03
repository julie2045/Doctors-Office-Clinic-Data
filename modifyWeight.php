<!-- Programmer Name: 43
     This file modfies the weight of a patient. The user can modify weight by inputting pounds or kg -->

<?php
 include "connecttodb.php";
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the OHIP number from patient, weight, answer for kg or lbs, to modify weight of patient
        $ohip = $_POST['pOhip'];
	$newWeight = $_POST['pWeight'];
	$unit = $_POST['weightType'];

        // Check if all fields were selected
        if (empty($ohip) || empty($newWeight) || empty($unit)){
                die("You must select a patient, insert new weight, and select weight unit. Press back button to select a patient to modify weight.");
        }
	
	// Check if the unit is lbs or kg; if lbs, convert to kg
	if ($unit == 'lbs'){
		$newWeight = $newWeight * 0.453592;
	}

        // SQL query to update weight of patient based on selected OHIP
        $query = "UPDATE patient SET weight = '$newWeight' WHERE ohip = '$ohip'";
	
        if (mysqli_query($connection, $query)) {
                echo "Patient with OHIP '$ohip' has weight changed successfully.";
        }

        else {
                echo "Error: " . mysqli_error($connection);
        }

        // Close the database connection
        mysqli_close($connection);
}
?>


<!DOCTYPE html>
<html>
<head>
        <title>Modify a Patient's Weight</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="mainmenu.css">
</head>
<body>
        <h2>Modify a Patient's Weight</h2>

        <!-- Select form to ask which patient and the new weight to give  -->
        <form action="modifyWeight.php" method="post">
        Select a Patient to Modify Weight:  <br>
        <select name="pOhip">
            <option value="">Select Patient</option>
            <?php
                // Put patients in database as select optoins
                include "allPatient.php";
            ?>
        </select><br>
	Weight: <input type="text" name="pWeight"> 
	<input type="radio" name="weightType" value="kg">Kilograms (kg)         
	<input type="radio" name="weightType" value="lbs">Pounds (lbs)<br>
	<input type="submit" value="Modify Patient">
        </form>
<a href="mainmenu.php">Go back to main page</a>
</body>
</html>

