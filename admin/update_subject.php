<?php
// Include your database connection file here
include '../connect.php';

// Check if the "updateBtn" parameter is provided in the POST request
if(isset($_POST['updateBtn'])) {
    // Check if other form data is also provided
    if(isset($_POST['subjectID']) && isset($_POST['updateCode']) && isset($_POST['updateName'])) {
        // Sanitize the input to prevent SQL injection
        $subjectID = mysqli_real_escape_string($con, $_POST['subjectID']);
        $updateCode = mysqli_real_escape_string($con, $_POST['updateCode']);
        $updateName = mysqli_real_escape_string($con, $_POST['updateName']);

        // Query to update subject details based on subjectID
        $query = "UPDATE tbl_subject SET subject_code = '$updateCode', subject_name = '$updateName' WHERE id = '$subjectID'";

        if(mysqli_query($con, $query)) {
            // If the query is successful, return success response
            $response = array(
                'status' => 'success',
                'message' => 'Subject updated successfully'
            );
            echo json_encode($response);
        } else {
            // If the query fails, return error response
            $response = array(
                'status' => 'error',
                'message' => 'Error updating subject: ' . mysqli_error($con)
            );
            echo json_encode($response);
        }
    } else {
        // If other form data is missing, return error response
        $response = array(
            'status' => 'error',
            'message' => 'Subject data is missing in the request'
        );
        echo json_encode($response);
    }
} else {
    // If "updateBtn" is not provided in the request, return error response
    $response = array(
        'status' => 'error',
        'message' => 'Update button not pressed'
    );
    echo json_encode($response);
}

// Close database connection
mysqli_close($con);
?>
