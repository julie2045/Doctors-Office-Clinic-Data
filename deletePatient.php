<!-- Programmer Name: 43
     This file deletes a patient chosen by user. -->

<?php
 include "connecttodb.php";
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get the OHIP number from patient to be deleted
	$ohip = $_POST['pOhip'];
	
	// Check if OHIP was selected
	if (empty($ohip)){
		die("You must select a patient to delete. Press back button to return to Delete a Patient page.");
	}

 	// SQL query to delete patient based on selected OHIP
 	$query = "DELETE FROM patient WHERE ohip = '$ohip'";
 
 	if (mysqli_query($connection, $query)) {
        	echo "Patient with OHIP '$ohip' has been deleted successfully.";
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
        <title>Delete a Patient</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="mainmenu.css">
	<script>
        	function confirmDelete() {
            	return confirm("Are you sure you want to delete this patient? This action cannot be undone.");
        	}
   	 </script>
</head>
<body>
    	<h2>Delete a Patient</h2>

    	<!-- Select form to ask which patient to delete from database -->
    	<form action="deletePatient.php" method="post" onsubmit="confirmDelete()">
        Select a Patient to delete:  <br>
        <select name="pOhip">
            <option value="">Select Patient</option>
            <?php
		// Put patients in database as select options
		include "allPatient.php";
            ?>
        </select><br>

        <input type="submit" value="Delete Patient">
    	</form>
<a href="mainmenu.php">Go back to main page</a>
</body>
</html>

