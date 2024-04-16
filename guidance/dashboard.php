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

<style>
    body {
        background:#FAFAFA;
    }

    .order-card {
        color: #fff;
    }

    .bg-c-blue {
        background: linear-gradient(45deg,#4099ff,#73b4ff);
    }

    .bg-c-green {
        background: linear-gradient(45deg,#2ed8b6,#59e0c5);
    }

    .bg-c-yellow {
        background: linear-gradient(45deg,#FFB64D,#ffcb80);
    }

    .bg-c-pink {
        background: linear-gradient(45deg,#FF5370,#ff869a);
    }

    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .card .card-block {
        padding: 25px;
    }

    .order-card i {
        font-size: 26px;
    }

    .f-left {
          float: left;
      }

      .f-right {
          float: right;
      }
      #card{
        background-color: #1F2377;
      }
      path{
         background-color: #1F2377;
      }
    @media (min-width:992px) {
        .page-container {
            max-width: 1140px;
            margin: 0 auto
        }

        .page-sidenav {
            display: block !important
        }
    }

    .padding {
        padding: 2rem
    }

    .w-32 {
        width: 32px !important;
        height: 32px !important;
        font-size: .85em
    }

    .tl-item .avatar {
        z-index: 2
    }

    .circle {
        border-radius: 500px
    }

    .gd-warning {
        color: #fff;
        border: none;
        background: #f4c414 linear-gradient(45deg, #f4c414, #f45414)
    }

    .timeline {
        position: relative;
        border-color: rgba(160, 175, 185, .15);
        padding: 0;
        margin: 0
    }

    .p-4 {
        padding: 1.5rem !important
    }

    .block,
    .card {
        background: #fff;
        border-width: 0;
        border-radius: .25rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
        margin-bottom: 1.5rem
    }

    .mb-4,
    .my-4 {
        margin-bottom: 1.5rem !important
    }
</style>

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
                <li class="sidebar-item" >
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
            <nav class="navbar navbar-expand px-2 py-2 shadow p-3 mb-5 bg-body rounded sticky-top">
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
            <div class="col-md-12 px-5 py-2">
                <div class="row shadow-sm p-2 mb-2 bg-white rounded">
                <div class="col-md-4 col-xl-3">
                        <div class="card order-card" id="card">
                            <div class="card-block">
                            <h6 class="m-b-20">Total Students</h6>
                                <h2 class="text-right"><i class="bi bi-person"></i> <span> 
                                         <?php
                                                $sql = "SELECT * from user where type='student'";
                                                if ($result = mysqli_query($con, $sql)) {
                                                
                                                    // Return the number of rows in result set
                                                    $rowcount = mysqli_num_rows( $result );
                                                    
                                                    // Display result
                                                    printf(" %d\n", $rowcount);
                                                }
                                             ?>
                                        </span></h2>
                                <a href="#" id="view" class="text-decoration-underline d-block mt-1 f-right" style="font-size: 13px;color: white; transition: text-decoration 0.5s;">View Details <i class="bi bi-arrow-right" style="font-size: 10px;"></i></a>
                            </div>
                        </div>
                     </div>
                    
                    <div class="col-md-4 col-xl-3">
                        <div class="card order-card" id="card">
                            <div class="card-block">
                                <h6 class="m-b-20">Total Guidance</h6>
                                <h2 class="text-right"><i class="bi bi-person"></i> <span>
                                         <?php
                                                $sql = "SELECT * from user where type='Guidance'";
                                                if ($result = mysqli_query($con, $sql)) {
                                                
                                                    // Return the number of rows in result set
                                                    $rowcount = mysqli_num_rows( $result );
                                                    
                                                    // Display result
                                                    printf(" %d\n", $rowcount);
                                                }
                                             ?>
                                </span></h2>
                                <a href="#" id="view" class="text-decoration-underline d-block mt-1 f-right" style="font-size: 13px;color: white; transition: text-decoration 0.5s;">View Details <i class="bi bi-arrow-right" style="font-size: 10px;"></i></a>
                           </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-xl-3">
                        <div class="card order-card" id="card">
                            <div class="card-block">
                                <h6 class="m-b-20">Total Teacher</h6>
                                <h2 class="text-right"><i class="bi bi-person"></i> <span>
                                        <?php
                                                $sql = "SELECT * from user where type='teacher'";
                                                if ($result = mysqli_query($con, $sql)) {
                                                
                                                    // Return the number of rows in result set
                                                    $rowcount = mysqli_num_rows( $result );
                                                    
                                                    // Display result
                                                    printf(" %d\n", $rowcount);
                                                }
                                             ?>
                                </span></h2>
                                <a href="#" id="view" class="text-decoration-underline d-block mt-1 f-right" style="font-size: 13px;color: white; transition: text-decoration 0.5s;">View Details <i class="bi bi-arrow-right" style="font-size: 10px;"></i></a>
                          </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-xl-3">
                        <div class="card order-card" id="card">
                            <div class="card-block">
                                <h6 class="m-b-20">Total Admin</h6>
                                <h2 class="text-right"><i class="bi bi-person"></i> <span>
                                         <?php
                                                $sql = "SELECT * from user where type='admin'";
                                                if ($result = mysqli_query($con, $sql)) {
                                                
                                                    // Return the number of rows in result set
                                                    $rowcount = mysqli_num_rows( $result );
                                                    
                                                    // Display result
                                                    printf(" %d\n", $rowcount);
                                                }
                                             ?>
                                </span></h2>
                                <a href="#" id="view" class="text-decoration-underline d-block mt-1 f-right" style="font-size: 13px;color: white; transition: text-decoration 0.5s;">View Details <i class="bi bi-arrow-right" style="font-size: 10px;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                  <!-- Begin Page Content -->
        <div class="col-md-12 mt-4">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Student Respondent</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <?php
                        // Execute the SQL query
                            $sql = "SELECT
                            GROUP_CONCAT(DISTINCT u.firstname ORDER BY u.firstname ASC) AS student_firstname,
                            GROUP_CONCAT(DISTINCT u.lastname ORDER BY u.lastname ASC) AS student_lastname,
                            GROUP_CONCAT(DISTINCT u2.firstname ORDER BY u2.firstname ASC) AS instructor_firstname,
                            GROUP_CONCAT(DISTINCT u2.lastname ORDER BY u2.lastname ASC) AS instructor_lastname,
                            c.class_code
                            FROM
                            user u
                            JOIN
                            tbl_responses tr ON u.id = tr.student_id
                            JOIN
                            tbl_student_class sc ON u.id = sc.student_id
                            JOIN
                            tbl_class c ON sc.class_id = c.id
                            JOIN
                            user u2 ON c.instructor_id = u2.id
                            WHERE
                            u.type = 'student'
                            GROUP BY
                            c.class_code";

                            $result = $con->query($sql);

                            // Generate the HTML table
                            if ($result->num_rows > 0) {
                            echo '<table id="assignedTeacher" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>Student Name</th>';
                            echo '<th>Instructor Name</th>';
                            echo '<th>Class Code</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row["student_firstname"] . ' ' . $row["student_lastname"] . '</td>';
                            echo '<td>' . $row["instructor_firstname"] . ' ' . $row["instructor_lastname"] . '</td>';
                            echo '<td>' . $row["class_code"] . '</td>';
                            echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                            } else {
                            echo "0 results";
                            }

                            // Close conection
                            $con->close();
                            ?>
                        </div>
                    </div>
                </div>

                </div>
    <!-- /.container-fluid -->

                </div>
  <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Evaluation System 2024</span>
                    </div>
                </div>
            </footer>
    <script src="../admin/script.js"></script>
    

    <script>
       new DataTable('#assignedTeacher');
    </script>
</body>

</html>
