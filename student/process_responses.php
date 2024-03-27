<?php 
include "../connect.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include database connection
    include "../connect.php";

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401); // Unauthorized
        echo "User is not logged in";
        exit();
    }

    // Get the student ID from the session
    $student_id = $_SESSION['user_id'];

    // Validate and sanitize the input data
    function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Get the teacher ID from the POST parameter
    $teacher_id = isset($_POST['teacherID']) ? sanitizeInput($_POST['teacherID']) : null;

    if ($teacher_id === null) {
        http_response_code(400); // Bad Request
        echo "Teacher ID is required";
        exit();
    }

    // Parse the form data string into an object
    parse_str($_POST['formData'], $formData);

    // Check if 'responses' array is defined and not empty
    if (isset($formData['responses']) && is_array($formData['responses'])) {
        $responses = $formData['responses'];

        // Prepare and execute the SQL query to insert responses
        foreach ($responses as $question_id => $rating) {
            // Sanitize input data
            $question_id = sanitizeInput($question_id);
            $rating = sanitizeInput($rating);

            // Prepare the SQL statement
            $sql = "INSERT INTO tbl_responses (question_id, student_id, teacher_id, rating) VALUES (?, ?, ?, ?)";
            $stmt = $con->prepare($sql);

            if ($stmt) {
                // Bind the parameters and execute the statement
                $stmt->bind_param("iiii", $question_id, $student_id, $teacher_id, $rating);
                if ($stmt->execute()) {
                    // Success
                } else {
                    http_response_code(500); // Internal Server Error
                    echo "Error: " . $con->error;
                    exit();
                }
                $stmt->close();
            } else {
                http_response_code(500); // Internal Server Error
                echo "Error: " . $con->error;
                exit();
            }
        }
    } else {
        http_response_code(400); // Bad Request
        echo "No responses data received";
        exit();
    }

    // Close the database connection
    $con->close();

    // Return a success response
    echo "Responses inserted successfully";
} else {
    // Return an error response if the request method is not POST
    http_response_code(400); // Bad Request
    echo "Bad request";
}
?>
