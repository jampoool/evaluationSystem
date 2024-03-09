<?php
// Include your database connection file here
include '../connect.php';

// Check if subjectID is provided in the POST request
if(isset($_POST['subjectID'])) {
    // Sanitize the input to prevent SQL injection
    $subjectID = mysqli_real_escape_string($con, $_POST['subjectID']);

    // Query to fetch subject details based on subjectID
    $query = "SELECT id, subject_code, subject_name FROM tbl_subject WHERE id = '$subjectID'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Prepare response array
        $response = array(
            'status' => 'success',
            'subjectID' => $row['id'],
            'subjectCode' => $row['subject_code'],
            'subjectName' => $row['subject_name'],
        );

        // Return JSON response
        echo json_encode($response);
    } else {
        // If subject not found, return error response
        $response = array(
            'status' => 'error',
            'message' => 'Subject not found'
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
