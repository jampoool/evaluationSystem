<?php
// Include your database connection file here
include '../connect.php';

// Check if subjectID is provided in the POST request
if(isset($_POST['subjectID'])) {
    // Sanitize the input to prevent SQL injection
    $subjectID = mysqli_real_escape_string($con, $_POST['subjectID']);

    // Query to delete the subject based on subjectID
    $query = "DELETE FROM tbl_subject WHERE id = '$subjectID'";

    if(mysqli_query($con, $query)) {
        // If the query is successful, return success response
        $response = array(
            'status' => 'success',
            'message' => 'Subject deleted successfully'
        );
        echo json_encode($response);
    } else {
        // If the query fails, return error response
        $response = array(
            'status' => 'error',
            'message' => 'Error deleting subject: ' . mysqli_error($con)
        );
        echo json_encode($response);
    }
} else {
    // If subjectID is not provided in the request, return error response
    $response = array(
        'status' => 'error',
        'message' => 'Subject ID is missing in the request'
    );
    echo json_encode($response);
}

// Close database connection
mysqli_close($con);
?>
