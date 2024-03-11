<?php
include "../connect.php";

header('Content-Type: application/json'); // Set the content type to JSON

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you're receiving data like classID, classCode, className, teacherIDs, and subjectIDs
    $classID = $_POST['classID'];
    $classCode = $_POST['classCode'];
    $className = $_POST['className'];
    $teacherIDs = $_POST['teacherIDs'];
    $subjectIDs = $_POST['subjectIDs'];

    // Perform the update operation in your database
    // Example: Update tbl_class table
    $updateClassQuery = "UPDATE tbl_class SET class_code = '$classCode', class_name = '$className' WHERE id = $classID";
    $result = mysqli_query($con, $updateClassQuery);

    if ($result) {
        // Perform updates for associated teacher and subject IDs, if needed

        // Send a JSON response indicating success
        echo json_encode(array('status' => 'success'));
    } else {
        // Send a JSON response indicating failure
        echo json_encode(array('status' => 'error', 'message' => 'Error updating class details.'));
    }

    // Close the database connection
    mysqli_close($con);
} else {
    // Invalid request method
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}
?>
