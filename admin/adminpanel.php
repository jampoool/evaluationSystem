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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Your custom CSS -->
    <link rel="stylesheet" href="css/dashboard.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/658ff99b54.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
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
                    <a href="admin/dashboard" class="sidebar-link active" id="dashboard-link">
                        <i class="fa-solid fa-table-cells-large"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="admin/profile" class="sidebar-link" id="profile-link">
                        <i class="fa-solid fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="admin/manageUser" class="sidebar-link" id="manage-user-link">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Manage User</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="admin/class" class="sidebar-link" id="class-link">
                        <i class="fa-solid fa-house-user"></i>
                        <span>Class</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/studentClasses" class="sidebar-link" id="student-classes-link">
                        <i class="fa-solid fa-circle-plus"></i>
                        <span>Student Classes</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3 shadow p-3 mb-5 bg-body rounded">
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

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-4">
                <!-- Content will be dynamically loaded here -->
            </main>
        </div>
    </div>
    <!-- Your custom scripts -->
    <script src="script.js"></script>
    <script>
        $(document).ready(function () {
            $(".sidebar-link").click(function (event) {
                event.preventDefault();

                var linkId = $(this).attr("id");
                var url = '';

                switch (linkId) {
                    case 'dashboard-link':
                        url = 'dashboard.php';
                        break;
                    case 'profile-link':
                        url = 'profile.php';
                        break;
                    case 'manage-user-link':
                        url = 'manageUser.php';
                        break;
                    case 'class-link':
                        url = 'manageClass.php';
                        break;
                    case 'student-classes-link':
                        url = 'manageStudentClasses.php';
                        break;
                    // Add more cases for additional links
                }

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function (data) {
                        $('main.content').html(data);
                        // Change the URL
                        window.history.pushState("", "", linkId);
                    },
                    error: function () {
                        alert('Error loading content.');
                    }
                });
            });
        });
    </script>
</body>

</html>
