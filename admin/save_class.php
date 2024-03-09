<?php
include "../connect.php";

header('Content-Type: application/json'); // Set the content type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the AJAX request
    $classCode = $_POST['classCode'];
    $className = $_POST['className'];
    $teacherId = $_POST['teacherId'];
    $subjectId = $_POST['subjectId'];

    // Perform database operations to insert the data

    // Example using MySQLi (replace with your database connection code)

    // Insert data into the tbl_class table
    $insertClassQuery = "INSERT INTO tbl_class (class_code, class_name, instructor_id, subject_id) VALUES ('$classCode', '$className', '$teacherId', '$subjectId')";

    if (mysqli_query($con, $insertClassQuery)) {
        // Send a JSON response indicating success
        echo json_encode(array('status' => 'success', 'message' => 'Data saved successfully!'));
    } else {
        // Send a JSON response indicating failure
        echo json_encode(array('status' => 'error', 'message' => 'Error: ' . $insertClassQuery . '<br>' . mysqli_error($con)));
    }

    // Close the database connection
    mysqli_close($con);
} else {
    // Invalid request method
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}
?>
