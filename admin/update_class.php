<?php
include "../connect.php";

// Set the content type to JSON
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure that all required fields are present
    if (!isset($_POST['classID'], $_POST['classCode'], $_POST['className'], $_POST['instructorID'], $_POST['subjectID'])) {
        // Return an error response if any required fields are missing
        echo json_encode(array('status' => 'error', 'message' => 'Missing required fields'));
        exit;
    }

    // Extract data from the POST request
    $classID = $_POST['classID'];
    $classCode = $_POST['classCode'];
    $className = $_POST['className'];
    $instructorID = $_POST['instructorID'];
    $subjectID = $_POST['subjectID'];

    // Sanitize data to prevent SQL injection
    $classCode = mysqli_real_escape_string($con, $classCode);
    $className = mysqli_real_escape_string($con, $className);
    $instructorID = mysqli_real_escape_string($con, $instructorID); // Convert to integer
    $subjectID = mysqli_real_escape_string($con,$subjectID); // Convert to integer

    // Perform the update operation for class details
    $updateClassQuery = "UPDATE tbl_class SET class_code = '$classCode', class_name = '$className', instructor_id = $instructorID, subject_id = $subjectID WHERE id = $classID";
    $result = mysqli_query($con, $updateClassQuery);

    if ($result) {
        // Send a JSON response indicating success
        echo json_encode(array('status' => 'success'));
    } else {
        // Send a JSON response indicating failure
        echo json_encode(array('status' => 'error', 'message' => 'Error updating class details: ' . mysqli_error($con)));
    }

    // Close the database connection
    mysqli_close($con);
} else {
    // Invalid request method
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}
?>
