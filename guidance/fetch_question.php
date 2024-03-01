<?php
// Include your database connection file here
include '../connect.php';

// Check if formID is provided in the POST request
if(isset($_POST['questionID'])) {
    // Sanitize the input to prevent SQL injection
    $questionID = mysqli_real_escape_string($con, $_POST['questionID']);

    // Query to fetch form description and category ID based on formID
    $query = "SELECT question, evaluation_form_id FROM tbl_question WHERE id = '$questionID'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Prepare response array
        $response = array(
            'status' => 'success',
            'formID'=> $row['evaluation_form_id'],
            'question' => $row['question'],
        );

        // Return JSON response
        echo json_encode($response);
    } else {
        // If form not found, return error response
        $response = array(
            'status' => 'error',
            'message' => 'Question not found'
        );
        echo json_encode($response);
    }
} else {
    // If formID is not provided in the request, return error response
    $response = array(
        'status' => 'error',
        'message' => 'Question ID is missing in the request'
    );
    echo json_encode($response);
}
?>
