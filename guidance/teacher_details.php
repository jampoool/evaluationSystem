<?php
    include "../connect.php";
    session_start();
    if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'guidance') {
        header("Location: unauthorized_access.php");
        exit();
    }
    if (isset($_GET['id'])) {
        $teacher_id = $_GET['id'];
    
        // SQL query to select classes handled by the teacher
        $class_sql = "SELECT * FROM tbl_class WHERE instructor_id = '$teacher_id'";
        $class_result = mysqli_query($con, $class_sql);

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
    
    <style>
    .custom-gutter {
        margin-right: -15px;
        margin-left: -15px;
    }

    .custom-gutter > .col, .custom-gutter > [class*="col-"] {
        padding-right: 15px;
        padding-left: 15px;
    }
    .nav-tabs .nav-link.active {
    background-color: #007bff; /* Primary color */
    color: #ffffff; /* Text color */
    border-color: #007bff; /* Border color */
}
</style>
</head>

<body>
    <div class="wrapper">
    <aside id="sidebar" class="expand">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">
                        <?php
                        // Assuming that $_SESSION['user_id'] is the session variable holding the user ID
                        $userId = $_SESSION['user_id'];

                        // Ensure to properly sanitize user input to prevent SQL injection
                        $userId = mysqli_real_escape_string($con, $userId);

                        $sql = "SELECT email FROM user WHERE id = '$userId'";

                        if ($result = mysqli_query($con, $sql)) {
                            // Check if any rows were returned
                            if (mysqli_num_rows($result) > 0) {
                                // Fetch the result as an associative array
                                $row = mysqli_fetch_assoc($result);

                                // Access the email value
                                $userEmail = $row['email'];

                                // Display the email
                                echo "<p style='font-size:14px;'>$userEmail</p>";
                            } else {
                                echo "User not found";
                            }

                            // Free the result set
                            mysqli_free_result($result);
                        } else {
                            // Handle the query error
                            echo "Error: " . mysqli_error($con);
                        }

                        ?>
                    </a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item ">
                    <a href="dashboard.php" class="sidebar-link">
                        <i class="fa-solid fa-table-cells-large"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="form.php" class="sidebar-link">
                        <i class="fa-regular fa-file-lines"></i>
                        <span>Manage Form</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="category.php" class="sidebar-link">
                        <i class="fa-solid fa-layer-group fa-fw"></i>
                        <span>Manage Category</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="question.php" class="sidebar-link">
                        <i class="fa-solid fa-clipboard-question fa-fw"></i>
                        <span>Manage Question</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="report.php" class="sidebar-link">
                        <i class="fa-solid fa-flag fa-fw"></i>
                        <span>Evaluation Report</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="assign.php" class="sidebar-link">
                        <i class="fa-solid fa-check fa-fw"></i>
                        <span>Assign Teacher</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="../logout.php" class="sidebar-link">
                <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
    
        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3 shadow p-3 bg-body rounded sticky-top">
                <form action="#" class="d-none d-sm-inline-block">
                </form>
                <div class="navbar-collapse">
                    <label for="">Faculty Evaluation System</label>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="../img/cartoon-man-leaving-review.jpg" class="avatar img-fluid" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end rounded">
                            <i class="fa-solid fa-circle-plus"></i>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="col-md-12 px-5 py-1">
                <h4 class="fw-bold mt-4">Classes Handled by:   
                    <?php
                        // Assuming that $_SESSION['user_id'] is the session variable holding the user ID
                        $tID = $_GET['id'];

                        // Ensure to properly sanitize user input to prevent SQL injection
                        $tID = mysqli_real_escape_string($con, $tID);

                        $sql = "SELECT firstname, lastname FROM user WHERE id = '$tID'";

                        if ($result = mysqli_query($con, $sql)) {
                            // Check if any rows were returned
                            if (mysqli_num_rows($result) > 0) {
                                // Fetch the result as an associative array
                                $row = mysqli_fetch_assoc($result);

                                // Access the email value
                                $tecaherName = $row['firstname'].' '.$row['lastname'];

                                // Display the email
                                echo "<p>$tecaherName</p>";
                            } 

                            // Free the result set
                            mysqli_free_result($result);
                        } else {
                            // Handle the query error
                            echo "Error: " . mysqli_error($con);
                        }

                        ?></h4>
                <ul class="nav nav-tabs bg-white" id="classTabs" role="tablist">
                    <?php
                    if (mysqli_num_rows($class_result) > 0) {
                        $first = true;
                        while ($class_row = mysqli_fetch_assoc($class_result)) {
                            $class_id = $class_row['id'];
                            $class_name = $class_row['class_code'];
                            // Setting the first tab as active
                            $active = $first ? 'active' : '';
                            // Add a custom class for the active tab
                            $active_class = $first ? 'active-primary' : '';
                    ?>
                             <li class="nav-item" role="presentation">
                             <button class="nav-link <?php echo $active; ?>" id="class-<?php echo $class_id; ?>-tab" data-bs-toggle="tab" data-bs-target="#class-<?php echo $class_id; ?>" type="button" role="tab" aria-controls="class-<?php echo $class_id; ?>" aria-selected="<?php echo $first ? 'true' : 'false'; ?>"><?php echo $class_name; ?></button>
                            </li>
                    <?php
                            $first = false;
                        }
                    } else {
                        echo "No classes found for this teacher.";
                    }
                    ?>
                </ul>
                <div class="tab-content" id="classTabsContent">
                    <?php
                    // Reset the pointer in the result set
                    mysqli_data_seek($class_result, 0);

                    if (mysqli_num_rows($class_result) > 0) {
                        $first = true;
                        while ($class_row = mysqli_fetch_assoc($class_result)) {
                            $class_id = $class_row['id'];
                            // Setting the first tab pane as active
                            $active = $first ? 'active show' : '';
                        
                            $student_sql = "SELECT user.firstname, user.email ,user.id ,user.lastname FROM tbl_student_class INNER JOIN user ON tbl_student_class.student_id = user.id WHERE tbl_student_class.class_id = '$class_id'";
                            $student_result = mysqli_query($con, $student_sql);
                    ?>
                          <div class="tab-pane fade <?php echo $active; ?>" id="class-<?php echo $class_id; ?>" role="tabpanel" aria-labelledby="class-<?php echo $class_id; ?>-tab">
                                <div class="card mt-2 shadow-md">
                                    <div class="card-body">
                                        <h3 class="card-title">Class Information</h3>
                                        <p class="card-text"><strong>Class Name:</strong> <?php echo $class_row['class_name']; ?></p>
                                        <p class="card-text"><strong>Class Code:</strong> <?php echo $class_row['class_code']; ?></p>
                                        <!-- Add more class information as needed -->
                                    </div>
                                </div>
                                &nbsp;
                                <h3>Students in This Class</h3>
                                <?php
                                if (mysqli_num_rows($student_result) > 0) {
                                ?>
                                <div class="shadow-lg col-md-12 px-2 py-1 rounded p-2">
                                    <table id="studentTable-<?php echo $class_id; ?>" class="table">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Status</th> <!-- New column for status -->
                                                <!-- Add more table headers if needed -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($student_row = mysqli_fetch_assoc($student_result)) {
                                                // Query to check if the student has responded to the instructor
                                                $student_id = $student_row['id'];
                                                $response_query = "SELECT * FROM tbl_responses WHERE student_id = '$student_id' AND teacher_id = '$teacher_id'";
                                                $response_result = mysqli_query($con, $response_query);
                                                $status = mysqli_num_rows($response_result) > 0 ? "Responded" : "Not Responded";
                                                $status_color = $status === "Responded" ? "text-success" : "text-danger"; // Define text color based on status
                                            ?>
                                                <tr>
                                                    <td><?php echo $student_row['firstname']; ?></td>
                                                    <td><?php echo $student_row['lastname']; ?></td>
                                                    <td><?php echo $student_row['email']; ?></td>
                                                    <td class="fw-bold <?php echo $status_color; ?>"><?php echo $status; ?></td> <!-- Display status with color -->
                                                    <!-- Add more table cells if needed -->
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    </div>
                                <?php
                                } else {
                                    echo "No students found for this class.";
                                }
                                ?>
                            </div>
                    <?php
                            $first = false;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        </div>
                   
    <!-- Your custom scripts -->
    <script src="../admin/script.js"></script>
    <script>
       new DataTable('#example');
    </script>
   <script>
    $(document).ready(function() {
        // Initialize DataTable for each table
        <?php
        mysqli_data_seek($class_result, 0);
        while ($class_row = mysqli_fetch_assoc($class_result)) {
            $class_id = $class_row['id'];
        ?>
            $('#studentTable-<?php echo $class_id; ?>').DataTable();
        <?php
        }
        ?>
    });
</script>
</body>

</html>
<?php
} else {
    echo "Teacher ID not provided.";
}
?>