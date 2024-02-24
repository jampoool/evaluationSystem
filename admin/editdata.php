<?php
// Include your database connection file
include "../connect.php";

// Check if the user ID is set in the POST request
if(isset($_POST['id'])){
    // Sanitize and get the user ID
    $id = mysqli_real_escape_string($con, $_POST['id']);
    
    // Query to fetch user details based on the user ID
    $sql = "SELECT * FROM user WHERE `user-id` = '$id'";
    $result = mysqli_query($con, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch user details from the result
        $row = mysqli_fetch_assoc($result);

        // Prepare the HTML content for the modal
        $html = '<form action="update.php" method="POST">';
        $html .= '<input type="hidden" name="user_id" value="' . $row['user-id'] . '">';
        $html .= '<div class="form-group">';
        $html .= '<label for="editEmail">Email</label>';
        $html .= '<input type="email" name="email" class="form-control" id="editEmail" value="' . $row['email'] . '" required>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label for="editType">Type</label>';
        $html .= '<select id="editType" class="form-select" name="editType">';
        $html .= '<option value="admin" ' . ($row['type'] == 'admin' ? 'selected' : '') . '>admin</option>';
        $html .= '<option value="guidance" ' . ($row['type'] == 'guidance' ? 'selected' : '') . '>guidance</option>';
        $html .= '<option value="student" ' . ($row['type'] == 'student' ? 'selected' : '') . '>student</option>';
        $html .= '</select>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label for="editDepartment">Department</label>';
        $html .= '<select id="editDepartment" class="form-select" name="editDepartment">';
        $html .= '<option value="1" ' . ($row['department'] == '1' ? 'selected' : '') . '>Basic Education Department</option>';
        $html .= '<option value="2" ' . ($row['department'] == '2' ? 'selected' : '') . '>Higher Education Department</option>';
        $html .= '</select>';
        $html .= '</div>';
        // Add more fields as needed
        
        $html .= '<button type="submit" class="btn btn-primary">Update</button>';
        $html .= '</form>';

        // Output the HTML content
        echo $html;
    } else {
        // If the query fails, output an error message
        echo 'Error: Unable to fetch user details';
    }
} else {
    // If user ID is not provided, output an error message
    echo 'Error: User ID not provided';
}
?>
