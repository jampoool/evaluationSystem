<?php
include "../connect.php";
session_start();

if (isset($_POST["update"])) {
    date_default_timezone_set('Asia/Manila');
    $catID = $_POST['editID']; // Retrieve the category ID
    $updatedCatDescription = $_POST['editCatDescription'];
    $user_ID = $_SESSION['user_id'];
    $timestamp = date('Y-m-d H:i:s');

    $query = "UPDATE tbl_category SET category_description = ?, user_id = ?, updated_at = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "sisi", $updatedCatDescription, $user_ID, $timestamp, $catID);

    if(mysqli_stmt_execute($stmt)) {
        $response = array('status' => 'success', 'message' => 'Category updated successfully');
        echo json_encode($response);
        exit();
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to update category');
        echo json_encode($response);
        exit();
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request');
    echo json_encode($response);
    exit();
}
?>
