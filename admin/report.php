<?php

include "../connect.php";
session_start();
if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
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
    <link rel="stylesheet" href="css/dashboard.css">
    
    
     <!-- DataTables CSS -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
         <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
     <!-- Font Awesome -->
     <script src="https://kit.fontawesome.com/658ff99b54.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   
    <style>
        .card {
            border: none;
            border-radius: 15px;
            background-color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-weight: bold;
        }

        .card-text {
            color: #555555;
        }

        .assign-btn {
            background-color: #007bff;
            border: none;
        }

        .assign-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="wrapper">
    <aside id="sidebar"  class="expand">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Faculty Evaluation System</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item ">
                    <a href="dashboard.php" class="sidebar-link active">
                        <i class="fa-solid fa-table-cells-large"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="profile.php" class="sidebar-link">
                        <i class="fa-solid fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="manageUser.php" class="sidebar-link">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Manage User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="manageSubject.php" class="sidebar-link">
                        <i class="fa-solid fa-house-user"></i>
                        <span>Subject</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="manageClass.php" class="sidebar-link">
                        <i class="fa-solid fa-house-user"></i>
                        <span>Class</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="manageStudentClasses.php" class="sidebar-link">
                        <i class="fa-solid fa-circle-plus"></i>
                        <span>Student Classes</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="report.php" class="sidebar-link">
                        <i class="fa-solid fa-circle-plus"></i>
                        <span>Report</span>
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
            <div class="container">
                <div class="row row-cols-1 row-cols-md-3 g-4" id="page-content">
                    <?php

                        // Fetch entries from tbl_class along with instructor email from user table
                        $query = "SELECT tbl_class.*, user.email AS instructor_email FROM tbl_class JOIN user ON tbl_class.instructor_id = user.id";
                        $result = mysqli_query($con, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            // Loop through the results and add each entry to the classEntries array
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<div class="col">';
                                echo '<div class="card">';
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title">' . $row['class_name'] . '</h5>';
                                echo '<p class="card-text">Class Code: ' . $row['class_code'] . '</p>';
                                echo '<p class="card-text">Instructor Email: ' . $row['instructor_email'] . '</p>';
                                echo '<button class="btn btn-primary assign-btn" data-class-id="' . $row['id'] . '">Assign Students</button>';
                                echo '</div></div></div>';
                            }
                        } else {
                            echo '<div class="col">';
                            echo '<p>No class entries found.</p>';
                            echo '</div>';
                        }

                        // Close the database connection
                        ?>
                </div>
            </div>


        </div>
            </div>
        </div>
    </div>
      <!-- Modal for assigning students -->
      <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignModalLabel">Assign Students</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                       <!-- DataTable container -->
                    <table id="studentTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Student ID</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                     
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Assign</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '.assign-btn', function () {
            var classId = $(this).data('class-id');

            // Make an AJAX call to fetch data for the DataTable
            $.ajax({
                url: 'fetch_students.php', // Replace with the actual PHP script that fetches student data
                type: 'POST',
                data: { classId: classId },
                dataType: 'json',
                success: function (response) {
                    // Populate DataTable with retrieved data
                    var table = $('#studentTable').DataTable();
                    table.clear().draw();
                    $.each(response, function (index, data) {
                        table.row.add([
                            index + 1,
                            data.user-id,
                            data.email
                        ]).draw(false);
                    });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            // Show the modal
            $('#assignModal').modal('show');
        });

        // Event listener for the modal assign button click
        $('#assignModal').on('click', '.btn-primary', function () {
            // Retrieve the class ID stored in the modal's data attribute
            var classId = $('#assignModal').data('class-id');

            // Perform actions with the class ID, such as assigning students
            console.log('Assign students for class ID:', classId);

            // Close the modal if needed
            $('#assignModal').modal('hide');
        });
    </script>

    <!-- Your custom scripts -->
    <script src="script.js"></script>
</body>

</html>
