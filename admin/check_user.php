<?php
// Database connection
include "../connect.php";

// Get user ID and email from POST data
$user_id = $_POST['user_id'];
$email = $_POST['email'];

// Query to check if user ID already exists
$stmt_user_id = $con->prepare("SELECT COUNT(*) AS user_count FROM user WHERE `user-id` = ?");
$stmt_user_id->bind_param("s", $user_id);
$stmt_user_id->execute();
$result_user_id = $stmt_user_id->get_result();
$row_user_id = $result_user_id->fetch_assoc();

// Close statement
$stmt_user_id->close();

// Query to check if email already exists
$stmt_email = $con->prepare("SELECT COUNT(*) AS email_count FROM user WHERE email = ?");
$stmt_email->bind_param("s", $email);
$stmt_email->execute();
$result_email = $stmt_email->get_result();
$row_email = $result_email->fetch_assoc();

// Close statement
$stmt_email->close();

// Return JSON response indicating whether user ID or email already exists
$response = array();

if ($row_user_id['user_count'] > 0) {
    // If user ID already exists
    $response['exists_user_id'] = true;
    $response['message_user_id'] = 'User ID already exists.';
} else {
    // User ID is unique
    $response['exists_user_id'] = false;
}

if ($row_email['email_count'] > 0) {
    // If email already exists
    $response['exists_email'] = true;
    $response['message_email'] = 'Email already exists.';
} else {
    // Email is unique
    $response['exists_email'] = false;
}

echo json_encode($response);

// Close connection
$con->close();
?>
