<?php
    include "../connect.php";
    session_start();
if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'guidance') {
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

</head>

<body>
    <div class="wrapper">
    <aside id="sidebar">
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
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
    
        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3 shadow p-3 mb-5 bg-body roundedsticky-top">
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
            <div id="page-content" class="container-lg" >
                 <div class="row">
                   <h1>Report</h1>
                </div>
            </div>
        </div>
    </div>
    
    

    <!-- Your custom scripts -->
    <script src="../admin/script.js"></script>
    <script>
       new DataTable('#example');
    </script>
</body>

</html>
