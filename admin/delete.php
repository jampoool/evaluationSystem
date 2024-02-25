<?php
// delete.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the incoming data
    $idToDelete = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Perform the deletion (Replace this with your actual deletion logic)
   $result = deleteDataFromDatabase($idToDelete);

    // Respond with success or error
    if ($result) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error deleting data']);
    }
} else {
    // Invalid request method
    header('HTTP/1.1 405 Method Not Allowed');
    echo 'Method Not Allowed';
}

function deleteDataFromDatabase($id){
    include "../connect.php";

     if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // SQL to delete data
    $sql = "DELETE FROM user WHERE id = ?";

    // Prepare and bind the statement
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);

    // Execute the statement
    $result = $stmt->execute();

    // Close statement and conection
    $stmt->close();
    $con->close();

    return $result;
}
?>