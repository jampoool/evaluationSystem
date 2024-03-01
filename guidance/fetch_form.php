<?php
// Include your database connection file here
include '../connect.php';

// Check if formID is provided in the POST request
if(isset($_POST['formID'])) {
    // Sanitize the input to prevent SQL injection
    $formID = mysqli_real_escape_string($con, $_POST['formID']);

    // Query to fetch form description and category ID based on formID
    $query = "SELECT form_description,form_no, category_id FROM tbl_evaluation_form WHERE id = '$formID'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Prepare response array
        $response = array(
            'status' => 'success',
            'formNo'=> $row['form_no'],
            'formDescription' => $row['form_description'],
            'categoryID' => $row['category_id']
        );

        // Return JSON response
        echo json_encode($response);
    } else {
        // If form not found, return error response
        $response = array(
            'status' => 'error',
            'message' => 'Form not found'
        );
        echo json_encode($response);
    }
} else {
    // If formID is not provided in the request, return error response
    $response = array(
        'status' => 'error',
        'message' => 'FormID is missing in the request'
    );
    echo json_encode($response);
}
?>
