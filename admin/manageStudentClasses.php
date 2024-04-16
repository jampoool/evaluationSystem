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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <!-- Your custom CSS -->
    <link rel="stylesheet" href="css/dashboard.css">
    
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   
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
                <!-- <li class="sidebar-item">
                    <a href="profile.php" class="sidebar-link">
                        <i class="fa-solid fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li> -->
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
                <!-- <li class="sidebar-item">
                    <a href="report.php" class="sidebar-link">
                        <i class="fa-solid fa-circle-plus"></i>
                        <span>Report</span>
                    </a>
                </li> -->

            </ul>
            <div class="sidebar-footer">
                <a href="../logout.php" class="sidebar-link">
                <i class="fas fa-sign-out-alt"></i>
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
            <h5>
                                <small class="text-muted p-5">Assign Student in a Class</small>
                            </h5>
        <div id="page-content" class="col-md-12 px-5 py-1" >
            <div class="row">
                   <div class="shadow p-3 mb-5 bg-body rounded ">

                   <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="staticBackdropLabel">Assign Student in a Class</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <form id="teacherForm" method="POST">
                                                <label class="form-label">Class</label>
                                                <select id="classID" name="classID" class="form-select" aria-label="Default select example">
                                                    <option selected disabled>Choose</option>
                                                    <?php
                                                        $sqlquery = mysqli_query($con, "SELECT * FROM tbl_class");
                                                        while($row = mysqli_fetch_array($sqlquery)) {
                                                    ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['class_code'].'-'.$row['class_name']; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                        </div>
                                        <div class="col-md-8">
                                            <table id="studentTable" class="table table-striped table-hover" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                    <input type="checkbox" id="checkAllStudents"><span>Check All</span>
                                                        &nbsp;
                                                        <th>Email</th>
                                                        <th>Assign</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sqlquery = mysqli_query($con, "SELECT * FROM user WHERE type='student'");
                                                    while ($row = mysqli_fetch_array($sqlquery)) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $row['email']; ?></td>
                                                            <td><input type="checkbox" class="assign-checkbox" value="<?php echo $row['id']; ?>"></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button id="assignStudentsBtn" class="btn btn-primary" name="save_changes">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                                    <!-- edit modal -->
                                    <div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Subject</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <table id="studentsTable" class="table" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Student ID</th>
                                                            <th>Email</th>
                                                            <th>Department</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Table body content will be dynamically generated by DataTables -->
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <button type="button" class="btn btn-primary mx-auto" style="font-size: 12px !important;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <i class="fa-solid fa-plus"></i> Assign Student
                                    </button>

                                    <div class="mt-2"></div>

                                    <div class="table-responsive">
                                    <table id="example" class="table table-striped" style="width:100%; font-size: 14px !important;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Class</th>
                                            <th>Status</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch distinct class IDs from tbl_student_class
                                        $sqlquery = mysqli_query($con, "SELECT DISTINCT class_id FROM tbl_student_class ORDER BY id DESC;");
                                        $i = 1;
                                        while ($classRow = mysqli_fetch_array($sqlquery)) {
                                            // Get class details for each class ID
                                            $classID = $classRow['class_id'];
                                            $classDetailsQuery = mysqli_query($con, "SELECT class_code, class_name, is_active, created_at FROM tbl_class WHERE id = $classID");
                                            $classDetails = mysqli_fetch_assoc($classDetailsQuery);
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $classDetails['class_code'] . '-' . $classDetails['class_name']; ?></td>
                                                <td><?php echo ($classDetails['is_active'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                                <td><?php echo date('F j, Y, g:i A', strtotime($classDetails['created_at'])); ?></td>
                                                <td>
                                                    <div class="d-inline d-lg-none">
                                                        <button class="btn btn-primary btn-sm" id="ellipsisButton">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="ellipsis-menu" style="display: none;">
                                                            <!-- Place the button outside of the loop -->
                                                            <button type="button" class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-class-id="<?php echo $classID; ?>">View Students</button>
                                                        </div>
                                                    </div>
                                                    <div class="d-none d-lg-inline">
                                                        <!-- Place the button outside of the loop -->
                                                        <button type="button" class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-class-id="<?php echo $classID; ?>">View Students</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>le>
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>
    </div>
       
    
    <!-- Your custom scripts -->
    <script src="script.js"></script>

    <script>

$(document).ready(function () {
    $('#example').DataTable();
    

    // Event listener for button click to fetch students
    $(document).on('click', '.edit-btn', function () {
    var studentClassesID = $(this).data('class-id');

    // Destroy the existing DataTable instance, if any
    if ($.fn.DataTable.isDataTable('#studentsTable')) {
        $('#studentsTable').DataTable().destroy();
        $('#studentsTable tbody').empty(); // Clear the table body
    }

    $.ajax({
        type: 'POST',
        url: 'fetch_students.php',
        data: { studentClassesID: studentClassesID },
        dataType: 'json',
        success: function (response) {
            response.forEach(function(student) {
                // Convert department ID to department name
                student.department = (student.department == 1) ? 'Basic Education' : 'Higher Education';
            });

            $('#studentsTable').DataTable({
                data: response,
                columns: [
                    { data: 'user-id' },
                    { data: 'email' },
                    { data: 'department' },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return '<button class="btn btn-danger remove-btn" data-studentclass-id="' + data['classID'] + '">Remove</button>';
                        }
                    }
                ]
            });
        },
        error: function (xhr, status, error) {
            // Handle error
            console.log(error);
        }
    });
});

        $(document).on('click', '.remove-btn', function (event) {
            event.preventDefault();
            var studentClassID = $(this).data('studentclass-id');
            console.log(studentClassID);
            Swal.fire({
                title: 'Are you sure to remove this?',
                text: 'You will not be able to recover this category!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: 'remove_students.php',
                        data: {
                            studentClassID: studentClassID
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'An error occurred while deleting the Class. Please try again.'
                            });
                        }
                    });
                }
            });
        });


    $("#assignStudentsBtn").click(function (event) {
        event.preventDefault();

        // Get the selected classID
        var classID = $("#classID").val();

        // Get all checked checkboxes
        var studentIDs = [];
        $(".assign-checkbox:checked").each(function () {
            studentIDs.push($(this).val());
        });

        // AJAX request to send classID and classIDs to the PHP script
        $.ajax({
            type: "POST",
            url: "save_assign_students.php",
            data: {
                classID: classID,
                studentIDs: studentIDs,
                save_changes: true // Ensure this is set
            },
            success: function (response) {
                console.log(response);
                if (response === 'already_enrolled') {
                    // Show SweetAlert notification for already enrolled students
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning!',
                        text: 'One or more selected students are already enrolled in this class.',
                    });
                } else if (response === 'success') {
                    // Show SweetAlert notification for success
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Assigning saved successfully!',
                    }).then(function () {
                        // Hide modal after showing the SweetAlert
                        $('#staticBackdrop').modal('hide');
                        $('.modal-backdrop').remove();
                        location.reload();
                    });
                } else {
                    // Show SweetAlert notification for unexpected response
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Unexpected response from the server.',
                    });
                }
            },
            error: function (xhr, status, error) {
                // Show SweetAlert notification for error
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while saving assignments.',
                });
            }
        });
    });
});


    const checkAllCheckbox = document.getElementById('checkAllStudents');
    const assignCheckboxes = document.querySelectorAll('.assign-checkbox');

    // Function to check/uncheck all checkboxes
    function toggleCheckboxes(checked) {
        assignCheckboxes.forEach(function (checkbox) {
            checkbox.checked = checked;
        });
    }
    // Event listener for the "Check All" checkbox
    checkAllCheckbox.addEventListener('change', function () {
        toggleCheckboxes(this.checked);
    });


    </script>
</body>

</html>
