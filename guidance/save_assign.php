<?php
include("../connect.php");
session_start();
// Check if the form was submitted
if(isset($_POST['save_changes'])) {
    // Retrieve form data
    $formID = $_POST['formID'];
    $teacherIDs = $_POST['teacherIDs'];
    $userID = $_SESSION['user_id'];
    date_default_timezone_set('Asia/Manila');
    $dateCreated = date('Y-m-d H:i:s');

    // Insert data into the database
    foreach ($teacherIDs as $teacherID) {
        // Prepare and execute SQL statement
        $stmt = $con->prepare("INSERT INTO tbl_assign (instructor_id, user_id, evaluation_form_id, date_created) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $teacherID, $userID, $formID, $dateCreated);

        if ($stmt->execute()) {
            // Data inserted successfully
            echo "Data inserted successfully!";
        } else {
            // Error occurred
            echo "Error: " . $stmt->error . ". Query: " . "INSERT INTO tbl_assign (instructor_id, user_id, evaluation_form_id, date_created) VALUES ('$teacherID', '$userID', '$formID', '$dateCreated')";
        }
    }

    // Close prepared statement
    $stmt->close();

    // Close database connection
    $con->close();
} else {
    // If 'save_changes' flag is not set, handle the situation accordingly
    echo "Error: 'save_changes' flag is not set.";
}
?>
