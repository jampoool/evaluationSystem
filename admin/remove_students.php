<?php
include "../connect.php"; // Assuming this file contains your database connection
error_log(print_r($_POST, true));
// Check if classID is provided
if (isset($_POST['studentClassID'])) {
    // Retrieve the classID from the POST data
    $classID = $_POST['studentClassID'];

    // Prepare SQL statement to delete the student based on classID
    $sql = "DELETE FROM tbl_student_class WHERE id = ?";
    $stmt = $con->prepare($sql);

    // Bind parameters
    $stmt->bind_param("i", $classID);

    // Execute statement
    if ($stmt->execute()) {
        // Deletion successful
        $response = [
            'status' => 'success',
            'message' => 'Student removed successfully.'
        ];
    } else {
        // Error occurred during deletion
        $response = [
            'status' => 'error',
            'message' => 'An error occurred while deleting the student.'
        ];
    }

    // Close prepared statement
    $stmt->close();
} else {
    // If classID is not provided in the POST data
    $response = [
        'status' => 'error',
        'message' => 'classID parameter is missing.'
    ];
}

// Close database connection
$con->close();

// Send JSON response back to the client
echo json_encode($response);
?>
