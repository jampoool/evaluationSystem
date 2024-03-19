<?php
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
        body {
            background-color: #f5f5f5;
        }
        .profile-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .social-links a {
            font-size: 20px;
            color: #333;
            margin-right: 10px;
        }
        .nav-tabs {
            border-bottom: none;
        }
        .nav-tabs .nav-link {
            border: none;
            border-radius: 0;
            padding: 15px 20px;
            background-color: transparent;
            color: #333;
            font-weight: 600;
        }
        .nav-tabs .nav-link.active {
            background-color: #fff;
            border: none;
            border-bottom: 3px solid #007bff;
            color: #007bff;
        }
        .label {
            font-weight: 600;
            color: #555;
        }
        @media (max-width: 768px) {
            .profile-card {
                padding: 20px;
            }
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
                    <a href="dashboard.php" class="sidebar-link">
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
    
        <div class="main" style="background-color: #F5F5F5;">
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

            <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow profile-card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Profile Settings</h2>
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered justify-content-center mb-4">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">About Me</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>
                        </ul>

                        <div class="tab-content pt-3">
                            <!-- About Me -->
                            <div class="tab-pane fade show active" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>
                                &nbsp;
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                                    <div class="col-lg-9 col-md-8">John Doe</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8">123 Main Street, City, Country</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">123-456-7890</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">john.doe@example.com</div>
                                </div>
                            </div>

                            <!-- Edit Profile -->
                            <div class="tab-pane fade" id="profile-edit">
                                <!-- Profile Edit Form -->
                                <form>
                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-form-label">Full Name</label>
                                        <div class="col-md-8">
                                            <input name="fullName" type="text" class="form-control" id="fullName">
                                        </div>
                                    </div>
                                    <!-- Other fields -->
                                </form>
                            </div>

                            <!-- Change Password -->
                            <div class="tab-pane fade" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form>
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-form-label">Current Password</label>
                                        <div class="col-md-8">
                                            <input name="currentPassword" type="password" class="form-control" id="currentPassword">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-form-label">New Password</label>
                                        <div class="col-md-8">
                                            <input name="newPassword" type="password" class="form-control" id="newPassword">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="confirmPassword" class="col-md-4 col-form-label">Confirm Password</label>
                                        <div class="col-md-8">
                                            <input name="confirmPassword" type="password" class="form-control" id="confirmPassword">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- End tab content -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Your custom scripts -->
    <script src="script.js"></script>
    <script>
       
    </script>
</body>

</html>
