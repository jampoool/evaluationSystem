<?php
// Include your database connection file
include "../connect.php";

// Fetch all students from the user table
$query = "SELECT * FROM user WHERE role = 'student'";
$result = mysqli_query($con, $query);

// Initialize an array to store student data
$students = array();

// Fetch student data and add it to the array
while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
}

// Close the database connection
mysqli_close($con);

// Return the student data as JSON
echo json_encode($students);
?>
