<?php
include "../connect.php";
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $userId = $_SESSION['user_id']; // Get the user's ID from the session
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $renewPassword = $_POST['renewPassword'];

    // Validate form data (You can add more validation if needed)
    if (empty($currentPassword) || empty($newPassword) || empty($renewPassword)) {
        // Current password, new password, or re-entered new password is empty
        echo json_encode(array('success' => false, 'message' => 'Please fill in all fields.'));
        exit;
    }

    // Check if the current password matches the existing password in the database
    $passwordQuery = "SELECT password FROM user WHERE id = '$userId'";
    $passwordResult = mysqli_query($con, $passwordQuery);
    if (!$passwordResult) {
        echo json_encode(array('success' => false, 'message' => 'Error checking current password.'));
        exit;
    }
    $row = mysqli_fetch_assoc($passwordResult);
    $existingPassword = $row['password'];

    if ($currentPassword !== $existingPassword) {
        // Current password does not match the existing password in the database
        echo json_encode(array('success' => false, 'message' => 'Current password is incorrect.'));
        exit;
    }

    // Check if the new password matches the confirm password
    if ($newPassword !== $renewPassword) {
        // New password and confirm password do not match
        echo json_encode(array('success' => false, 'message' => 'New password and confirm password do not match.'));
        exit;
    }

    // Update user's password in the database
    $updateQuery = "UPDATE user SET password = '$newPassword' WHERE id = '$userId'";
    if (mysqli_query($con, $updateQuery)) {
        // Password updated successfully
        echo json_encode(array('success' => true, 'message' => 'Password updated successfully.'));
    } else {
        // Error updating password
        echo json_encode(array('success' => false, 'message' => 'Error updating password.'));
    }

    // Close database connection
    mysqli_close($con);
    exit;
} else {
    // If the form is not submitted, redirect the user back
    header("Location: settings.php");
    exit();
}
?>
