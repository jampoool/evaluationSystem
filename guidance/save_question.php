<?php
// Include your database connection file
include "../connect.php";
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the necessary POST data is set and if save_changes is set
    if (isset($_POST["save_changes"]) && isset($_POST["formNumber"]) && isset($_POST["question"])) {
        // Retrieve the form number and questions from the POST data
        $formNumber = $_POST["formNumber"];
        $questions = $_POST["question"];
        $userID = $_SESSION['user_id'];
        
        // Validate or sanitize your input data as needed
        
        // Get the current timestamp
        $currentTimestamp = date('Y-m-d H:i:s');
        
        // Loop through the questions array and insert each question into the database
        foreach ($questions as $question) {
            // Perform the database insertion using prepared statements to prevent SQL injection
            // Adjust the SQL query according to your database schema
            $stmt = $con->prepare("INSERT INTO tbl_question (evaluation_form_id, question, user_id, date_created) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isis", $formNumber, $question, $userID, $currentTimestamp);
            $stmt->execute();
            if ($stmt->errno) {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
        
        // Send a success response back to the client
        $response = array("status" => "success", "message" => "Questions saved successfully");
        echo json_encode($response);
    } else {
        // Send an error response if the necessary POST data is not set or save_changes is not set
        $response = array("status" => "error", "message" => "Incomplete data received or save_changes not set");
        echo json_encode($response);
    }
} else {
    // Send an error response if the request method is not POST
    $response = array("status" => "error", "message" => "Invalid request method");
    echo json_encode($response);
}
?>
