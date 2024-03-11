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

        // Fetch associated teacher and subject IDs
        $teacherIDsResult = mysqli_query($con, "SELECT instructor_id FROM tbl_class WHERE id = $classID");
        $subjectIDsResult = mysqli_query($con, "SELECT subject_id FROM tbl_class WHERE id = $classID");

        if ($teacherIDsResult && $subjectIDsResult) {
            $teacherIDs = [];
            while ($teacherRow = mysqli_fetch_assoc($teacherIDsResult)) {
                $teacherIDs[] = $teacherRow['instructor_id'];
            }

            $subjectIDs = [];
            while ($subjectRow = mysqli_fetch_assoc($subjectIDsResult)) {
                $subjectIDs[] = $subjectRow['subject_id'];
            }

            // Send a JSON response with the fetched data and associated IDs
            echo json_encode(array(
                'status' => 'success',
                'classID' => $classID,
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
