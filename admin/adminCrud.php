<?php
    include "../connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare SQL statement
    $sql = "INSERT INTO user (`user-id`, email, password, type, department) VALUES (?, ?, ?, ?, ?)";

    // Bind parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssss", $_POST['id'], $_POST['email'], $_POST['password'], $_POST['type'], $_POST['department']);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location:http://localhost/evaluationSystem/admin/adminpanel.php");
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    // Close the connection
    $stmt->close();
    $con->close();
}
?>