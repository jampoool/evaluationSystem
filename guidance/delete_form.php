<?php
include "../connect.php";
session_start();

if (isset($_POST["formID"])) {
    $formID = $_POST['formID'];

    // Perform deletion query
    $query = "DELETE FROM tbl_evaluation_form WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $formID);

    if (mysqli_stmt_execute($stmt)) {
        $response = array('status' => 'success', 'message' => 'Form deleted successfully');
        echo json_encode($response);
        exit();
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to delete Form');
        echo json_encode($response);
        exit();
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request');
    echo json_encode($response);
    exit();
}
?>
