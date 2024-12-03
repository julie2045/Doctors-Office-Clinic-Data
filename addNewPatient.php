<!-- Programmer Name: 43 
     This file will add a new patient when user inputs information in main menu -->

<?php
 include "connecttodb.php";
 
 // Check if the form is submitted 
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
	// Get the form data
	$ohip = $_POST['ohip'];
	$firstName = $_POST['pFirstName'];
	$lastName = $_POST['pLastName'];
	$weight = $_POST['pWeight'];
	$birthdate = $_POST['pBirthdate'];
	$height = $_POST['pHeight'];
	$doctorId = $_POST['doctorId'];
	
	// Valid input 
	if (empty($ohip) || empty($firstName) || empty($lastName) || empty($weight) || empty($birthdate) || empty($height) || empty($doctorId)) {
		die("All fields are required. Please go back and fill out the form.");
	}

	// Check if OHIP number is unique
    	$ohipQuery = "SELECT * FROM patient WHERE ohip = '$ohip'";
    	$result = mysqli_query($connection, $ohipQuery);

	if (mysqli_num_rows($result) > 0) {
		// OHIP number already exists, show error message
        	echo "Error: The OHIP number '$ohip' is already in use. Please go back and use a unique OHIP number.";
	}
	else {
		// OHIP is unique, proceed with inserting patient
		$insertQuery = "INSERT INTO patient (ohip, firstname, lastname, weight, birthdate, height, treatsdocid) VALUES ('$ohip', '$firstName', '$lastName', '$weight', '$birthdate', '$height', '$doctorId')";

		if (mysqli_query($connection, $insertQuery)) {
			echo "New patient added successfully.";
		}
		else {
			echo "Error: ".mysqli_error($connection);
		}
	} 
	
	// Free up the result and close the database connection
    	mysqli_free_result($result);
    	mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html>
<head>
    	<title>Add New Patient</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="mainmenu.css">
</head>
<body>
    <h2>Add a New Patient</h2>

    <!-- Form to add a new patient -->
    <form action="addNewPatient.php" method="post">
        OHIP: <input type="text" name="ohip"><br>
        First Name: <input type="text" name="pFirstName"><br>
        Last Name: <input type="text" name="pLastName"><br>
        Weight: <input type="text" name="pWeight"><br>
        Birth Date: <input type="text" name="pBirthdate"><br>
        Height: <input type="text" name="pHeight"><br>

        For which Doctor are they assigned to: <br>
        <select name="doctorId">
            <option value="">Select Doctor</option>
            <?php
            // Include the doctor list dynamically
            include 'listDoctor.php';
            ?>
        </select><br>

        <input type="submit" value="Add New Patient">
    </form>

 <a href="mainmenu.php">Go back to main page</a>
</body>
</html>
