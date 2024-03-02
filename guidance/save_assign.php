<?php
include "../connect.php";
session_start();

if (isset($_POST["save_changes"])) {
    date_default_timezone_set('Asia/Manila');
    $userID = $_SESSION['user_id'];
    $formID = $_POST['formID'];
    $teacherIDs = json_decode($_POST['teacherIDs']); // Decode the JSON string into a PHP array

    $timestamp = date('Y-m-d H:i:s');
    $success = true;

    foreach ($teacherIDs as $teacherID) {
        $insertQuery = "INSERT INTO tbl_assign(instructor_id, evaluation_form_id, user_id, date_created) VALUES (?,?,?,?)";
        $stmt = $con->prepare($insertQuery);

        if ($stmt) {
            $stmt->bind_param("iiis", $teacherID, $formID, $userID, $timestamp);

            if (!$stmt->execute()) {
                $success = false;
                break;
            }
        } else {
            $success = false;
            break;
        }
    }

    if ($success) {
        $response = array('status' => 'success', 'message' => 'Form data added successfully');
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to add form data');
    }

    $stmt->close();
    echo json_encode($response);
    exit();
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request');
    echo json_encode($response);
    exit();
}
?>
