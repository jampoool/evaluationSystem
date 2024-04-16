<?php
include "../connect.php";
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit(); // Stop further execution
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $userId = $_SESSION['user_id']; // Get the user's ID from the session
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    // Validate form data (You can add more validation if needed)

    // Update user's profile details in the database
    $updateQuery = "UPDATE user SET firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE id = '$userId'";
    if (mysqli_query($con, $updateQuery)) {
        // Profile updated successfully
        $_SESSION['success_message'] = "Profile updated successfully.";
    } else {
        // Error updating profile
        $_SESSION['error_message'] = "Error updating profile: " . mysqli_error($con);
    }

    // Close database conection
    mysqli_close($con);

    // Redirect the user back to the profile page
    header("Location: settings.php");
    exit(); // Stop further execution
} else {
    // If the form is not submitted, redirect the user back to the settings page
    header("Location: settings.php");
    exit(); // Stop further execution
}
?>