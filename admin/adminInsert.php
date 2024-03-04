<?php
session_start();
include "../connect.php";

$response = array(); // Initialize a response array

if ($con->connect_error) {
    $response['status'] = 'error';
    $response['message'] = 'Failed to connect to the database: ' . $con->connect_error;
    echo json_encode($response);
    exit(); // Terminate script execution if connection fails
}

if(isset($_POST['save_changes'])) {
    date_default_timezone_set('Asia/Manila');
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $type = $_POST['type'];
    $department = $_POST['department'];
    $timestamp = date('Y-m-d H:i:s'); // Get current timestamp

    // Perform database insertion
    $insertQuery = "INSERT INTO user (`user-id`, email, password, type, department, date_created) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($insertQuery);
    
    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("ssssss", $user_id, $email, $password, $type, $department, $timestamp);
        
        // Execute the prepared statement
        if ($stmt->execute()) {
            // Insertion successful
            $response['status'] = 'success';
            $response['message'] = 'User added successfully';
        } else {
            // Insertion failed
            $response['status'] = 'error';
            $response['message'] = 'Failed to add user';
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Prepare statement failed
        $response['status'] = 'error';
        $response['message'] = 'Failed to prepare statement';
    }

    // Close the database connection
    $con->close();
} else {
    // Handle invalid request
    $response['status'] = 'error';
    $response['message'] = 'Invalid request';
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit();
?>
