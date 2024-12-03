<!-- Programmer Name: 43
     This file shows the list of doctors with patients. -->

<!DOCTYPE html>
<html>
<head>
        <title>List of Doctors</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="mainmenu.css">
</head>
<body>
<h2>List of Doctors</h2>
<?php
 include "connecttodb.php";
 $query = "SELECT doctor.firstname AS 'docFirst', doctor.lastname AS 'docLast', patient.firstname AS 'patFirst', patient.lastname AS 'patLast' FROM doctor LEFT JOIN patient on doctor.docid=patient.treatsdocid WHERE patient.firstname IS NOT NULL ORDER BY doctor.firstname, doctor.lastname";
 $result = mysqli_query($connection,$query);
 $currDoctor = ""; // Keep track of current doctor
 if (!$result) {
     die("databases query failed.");
 }
 // Iterating through table produced from query
 while ($row = mysqli_fetch_assoc($result)) {
        // If the current doctor does not equal doctor's first name, then start a new heading
        if ($currDoctor != $row['docFirst']." ".$row['docLast']) {
                // Close if patients listed
                if (!empty($currDoctor)){
                        echo "</ul>";
                }

                // Update current doctor
                $currDoctor = $row['docFirst']." ".$row['docLast'];
                echo "<h3>Dr. ".$row['docFirst']." ".$row['docLast']."</h3>";
                echo "Patients:";
		echo "<ul>";
        }
        echo "<li>";
        echo $row['patFirst']." ".$row['patLast']."</li>";
 }
 // Close the last <ul> if there were doctors listed
 if (!empty($currDoctor)) {
     echo "</ul>";
 }
 mysqli_free_result($result);
?>
<a href="mainmenu.php">Go back to main page</a>
</body>
</html>
