<?php
// Include your database connection file
include "../connect.php";
var_dump($_POST); 

// Check if the form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all necessary fields are provided
    if (isset($_POST['user_id'], $_POST['email'], $_POST['editType'], $_POST['editDepartment'])) {
        // Sanitize and get the data from the form
        $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $type = mysqli_real_escape_string($con, $_POST['editType']);
        $department = mysqli_real_escape_string($con, $_POST['editDepartment']);
        
        // Update query
        $sql = "UPDATE user SET email = '$email', type = '$type', department = '$department' WHERE `user-id` = '$user_id'";
        
        // Execute the update query
        if (mysqli_query($con, $sql)) {
            // If update successful, redirect to the page where the update was initiated
            header("Location: http://localhost/evaluationSystem/admin/manageUser.php");
            exit();
        } else {
            // If update fails, display an error message
            echo "Error updating record: " . mysqli_error($con);
        }
    } else {
        // If required fields are not provided, display an error message
        echo "Error: Required fields are missing";
    }
} else {
    // If the form is not submitted with POST method, redirect to the previous page
    header("Location: previous_page.php");
    exit();
}
?>