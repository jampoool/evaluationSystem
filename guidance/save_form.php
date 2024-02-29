<?php
// Include your database connection file
include "../connect.php";
session_start();

// Check if the form data is submitted
if (isset($_POST["save_changes"])) {
    date_default_timezone_set('Asia/Manila');
    $userID= $_SESSION['user_id'];
    $formNo = $_POST['addFormNo']; // Assuming you have an input field with id "addCategoryID" in your modal
    $formCategory = $_POST['categoryForm']; // Assuming you have an input field with id "addCategoryID" in your modal
    $formDescription = $_POST['addform']; // Assuming you have an input field with id "addform" in your modal
    $timestamp = date('Y-m-d H:i:s'); // Get current timestamp
    // Perform any necessary validation or sanitization here

    // Perform database insertion
    $insertQuery = "INSERT INTO tbl_evaluation_form (category_id, form_no ,form_description, user_id, created_at) VALUES (?,?,?,?,?)";
    $stmt = $con->prepare($insertQuery);

    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("issis", $formCategory, $formNo, $formDescription, $userID, $timestamp);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Insertion successful
            $response = array('status' => 'success', 'message' => 'Form data added successfully');
        } else {
            // Insertion failed
            $response = array('status' => 'error', 'message' => 'Failed to add form data');
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Prepare statement failed
        $response = array('status' => 'error', 'message' => 'Failed to prepare statement');
    }

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
