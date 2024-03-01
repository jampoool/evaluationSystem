<?php
// Include your database connection file
include "../connect.php";
session_start();

// Check if the form data is submitted
if (isset($_POST["save_changes"])) {
    date_default_timezone_set('Asia/Manila');
    $userID = $_SESSION['user_id'];
    $formID = $_POST['formID'];
    $teacherID = $_POST['teacherID'];
    $timestamp = date('Y-m-d H:i:s');

    // Perform database insertion
    $insertQuery = "INSERT INTO tbl_assign(instructor_id, evaluation_form_id, user_id, date_created) VALUES (?,?,?,?)";
    $stmt = $con->prepare($insertQuery);

    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("iiis", $teacherID, $formID, $userID, $timestamp);

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
