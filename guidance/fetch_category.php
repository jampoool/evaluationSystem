<?php
include "../connect.php"; // Include your database connection file

if(isset($_POST['updateCat'])) {
    $catID = $_POST['updateCat'];

    // Fetch the category description from the database based on catID
    $query = "SELECT category_description FROM tbl_category WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $catID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $categoryDescription);
    
    if(mysqli_stmt_fetch($stmt)) {
        // Category description found, send it in the response
        $response = array('status' => 'success', 'categoryDescription' => $categoryDescription);
        echo json_encode($response);
        exit();
    } else {
        // Category not found
        $response = array('status' => 'error', 'message' => 'Category not found');
        echo json_encode($response);
        exit();
    }
} else {
    // Invalid request
    $response = array('status' => 'error', 'message' => 'Invalid request');
    echo json_encode($response);
    exit();
}
?>
