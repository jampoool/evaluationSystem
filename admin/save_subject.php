<?php
    include "../connect.php";
    if (isset($_POST['save_changes'])) {
    // Include your database connection file
    session_start();
    date_default_timezone_set('Asia/Manila');
    $timestamp = date('Y-m-d H:i:s'); // Get current timestamp
    $userID = $_SESSION['user_id'];
    // Escape user inputs for security (assuming you're using MySQLi)
    $addCode = $_POST['addCode'];
    $addName =$_POST['addName'];

    // Attempt to insert data
    $query = "INSERT INTO tbl_subject (subject_code, subject_name, user_id, created_at) VALUES ('$addCode', '$addName', '$userID', '$timestamp')";
    if (mysqli_query($con, $query)) {
        // Data inserted successfully
        $response['status'] = 'success';
        $response['message'] = 'Data inserted successfully';
        echo json_encode($response);
    } else {
        // Error inserting data
        $response['status'] = 'error';
        $response['message'] = 'Error inserting data: ' . mysqli_error($con);
        echo json_encode($response);
    }

    // Close database con
    mysqli_close($con);
}
?>
