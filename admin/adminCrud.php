<?php
    include "../connect.php";

        if (isset($_POST['save_changes'])) {
            $guidanceId = $_POST['id'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $type = $_POST['type'];
            $department = $_POST['department'];
            $dateCreated = date("Y-m-d");

            $sql = "INSERT INTO user (`user-id`, email, password, type, department, date_created) VALUES (?, ?, ?, ?, ?,?)";

            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssssis", $guidanceId, $email, $password, $type, $department, $dateCreated);

            if ($stmt->execute()) {
                echo '<script>alert("User inserted successfully!");</script>';
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    ?>
