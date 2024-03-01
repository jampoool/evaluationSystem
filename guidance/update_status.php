<?php
include "../connect.php";
session_start();
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve item ID and new is_active status from the POST request
    date_default_timezone_set('Asia/Manila');
    $id = $_POST['id'];
    $is_active = $_POST['is_active'];
    $userID = $_SESSION['user_id'];
    $timestamp = date('Y-m-d H:i:s');

    // Prepare SQL statement to update the status
    $sql = "UPDATE tbl_assign SET is_active = ?, user_id = ?,date_updated = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("iisi", $is_active, $userID, $timestamp, $id );

    // Execute the statement
    if ($stmt->execute()) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $con->error;
    }

    // Close statement and connection
    $stmt->close();
    $con->close();
} else {
    // If the request method is not POST, return an error message
    echo "Error: Method not allowed";
}
?>
