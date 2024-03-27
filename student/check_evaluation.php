<?php
// Include your database connection
include "../connect.php";

// Check if teacher_id parameter is provided
if(isset($_GET['teacher_id'])) {
    // Sanitize the input to prevent SQL injection
    $teacher_id = mysqli_real_escape_string($con, $_GET['teacher_id']);
    
    // Check if the student has already evaluated the teacher
    session_start();
    if (isset($_SESSION['user_id'])) {
        $student_id = $_SESSION['user_id'];
        
        // Query to check if the student has already evaluated the teacher
        $sql = "SELECT COUNT(*) AS num_evaluations FROM tbl_responses WHERE student_id = '$student_id' AND teacher_id = '$teacher_id'";
        
        // Execute the query
        $result = mysqli_query($con, $sql);
        
        if($result) {
            // Fetch the result as an associative array
            $row = mysqli_fetch_assoc($result);
            $num_evaluations = $row['num_evaluations'];
            
            // Check if the student has already evaluated the teacher
            if($num_evaluations > 0) {
                // Student has already evaluated the teacher
                echo 'evaluated';
                exit(); // Exit to prevent further execution
            }
        } else {
            // Query execution failed
            echo 'error';
            exit(); // Exit to prevent further execution
        }
    } else {
        // User is not logged in
        echo 'not_logged_in';
        exit(); // Exit to prevent further execution
    }
    
    // Query to check if the teacher evaluation is active
    $sql = "SELECT is_active FROM tbl_assign WHERE instructor_id = '$teacher_id'";
    
    // Execute the query
    $result = mysqli_query($con, $sql);
    
    if($result) {
        // Check if any rows were returned
        if(mysqli_num_rows($result) > 0) {
            // Fetch the result as an associative array
            $row = mysqli_fetch_assoc($result);
            $is_active = $row['is_active'];
            
            // Check if evaluation is active or inactive
            if($is_active == 1) {
                // Evaluation is active
                echo 'active';
            } else {
                // Evaluation is inactive
                echo 'inactive';
            }
        } else {
            // No evaluation found for the teacher
            echo 'inactive';
        }
    } else {
        // Query execution failed
        echo 'error';
    }
} else {
    // teacher_id parameter is missing
    echo 'missing_parameter';
}

// Close the database connection
mysqli_close($con);
?>
