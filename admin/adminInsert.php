<?php
session_start();
include "../connect.php";

$response = array(); // Initialize a response array

if ($con->connect_error) {
    $response['status'] = 'error';
    $response['message'] = 'Failed to connect to the database: ' . $con->connect_error;
    echo json_encode($response);
    exit(); // Terminate script execution if connection fails
}

if(isset($_POST['save_changes'])) {
    date_default_timezone_set('Asia/Manila');
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $type = $_POST['type'];
    $department = $_POST['department'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $timestamp = date('Y-m-d H:i:s'); // Get current timestamp

    $userID = $_SESSION['user_id'];

    // Check if user ID already exists
    $stmt_check_user_id = $con->prepare("SELECT COUNT(*) AS user_count FROM user WHERE `user-id` = ?");
    $stmt_check_user_id->bind_param("s", $user_id);
    $stmt_check_user_id->execute();
    $result_check_user_id = $stmt_check_user_id->get_result();
    $row_check_user_id = $result_check_user_id->fetch_assoc();

    // Close statement
    $stmt_check_user_id->close();

    // Check if email already exists
    $stmt_check_email = $con->prepare("SELECT COUNT(*) AS email_count FROM user WHERE email = ?");
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result_check_email = $stmt_check_email->get_result();
    $row_check_email = $result_check_email->fetch_assoc();

    // Close statement
    $stmt_check_email->close();

    // Validate user ID and email
    if ($row_check_user_id['user_count'] > 0) {
        // User ID already exists
        $response['status'] = 'error';
        $response['message'] = 'User ID already exists.';
    } elseif ($row_check_email['email_count'] > 0) {
        // Email already exists
        $response['status'] = 'error';
        $response['message'] = 'Email already exists.';
    } else {
        // Perform database insertion
        $insertQuery = "INSERT INTO user (`user-id`, email, firstname, lastname, password, type, created_by, department, date_created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($insertQuery);

        // Check if the prepare statement succeeded
        if ($stmt) {
            // Bind parameters to the prepared statement
            $stmt->bind_param("ssssssiss", $user_id, $email, $firstname, $lastname, $password, $type, $userID, $department, $timestamp);

            // Execute the prepared statement
            if ($stmt->execute()) {
                // Insertion successful
                $response['status'] = 'success';
                $response['message'] = 'User added successfully';
            } else {
                // Insertion failed
                $response['status'] = 'error';
                $response['message'] = 'Failed to add user';
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            // Prepare statement failed
            $response['status'] = 'error';
            $response['message'] = 'Failed to prepare statement';
        }
    }

    // Close the database connection
    $con->close();
} else {
    // Handle invalid request
    $response['status'] = 'error';
    $response['message'] = 'Invalid request';
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit();
?>
