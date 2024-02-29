<?php
include "../connect.php";

// Check if categoryID is provided and it's a valid integer
if(isset($_POST['categoryID']) && is_numeric($_POST['categoryID'])) {
    // Sanitize the input
    $categoryID = mysqli_real_escape_string($con, $_POST['categoryID']);

    // Query to fetch category description based on categoryID
    $query = "SELECT category_description FROM tbl_category WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);

    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "i", $categoryID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if query was successful and at least one row was returned
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $categoryDescription = $row['category_description'];

        // Return category description in JSON format
        echo json_encode(array('status' => 'success', 'categoryDescription' => $categoryDescription));
        exit;
    } else {
        // Category not found
        echo json_encode(array('status' => 'error', 'message' => 'Category not found'));
        exit;
    }
} else {
    // Invalid request or categoryID not provided
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request'));
    exit;
}
?>
