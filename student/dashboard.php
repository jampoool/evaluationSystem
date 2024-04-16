<?php
    include "../connect.php";
    session_start();
if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'student') {
    header("Location: unauthorized_access.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <!-- Your custom CSS -->
    <link rel="stylesheet" href="../admin/css/dashboard.css">
    
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
     <!-- Font Awesome -->
     <script src="https://kit.fontawesome.com/658ff99b54.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.js"></script>
    <!-- SweetAlert library from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   
</head>

<style>
    body {
        background:#FAFAFA;
    }
</style>

<body>
    <div class="wrapper">
        <div class="main">
            <nav class="navbar navbar-expand px-2 py-2 shadow p-3 mb-5 bg-body rounded sticky-top">
                <form action="#" class="d-none d-sm-inline-block">
                </form>
                <div class="navbar-collapse">
                    <label for="">Faculty Evaluation System</label>
                </div>
               <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../img/cartoon-man-leaving-review.jpg" class="avatar img-fluid" alt="Avatar">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">  
                            <li><a class="dropdown-item" href="settings.php"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                    </ul>
                </div>

            </nav>
            <div class="container-fluid">
            <div class="row mb-4">
                <div class="col">
                    <div class="card text-white mb-3" style="background-color: #1d216e">
                        <div class="card-body">
                            <h5 class="card-title">Welcome, 
                                <?php
                                // Assuming that $_SESSION['user_id'] is the session variable holding the user ID
                                $userId = $_SESSION['user_id'];

                                // Ensure to properly sanitize user input to prevent SQL injection
                                $userId = mysqli_real_escape_string($con, $userId);

                                // Query to fetch student name based on user ID
                                $student_query = "SELECT firstname, lastname FROM user WHERE id = '$userId'";
                                $student_result = mysqli_query($con, $student_query);

                                // Check if query executed successfully and returned any rows
                                if ($student_result && mysqli_num_rows($student_result) > 0) {
                                    $student_data = mysqli_fetch_assoc($student_result);
                                    echo $student_data['firstname'] . ' ' . $student_data['lastname'];
                                } else {
                                    echo "Student Name";
                                }
                                ?>
                            </h5>
                            <p class="card-text">You are logged in as a student.</p>
                        </div>
                    </div>
                </div>
            </div>
                <div class="container-fluid">
                <div class="row mb-4">
                        <?php
                        // Assuming that $_SESSION['user_id'] is the session variable holding the user ID
                        $userId = $_SESSION['user_id'];
                        // Ensure to properly sanitize user input to prevent SQL injection
                        $userId = mysqli_real_escape_string($con, $userId);
                        // Fetch classes assigned to the student
                        $sql = "SELECT sc.*, c.class_name, CONCAT (u.firstname,' ',u.lastname) AS instructor_name, u.id as teacher_id, CONCAT(s.subject_name,' ',s.subject_code) AS subject_name
                                FROM tbl_student_class sc 
                                JOIN tbl_class c ON sc.class_id = c.id
                                JOIN tbl_subject s ON c.id = s.id
                                JOIN user u ON c.instructor_id = u.id
                                WHERE sc.student_id = '$userId'
                                AND EXISTS (SELECT 1 FROM user WHERE id = c.instructor_id)";
                        $result = mysqli_query($con, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $className = $row['class_name'];
                                $teacherName = $row['instructor_name'];
                                $subjectName= $row['subject_name'];
                                $teacherID = $row['teacher_id'];
                                // Display class card
                                echo "<div class='col-lg-4'>
                                    <div class='card text-white mb-4' style='background-color: #1d216e'>
                                        <div class='card-header'>$className</div>
                                        <div class='card-body'>
                                            <h5 class='card-title'>Teacher: $teacherName</h5>
                                            <p class='card-title'>Subject: $subjectName</p>
                                            <p class='card-text'>Evaluate your teacher here.</p>
                                            <button onclick=\"checkEvaluation('$teacherID')\" class=\"btn btn-primary\">Evaluate</button>
                                        </div>
                                    </div>
                                </div>";
                        
                            }
                        } else {
                            echo "Error: " . mysqli_error($con);
                        }
                        ?>
                </div>
            </div>
        </div>

       
    <script src="../admin/script.js"></script>
    <script>
         function checkEvaluation(teacherID) {
        // Make AJAX request to check the status of teacher evaluation
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === 'active') {
                    // If evaluation is active, proceed to evaluationForm.php
                        window.location.href = 'evaluationForm.php?teacher_id=' + teacherID;
                    } else if (response === 'evaluated') {
                        // If the student has already evaluated the teacher, show a SweetAlert message
                        Swal.fire({
                            icon: 'info',
                            title: 'Evaluation Already Completed',
                            text: 'You have already evaluated this teacher.'
                        });
                    } else {
                        // If evaluation is not active, show a SweetAlert message
                        Swal.fire({
                            icon: 'warning',
                            title: 'Evaluation Closed',
                            text: 'Evaluation for this teacher is closed.'
                        });
                    }
                    
                    } else {
                        // Handle error
                        console.error('Error:', xhr.statusText);
                    }
                }
        };
        xhr.open('GET', 'check_evaluation.php?teacher_id=' + teacherID, true);
        xhr.send();
    }
    </script>
</body>

</html>
