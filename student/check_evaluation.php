<?php
// Include your database connection
include "../connect.php";

// Check if teacher_id parameter is provided
if(isset($_GET['teacher_id'])) {
    // Sanitize the input to prevent SQL injection
    $teacher_id = mysqli_real_escape_string($con, $_GET['teacher_id']);
    
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
