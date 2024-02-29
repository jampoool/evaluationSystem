<?php
session_start();
include "../connect.php";

if ($con->connect_error) {
    echo "Failed to connect to the database: " . $con->connect_error;
    exit(); // Terminate script execution if connection fails
}

if(isset($_POST['save_changes'])) {
    
    date_default_timezone_set('Asia/Manila');
    $catDescription = $_POST['catDescription'];
    $user_ID = $_SESSION['user_id'];
    $timestamp = date('Y-m-d H:i:s'); // Get current timestamp

    // Perform database insertion
    $insertQuery = "INSERT INTO tbl_category (category_description, user_id, created_at) VALUES (?, ?, ?)";
    $stmt = $con->prepare($insertQuery);
    
    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("sis", $catDescription, $user_ID, $timestamp);
        
        // Execute the prepared statement
        if ($stmt->execute()) {
            // Insertion successful
            $response = array('status' => 'success', 'message' => 'Category added successfully');
        } else {
            // Insertion failed
            $response = array('status' => 'error', 'message' => 'Failed to add category');
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Prepare statement failed
        $response = array('status' => 'error', 'message' => 'Failed to prepare statement');
    }

    // Close the database connection
    $con->close();

    // Send JSON response
    echo json_encode($response);
    exit();
} else {
    // Handle invalid request
    $response = array('status' => 'error', 'message' => 'Invalid request');
    echo json_encode($response);
    exit();
}

?>
