<?php
// Check if the request is made using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if id and is_active parameters are set in the POST request
    if (isset($_POST["id"]) && isset($_POST["is_active"])) {
        // Include your database connection file
        include "../connect.php"; // Adjust the path as per your file structure

        date_default_timezone_set('Asia/Manila');
        // Sanitize and validate the input data
        $id = mysqli_real_escape_string($con, $_POST["id"]);
        $is_active = mysqli_real_escape_string($con, $_POST["is_active"]);
        $date_updated = date('Y-m-d H:i:s');
        // Update the database
        $query = "UPDATE tbl_assign SET is_active = '$is_active', date_updated = '$date_updated' WHERE id = '$id'";

        if (mysqli_query($con, $query)) {
            // Database update successful
            echo "Database updated successfully";
        } else {
            // Database update failed
            echo "Error updating database: " . mysqli_error($con);
        }

        // Close the database connection
        mysqli_close($con);
    } else {
        // Missing id or is_active parameter in the POST request
        echo "Error: Missing parameters";
    }
} else {
    // Invalid request method
    echo "Error: Invalid request method";
}
?>
