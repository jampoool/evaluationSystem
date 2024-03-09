<?php
include "../connect.php";

header('Content-Type: application/json'); // Set the content type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $classID = $_POST['classID'];

    // Fetch data from the tbl_class table
    $fetchClassQuery = "SELECT * FROM tbl_class WHERE id = $classID";
    $result = mysqli_query($con, $fetchClassQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Additional queries to fetch associated teacher and subject IDs
        $fetchTeacherIDsQuery = "SELECT instructor_id FROM tbl_class WHERE id = $classID";
        $fetchSubjectIDsQuery = "SELECT subject_id FROM tbl_class WHERE id = $classID";

        $teacherIDsResult = mysqli_query($con, $fetchTeacherIDsQuery);
        $subjectIDsResult = mysqli_query($con, $fetchSubjectIDsQuery);

        if ($teacherIDsResult && $subjectIDsResult) {
            $teacherIDs = mysqli_fetch_assoc($teacherIDsResult)['instructor_id'];
            $subjectIDs = mysqli_fetch_assoc($subjectIDsResult)['subject_id'];

            // Send a JSON response with the fetched data and associated IDs
            echo json_encode(array(
                'status' => 'success',
                'classID' => $row['id'],
                'classCode' => $row['class_code'],
                'className' => $row['class_name'],
                'teacherIDs' => $teacherIDs,
                'subjectIDs' => $subjectIDs
            ));
        } else {
            // Send a JSON response indicating failure
            echo json_encode(array('status' => 'error', 'message' => 'Error fetching associated teacher and subject IDs.'));
        }
    } else {
        // Send a JSON response indicating failure
        echo json_encode(array('status' => 'error', 'message' => 'Error fetching class details.'));
    }

    // Close the database connection
    mysqli_close($con);
} else {
    // Invalid request method
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}
?>
