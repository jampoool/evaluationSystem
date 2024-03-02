<?php
include "../connect.php";
session_start();

if (isset($_POST["questionID"])) {
    $questionID = $_POST['questionID'];

    // Perform deletion query
    $query = "DELETE FROM tbl_question WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $questionID); // Corrected parameter name

    if (mysqli_stmt_execute($stmt)) {
        $response = array('status' => 'success', 'message' => 'Question deleted successfully');
        echo json_encode($response);
        exit();
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to delete Question');
        echo json_encode($response);
        exit();
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request');
    echo json_encode($response);
    exit();
}
?>
