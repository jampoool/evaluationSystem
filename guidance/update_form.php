<?php
include "../connect.php";
session_start();

if (isset($_POST["id"], $_POST["updateFormID"], $_POST["updateCategory"], $_POST["updatedFormDescription"])) {
    $id = $_POST['id'];
    $updateFormID = $_POST['updateFormID'];
    $updateCategory = $_POST['updateCategory'];
    $updatedFormDescription = $_POST['updatedFormDescription'];
    $user_ID = $_SESSION['user_id'];
    date_default_timezone_set('Asia/Manila');
    $timestamp = date('Y-m-d H:i:s');

    $query = "UPDATE tbl_evaluation_form SET form_description = ?, form_no = ?, category_id = ?, user_id = ?, updated_at = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ssiisi", $updatedFormDescription, $updateFormID, $updateCategory, $user_ID, $timestamp, $id);

    if(mysqli_stmt_execute($stmt)) {
        http_response_code(200);
        echo json_encode(array('status' => 'success', 'message' => 'Form data updated successfully'));
        exit();
    } else {
        http_response_code(500);
        echo json_encode(array('status' => 'error', 'message' => 'Failed to update form data'));
        exit();
    }
} else {
    http_response_code(400);
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request'));
    exit();
}
?>
