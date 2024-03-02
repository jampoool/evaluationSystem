<?php
include "../connect.php";
session_start();

$response = array(); // Initialize a response array

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required fields are set
    if (
        isset($_POST['user_id']) &&
        isset($_POST['email']) &&
        isset($_POST['password']) &&
        isset($_POST['type']) &&
        isset($_POST['department'])
    ) {
        // Check connection
        if ($con->connect_error) {
            $response['status'] = 'error';
            $response['message'] = 'Connection failed: ' . $con->connect_error;
        } else {
            date_default_timezone_set('Asia/Manila');
            $dateCreated = date('Y-m-d');

            // Prepare SQL statement
            $sql = "INSERT INTO user (`user-id`, email, password, type, department, date_created) VALUES (?, ?, ?, ?, ?, ?)";

            // Bind parameters
            $stmt = $con->prepare($sql);
            $stmt->bind_param(
                "isssis",
                $_POST['user_id'],
                $_POST['email'],
                $_POST['password'],
                $_POST['type'],
                $_POST['department'],
                $dateCreated
            );

            // Execute the statement
            if ($stmt->execute()) {
                // Check if the insertion was successful
                $user_id = $_SESSION['user_id'] ?? null;
                if ($user_id) {
                    // Sanitize user input
                    $email = $con->real_escape_string($_POST['email']);
                    
                    // SQL query to insert data
                    $activity_sql = "INSERT INTO tblactivity (user_id, email) VALUES (?, ?)";
                    
                    // Prepare and execute activity SQL statement
                    $activity_stmt = $con->prepare($activity_sql);
                    $activity_stmt->bind_param("is", $user_id, $email);
                    if ($activity_stmt->execute()) {
                        $response['status'] = 'success';
                        $response['message'] = 'Data inserted successfully';
                    } else {
                        $response['status'] = 'error';
                        $response['message'] = 'Error inserting activity: ' . $con->error;
                    }
                    $activity_stmt->close();
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'User ID not set in session';
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Error inserting data: ' . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Missing required fields';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
