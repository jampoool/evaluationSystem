<?php
// Include your database connection file
include "../connect.php";

$response = array(); // Initialize a response array

// Check if the form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all necessary fields are provided
    if (isset($_POST['user_id'], $_POST['email'], $_POST['editType'], $_POST['editDepartment'])) {
        // Sanitize and get the data from the form
        $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $type = mysqli_real_escape_string($con, $_POST['editType']);
        $department = mysqli_real_escape_string($con, $_POST['editDepartment']);
        
        // Update query
        $sql = "UPDATE user SET email = '$email', type = '$type', department = '$department' WHERE `user-id` = '$user_id'";
        
        // Execute the update query
        if (mysqli_query($con, $sql)) {
            // If update successful, set success response
            $response['status'] = 'success';
            $response['message'] = 'User data updated successfully';
        } else {
            // If update fails, set error response
            $response['status'] = 'error';
            $response['message'] = 'Error updating user data: ' . mysqli_error($con);
        }
    } else {
        // If required fields are not provided, set error response
        $response['status'] = 'error';
        $response['message'] = 'Required fields are missing';
    }
} else {
    // If the form is not submitted with POST method, set error response
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
