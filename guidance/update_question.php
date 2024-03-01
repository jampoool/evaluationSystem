<?php
include "../connect.php";
session_start();

if (isset($_POST["questionID"], $_POST["formID"], $_POST["question"])) {
  
    $questionID = $_POST['questionID'];
    $formID = $_POST['formID'];
    $question = $_POST['question'];

    $user_ID = $_SESSION['user_id'];
    date_default_timezone_set('Asia/Manila');
    $timestamp = date('Y-m-d H:i:s');

    $query = "UPDATE tbl_question SET question = ?, evaluation_form_id = ?, user_id = ?, date_updated = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "siisi", $question, $formID, $user_ID, $timestamp, $questionID);

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
