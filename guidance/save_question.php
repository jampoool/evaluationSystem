<?php

// Include your database connection file
include "../connect.php";

// Check if the form is submitted via AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["formNumber"]) && isset($_POST["questions"])) {
    // Retrieve the form number and questions from the POST data
    $formNumber = $_POST["formNumber"];
    $questions = $_POST["questions"];

    // Validate form number
    if (!empty($formNumber)) {
        // Check if at least one question is entered
        if (!empty($questions)) {
            // Prepare and execute the query for each question
            foreach ($questions as $question) {
                // Trim and sanitize the question input
                $question = trim($question);
                $question = mysqli_real_escape_string($con, $question);
                
                // Check if the question is not empty
                if (!empty($question)) {
                    // Perform the database insertion using prepared statements to prevent SQL injection
                    $stmt = $con->prepare("INSERT INTO tbl_question (evaluation_form_id, question) VALUES (?, ?)");
                    $stmt->bind_param("is", $formNumber, $question);
                    $stmt->execute();
                    
                    if ($stmt->errno) {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                }
            }
            // Provide a success response
            echo json_encode(array("status" => "success", "message" => "Questions inserted successfully"));
        } else {
            // Provide an error response if no questions are entered
            echo json_encode(array("status" => "error", "message" => "Please enter at least one question"));
        }
    } else {
        // Provide an error response if form number is not selected
        echo json_encode(array("status" => "error", "message" => "Please select a form number"));
    }
} else {
    // Provide an error response if the request is not via AJAX or if required POST data is missing
    echo json_encode(array("status" => "error", "message" => "Invalid request"));
}
?>
