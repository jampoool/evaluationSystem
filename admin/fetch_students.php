<?php
// fetch_students.php

// Include necessary files and initialize database connection
include("../connect.php");

if(isset($_POST['studentClassesID'])) {
    $studentClassesID = $_POST['studentClassesID'];

    // Prepare SQL statement to fetch student details from tbl_student_class and user tables
    $sql = "SELECT tbl_student_class.student_id, user.`user-id`, user.id ,user.email, user.department FROM tbl_student_class JOIN user ON tbl_student_class.student_id = user.id WHERE tbl_student_class.class_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $studentClassesID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the result into an associative array
    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    // Close the prepared statement
    $stmt->close();

    // Return the result as JSON
    echo json_encode($students);
} else {
    echo "Error: Class ID not provided";
}
?>
