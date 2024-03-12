<?php
include("../connect.php");
session_start();

// Check if the form was submitted
if(isset($_POST['save_changes'])) {
    // Retrieve form data
    $classID = $_POST['classID'];
    $studentIDs = $_POST['studentIDs'];
    $userID = $_SESSION['user_id'];
    date_default_timezone_set('Asia/Manila');
    $dateCreated = date('Y-m-d H:i:s');

    // Initialize flag for validation
    $allValid = true;

    // Initialize prepared statement for insertion
    $stmt_insert = $con->prepare("INSERT INTO tbl_student_class (student_id, user_id, class_id, created_at) VALUES (?, ?, ?, ?)");

    // Iterate through studentIDs array
    foreach ($studentIDs as $studentID) {
        // Check if the student is already enrolled in the class
        $stmt_check = $con->prepare("SELECT * FROM tbl_student_class WHERE student_id = ? AND class_id = ?");
        $stmt_check->bind_param("ii", $studentID, $classID);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            $allValid = false;
            // Exit the loop if any student is already enrolled
            break;
        } else {
            // If the student is not enrolled, insert data into the database
            $stmt_insert->bind_param("iiis", $studentID, $userID, $classID, $dateCreated);

            if (!$stmt_insert->execute()) {
                $allValid = false;
            }
        }
    }

    // Close prepared statement for insertion
    $stmt_insert->close();

    if ($allValid) {
        // If all students are successfully assigned, echo success message
        echo "success";
    } else {
        // If any student is already enrolled, echo warning message
        echo "already_enrolled";
    }

} else {
    // If 'save_changes' flag is not set, handle the situation accordingly
    echo "Error: 'save_changes' flag is not set.";
}
?>
