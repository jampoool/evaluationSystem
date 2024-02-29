<?php 
    include "../connect.php";
    session_start();

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <style>
   
   </style>

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
            </ul>
            <div class="sidebar-footer">
                <a href="../logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
    
        <div class="main" style="background-color: #F5F5F5;">
            <nav class="navbar navbar-expand px-1 py-2 shadow p-1 mb-3 bg-body roundedsticky-top">
                <form action="#" class="d-none d-sm-inline-block">
                </form>
                <div class="navbar-collapse">
                    <label>Faculty Evaluation System</label>
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
            <div id="page-content" class="col-md-12 px-5 py-1" >
            <div class="row">
            <div class="container-fluid shadow p-3 mb-5 bg-body rounded ">
        <div class="d-grid gap-2 col-2 mx-2">
            <h5>
                <?php
                    //  var_dump($_SESSION);
                ?>
                <p class="font-monospace "  style=" font-size: 20px !important;">Manage User</p>
            </h5>
        </div>
        
            <button type="button" class="btn btn-primary mx-auto "  style=" font-size: 12px !important;" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop">
            <i class="fa-solid fa-plus"></i>
            Add User
            </button>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-element">
                            <form class="row g-3" method="POST">
                                <div class="col-5">
                                    <label for="inputID4" class="form-label">Guidance ID</label>
                                    <input type="text" class="form-control" id="inputID4" name="user_id">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="inputPassword4" name="password">
                                </div>
                                <div class="col-12">
                                    <label for="inputType" class="form-label">Type</label>
                                    <select id="inputType" class="form-select" name="type">
                                        <option selected>Choose...</option>
                                        <option value="admin">Admin</option>
                                        <option value="guidance">Guidance</option>
                                        <option value="student">Student</option>
                                        <option value="teacher">Teacher</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="inputDepartment" class="form-label">Department</label>
                                    <select id="inputDepartment" class="form-select" name="department">
                                        <option selected>Choose...</option>
                                        <option value="1">Basic Education Department</option>
                                        <option value="2">Higher Education Department</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                    <button id="saveChangesBtn" class="btn btn-primary" name="save_changes">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body gap-3">
                        <?php include "editdata.php"; 
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
            <div class="mt-3"></div>
            <div class="table-responsive">
        <table id="example" class="table table-striped" style="width:100%; font-size: 12px !important;">
            <thead>
                <tr>
                    <th style="display:none;">No.</th>
                    <th>No.</th>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Department</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqlquery = mysqli_query($con, "SELECT * FROM user ORDER BY id DESC;");
                $i = 1;
                while ($rows = mysqli_fetch_array($sqlquery)) {
                ?>
                <tr class="mt-4">
                     <td><?php echo $i++; ?></td>
                    <td style="display:none;"><?php echo $rows['id']; ?></td>
                    <td><?php echo $rows['user-id']; ?></td>
                    <td><?php echo $rows['email']; ?></td>
                    <td><?php echo $rows['type']; ?></td>
                    <td><?php echo ($rows['department'] == 1) ? 'Basic Education Department' : 'Higher Education
                        Department'; ?></td>
                    <td><?php echo $rows['date_created']; ?></td>
                    <td><?php echo $rows['date_updated']; ?></td>
                    <td>
                    <div class="d-inline d-lg-none">
                            <button class="btn btn-primary btn-sm" id="ellipsisButton">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="ellipsis-menu" style="display: none;">
                                <button type="button" class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" style="font-size: 12px !important;"
                                    data-bs-target="#editModal" data-user-id="<?php echo $rows['user-id']; ?>">Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm delete-btn" style="font-size: 12px !important;" data-id="<?php echo $rows['id']; ?>">Delete</button>
                            </div>
                        </div>

                        <div class="d-none d-lg-inline">
                            <button type="button" class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" style="font-size: 12px !important;"
                                data-bs-target="#editModal" data-user-id="<?php echo $rows['user-id']; ?>">Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-sm delete-btn" style="font-size: 12px !important;" data-id="<?php echo $rows['id']; ?>">Delete</button>
                        </div>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
            </div>
           
        </div>
            </div>
        </div>
    </div>
     <script src="manageUser.js"></script>
                <script> $(document).ready(function () {
        $("#ellipsisButton").on("click", function () {
            $(".ellipsis-menu").toggle();
        });
    });</script>
    <!-- Your custom scripts -->
    <script src="script.js">
    </script> 
</body>

</html>
