<?php
// Include your database connection file here
include '../connect.php';

// Check if subjectID is provided in the POST request
if(isset($_POST['classID'])) {
    // Sanitize the input to prevent SQL injection
    $classID = mysqli_real_escape_string($con, $_POST['classID']);

    // Query to delete the subject based on classID
    $query = "DELETE FROM tbl_class WHERE id = '$classID'";

    if(mysqli_query($con, $query)) {
        // If the query is successful, return success response
        $response = array(
            'status' => 'success',
            'message' => 'Class deleted successfully'
        );
        echo json_encode($response);
    } else {
        // If the query fails, return error response
        $response = array(
            'status' => 'error',
            'message' => 'Error deleting Class: ' . mysqli_error($con)
        );
        echo json_encode($response);
    }
} else {
    // If subjectID is not provided in the request, return error response
    $response = array(
        'status' => 'error',
        'message' => 'Class ID is missing in the request'
    );
    echo json_encode($response);
}

// Close database connection
mysqli_close($con);
?>
