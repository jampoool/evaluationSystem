<?php
include "../connect.php";
session_start();

if (isset($_POST["categoryID"])) {
    $categoryID = $_POST['categoryID'];

    // Perform deletion query
    $query = "DELETE FROM tbl_category WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $categoryID);

    if (mysqli_stmt_execute($stmt)) {
        $response = array('status' => 'success', 'message' => 'Category deleted successfully');
        echo json_encode($response);
        exit();
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to delete category');
        echo json_encode($response);
        exit();
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request');
    echo json_encode($response);
    exit();
}
?>
