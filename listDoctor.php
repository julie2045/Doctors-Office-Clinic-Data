<!-- Programmer Name: 43 
     This file lists the doctors in the database -->

<?php
// doctorList.php
include 'connecttodb.php';  // Connect to the database

$query = "SELECT docid, firstname, lastname FROM doctor";  // SQL query to get all doctors
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Database query failed.");
}

// Populate the dropdown with doctor names and IDs
while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value="' . $row["docid"] . '">' . $row["firstname"] . ' ' . $row["lastname"] . '</option>';
}

mysqli_free_result($result);  // Free up memory
?>
