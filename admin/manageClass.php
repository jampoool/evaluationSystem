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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
        .btn-outline-primary.active {
            background-color: #007bff;
            color: #fff;
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
            <h5>
                <small class="text-muted p-5">Manage Class</small>
            </h5>
<div id="page-content" class="col-md-12 px-5 py-1" >
  <div class="row">
    <div class="shadow p-3 mb-5 bg-body rounded ">
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Manage Class</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Buttons to toggle between tables -->
                                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-primary" id="classTable">Class Table</button>
                                    <button type="button" class="btn btn-outline-primary" id="teacherTable">Teacher Table</button>
                                    <button type="button" class="btn btn-outline-primary" id="subjectTable">Subject Table</button>
                                </div>
                                <div class="classTableContainer">
                                <div class="col-6">
                                    <label for="add_code" class="form-label">Class Code</label>
                                    <input type="text" class="form-control" id="add_code" name="add_code">
                                </div>
                                <div class="col-6">
                                        <label for="add_name" class="form-label">Class Name</label>
                                        <input type="text" class="form-control" id="add_name" name="add_name">
                                </div>
                                </div>
                                <!-- Table for Teachers -->
                                <div id="teacherTableContainer" style="display: none;">
                                    <table class="table table-bordered table-responsive" id="teacherTableContent">
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>
                                                    <label class="form-check-label">
                                                        Action
                                                    </label>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Add teacher table data here -->
                                            <?php
                                            $sqlquery = mysqli_query($con, "SELECT * FROM user WHERE type='teacher'");
                                            while ($row = mysqli_fetch_array($sqlquery)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><input type="checkbox" class="assign-checkbox" id="updateTeacherID"
                                                        value="<?php echo $row['id']; ?>"> <label> Assign</label></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Table for Subjects -->
                                <div id="subjectTableContainer" style="display: none;">
                                    <table class="table table-bordered table-responsive" id="subjectTableContent">
                                        <thead>
                                            <tr>
                                                <th>Subject Code</th>
                                                <th>Subject Name</th>
                                                <th>
                                                    <label class="form-check-label">
                                                        Action
                                                    </label>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sqlquery = mysqli_query($con, "SELECT * FROM tbl_subject");
                                            while ($row = mysqli_fetch_array($sqlquery)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['subject_code']; ?></td>
                                                <td><?php echo $row['subject_name']; ?></td>
                                                <td><input type="checkbox" class="assign-checkbox" id="updateSubjectID"
                                                        value="<?php echo $row['id']; ?>"><label> Assign</label></td>
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
                    <div class="modal-footer">
                        <div class="ms-auto">
                            <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm rounded-pill" form="add_class" id="saveChangesBtn" name="save_changes">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Edit Modal -->
            <div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Subject</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Buttons to toggle between tables -->
                                    <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-primary" id="editClassTable">Class Table</button>
                                        <button type="button" class="btn btn-outline-primary" id="editTeacherTable">Teacher Table</button>
                                        <button type="button" class="btn btn-outline-primary" id="editSubjectTable">Subject Table</button>
                                    </div>
                                    <div class="updateClassTableContainer">
                                        <div class="col-6">
                                            <input type="text" hidden id="classID">
                                            <label for="edit_code" class="form-label">Class Code</label>
                                            <input type="text" class="form-control" id="edit_code" name="edit_code">
                                        </div>
                                        <div class="col-6">
                                            <label for="edit_name" class="form-label">Class Name</label>
                                            <input type="text" class="form-control" id="edit_name" name="edit_name">
                                        </div>
                                    </div>
                                    <!-- Table for Teachers -->
                                    <div id="updateTeacherTableContainer" style="display: none;">
                                        <table class="table table-bordered table-responsive" id="teacherTableContentUpdate">
                                            <thead>
                                                <tr>
                                                    <th>Email</th>
                                                    <th>
                                                        <label class="form-check-label">Action</label>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Add teacher table data here -->
                                                <?php
                                                $sqlquery = mysqli_query($con, "SELECT * FROM user WHERE type='teacher'");
                                                while ($row = mysqli_fetch_array($sqlquery)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['email']; ?></td>
                                                        <td><input type="checkbox" class="assign-checkbox" value="<?php echo $row['id']; ?>"> <label> Assign</label></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Table for Subjects -->
                                    <div id="updateSubjectTableContainer" style="display: none;">
                                        <table class="table table-bordered table-responsive" id="subjectTableContentUpdate">
                                            <thead>
                                                <tr>
                                                    <th>Subject Code</th>
                                                    <th>Subject Name</th>
                                                    <th>
                                                        <label class="form-check-label">Action</label>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sqlquery = mysqli_query($con, "SELECT * FROM tbl_subject");
                                                while ($row = mysqli_fetch_array($sqlquery)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['subject_code']; ?></td>
                                                        <td><?php echo $row['subject_name']; ?></td>
                                                        <td><input type="checkbox" class="assign-checkbox" value="<?php echo $row['id']; ?>"><label> Assign</label></td>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="updateBtn" class="btn btn-primary" name="update">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

                                
                            <button type="button" class="btn btn-primary mx-auto" style="font-size: 12px !important;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="fa-solid fa-plus"></i> Add Category
                            </button>

                            <div class="mt-2"></div>

                            <div class="table-responsive">
                                <table id="example" class="table table-striped" style="width:100%; font-size: 12px !important;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Class</th>
                                            <th>Instructor</th>
                                            <th>Subject</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlquery = mysqli_query($con, "SELECT * FROM tbl_class ORDER BY id DESC;");
                                        $i = 1;
                                        while ($rows = mysqli_fetch_array($sqlquery)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $rows['class_code'].' - '.$rows['class_name'] ?></td>
                                            <td>
                                                <?php 
                                                // Fetching email of teacher from user based on instructor_id
                                                $teacherID = $rows['instructor_id'];
                                                $teacherQuery = mysqli_query($con, "SELECT email FROM user WHERE id = $teacherID");
                                                $teacherRow = mysqli_fetch_assoc($teacherQuery);
                                                echo $teacherRow['email'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                // Fetching email of teacher from user based on instructor_id
                                                $subjectID = $rows['subject_id'];
                                                $subjectQuery = mysqli_query($con, "SELECT subject_code, subject_name FROM tbl_subject WHERE id = $subjectID");
                                                $subjectRow = mysqli_fetch_assoc($subjectQuery);
                                                echo $subjectRow['subject_code'].' - '. $subjectRow['subject_name'] ;
                                                ?>
                                            </td>
                                            <td><?php echo ($rows['is_active'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                            <td><?php echo date('F j, Y, g:i A', strtotime($rows['created_at'])); ?></td>
                                            <td>
                                                <div class="d-inline d-lg-none">
                                                    <button class="btn btn-primary btn-sm" id="ellipsisButton">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="ellipsis-menu" style="display: none;">
                                                        <button type="button" class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-class-id="<?php echo $rows['id']; ?>">Edit</button>
                                                        <button type="button" class="btn btn-danger btn-sm delete-btn" data-subject-id="<?php echo $rows['id']; ?>">Delete</button>
                                                    </div>
                                                </div>
                                                <div class="d-none d-lg-inline">
                                                    <button type="button" class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-class-id="<?php echo $rows['id']; ?>">Edit</button>
                                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-class-id="<?php echo $rows['id']; ?>">Delete</button>
                                                </div>
                                            </td>
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
            </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script>
   
            </script>                                           
    <!-- Your custom scripts -->
        <script src="script.js"></script>
        <script>
        new DataTable('#example');
        
        </script>

        <script>
         $(document).ready(function () {
                // Initialize DataTable for each table
                $('#teacherTableContent').DataTable({
                    "pageLength": 5 // Set the limit to 5 entries per page
                });

                $('#subjectTableContent').DataTable({
                    "pageLength": 5 // Set the limit to 5 entries per page
                });
                $('#teacherTableContentUpdate').DataTable({
                    "pageLength": 5 // Set the limit to 5 entries per page
                });

                $('#subjectTableContentUpdate').DataTable({
                    "pageLength": 5 // Set the limit to 5 entries per page
                });
                // Show/hide tables and fields based on button clicks
                $('#classTable').click(function () {
                    $('#teacherTableContainer').hide();
                    $('#subjectTableContainer').hide();
                    $('#classTableContainer').show();
                    $('.classTableContainer').show();  // Show subject code and subject name fields
                    $('#add_code, #add_name').prop('disabled', false);  // Enable the fields

                    // Add active class to the clicked button and remove it from others
                    $(this).addClass('active').siblings().removeClass('active');
                });

                $('#teacherTable').click(function () {
                    $('#classTableContainer').hide();
                    $('#subjectTableContainer').hide();
                    $('#teacherTableContainer').show();
                    $('.classTableContainer').hide();  // Hide subject code and subject name fields
                    $('#add_code, #add_name').prop('disabled', true);  // Disable the fields

                    // Add active class to the clicked button and remove it from others
                    $(this).addClass('active').siblings().removeClass('active');
                });

                $('#subjectTable').click(function () {
                    $('#classTableContainer').hide();
                    $('#teacherTableContainer').hide();
                    $('#subjectTableContainer').show();
                    $('.classTableContainer').hide();  // Show subject code and subject name fields
                    $('#add_code, #add_name').prop('disabled', false);  // Enable the fields

                    // Add active class to the clicked button and remove it from others
                    $(this).addClass('active').siblings().removeClass('active');
                });

                // Variable to store the currently assigned teacher and subject IDs
                    var assignedTeacherId;
                    var assignedSubjectId;

                    // Checkbox click event handler for teachers
                    $('#teacherTableContent .assign-checkbox').click(function () {
                        // Uncheck the previously assigned teacher checkbox
                        if (assignedTeacherId && assignedTeacherId !== $(this).val()) {
                            $('#teacherTableContent .assign-checkbox[value="' + assignedTeacherId + '"]').prop('checked', false);
                        }

                        // Store the currently assigned teacher ID
                        assignedTeacherId = $(this).prop('checked') ? $(this).val() : null;
                    });

                    // Checkbox click event handler for subjects
                    $('#subjectTableContent .assign-checkbox').click(function () {
                        // Uncheck the previously assigned subject checkbox
                        if (assignedSubjectId && assignedSubjectId !== $(this).val()) {
                            $('#subjectTableContent .assign-checkbox[value="' + assignedSubjectId + '"]').prop('checked', false);
                        }

                        // Store the currently assigned subject ID
                        assignedSubjectId = $(this).prop('checked') ? $(this).val() : null;
                    });
                    
                    var teacherIDEdit;
                    var subjectEditID;

                    // Checkbox click event handler for teachers
                    $('#teacherTableContentUpdate .assign-checkbox').click(function () {
                        // Uncheck the previously assigned teacher checkbox
                        if (teacherIDEdit && teacherIDEdit !== $(this).val()) {
                            $('#teacherTableContentUpdate .assign-checkbox[value="' + teacherIDEdit + '"]').prop('checked', false);
                        }

                        // Store the currently assigned teacher ID
                        teacherIDEdit = $(this).prop('checked') ? $(this).val() : null;
                    });

                    // Checkbox click event handler for subjects
                    $('#subjectTableContentUpdate .assign-checkbox').click(function () {
                        // Uncheck the previously assigned subject checkbox
                        if (subjectEditID && subjectEditID !== $(this).val()) {
                            $('#subjectTableContentUpdate .assign-checkbox[value="' + subjectEditID + '"]').prop('checked', false);
                        }

                        // Store the currently assigned subject ID
                        subjectEditID = $(this).prop('checked') ? $(this).val() : null;
                    });

                // AJAX to save data when the Submit button is clicked
                $('#saveChangesBtn').click(function () {
                    // Get data from input fields
                    var classCode = $('#add_code').val();
                    var className = $('#add_name').val();

                    // Check if both a teacher and a subject are selected
                    if (assignedTeacherId && assignedSubjectId) {
                        // Prepare data to send to the server
                        var postData = {
                            classCode: classCode,
                            className: className,
                            teacherId: assignedTeacherId,
                            subjectId: assignedSubjectId
                        };

                        // Send data to the server using AJAX
                        $.ajax({
                            type: 'POST',
                            url: 'save_class.php', // Replace with the actual path to your server-side script
                            data: postData,
                            success: function (response) {
                                // Handle the response from the server
                                console.log(response);

                                // Display SweetAlert if data is saved successfully
                                if (response.status === "success") {
                                    Swal.fire({
                                        title: "Success",
                                        text: "Data saved successfully!",
                                        icon: "success",
                                        showConfirmButton: false, // Hide the "OK" button
                                        timer: 1500, // Auto-close after 1.5 seconds (adjust as needed),
                                        didClose: () => {
                                            // Close the modal
                                            $('#staticBackdrop').modal('hide');
                                            
                                            // Clear the input fields if needed
                                            $('#add_code').val('');
                                            $('#add_name').val('');

                                            // Refresh the DataTable
                                            location.reload();
                                        }
                                    });
                                } else {
                                    // Handle errors (if any)
                                    console.error(response.message);
                                }
                            },
                            error: function (xhr, status, error) {
                                // Handle errors (if any)
                                console.error(xhr.responseText);
                            }
                        });
                    } else {
                        alert('Please select one teacher and one subject.');
                    }
                });
                function toggleEditTables(tableType) {
                        // Hide all table containers
                        $('.updateClassTableContainer, #updateTeacherTableContainer, #updateSubjectTableContainer').hide();

                        // Show the selected table container
                        switch (tableType) {
                            case 'editClassTable':
                                $('.updateClassTableContainer').show();
                                break;
                            case 'editTeacherTable':
                                $('#updateTeacherTableContainer').show();
                                break;
                            case 'editSubjectTable':
                                $('#updateSubjectTableContainer').show();
                                break;
                            default:
                                break;
                        }
                    }

                    // Event listener for the edit modal table buttons
                    $('#editClassTable, #editTeacherTable, #editSubjectTable').click(function () {
                        var tableType = $(this).attr('id');
                        toggleEditTables(tableType);
                    });

                  // Fetch data when the edit button is clicked
                $('.edit-btn').click(function () {
                    var classID = $(this).data('class-id');

                    $.ajax({
                        type: 'POST',
                        url: 'fetch_class.php',
                        data: {
                            classID: classID
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                console.log('Response:', response);
                                $('#classID').val(response.classID); // Set class ID in the modal
                                $('#edit_code').val(response.classCode);
                                $('#edit_name').val(response.className);

                                // Toggle the appropriate table container based on the type of data to be edited
                                toggleEditTables('editClassTable');

                                // Clear all checkboxes first
                                $('.assign-checkbox').prop('checked', false);

                                // Click event handler for teacher checkboxes
                                $('#teacherTableContentUpdate .assign-checkbox').click(function () {
                                    // Clear previously assigned teacher checkbox
                                    $('#teacherTableContentUpdate .assign-checkbox').not(this).prop('checked', false);
                                    assignedTeacherId = $(this).prop('checked') ? $(this).val() : null;
                                });

                                // Click event handler for subject checkboxes
                                $('#subjectTableContentUpdate .assign-checkbox').click(function () {
                                    // Clear previously assigned subject checkbox
                                    $('#subjectTableContentUpdate .assign-checkbox').not(this).prop('checked', false);
                                    assignedSubjectId = $(this).prop('checked') ? $(this).val() : null;
                                });

                                // Check checkboxes based on the fetched data and update assignedTeacherId and assignedSubjectId
                                response.teacherIDs.forEach(function (id) {
                                    $('#teacherTableContentUpdate').find('.assign-checkbox[value="' + id + '"]').prop('checked', true);
                                });

                                response.subjectIDs.forEach(function (id) {
                                    $('#subjectTableContentUpdate').find('.assign-checkbox[value="' + id + '"]').prop('checked', true);
                                });

                                // Show the edit modal
                                $('#editModal').modal('show');
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('An error occurred while fetching class details. Please check the console for more information.');
                        }
                });
            });
                    
                $('#updateBtn').click(function () {
                    // Gather the updated data
                    var classID = $('#classID').val();
                    var classCode = $('#edit_code').val();
                    var className = $('#edit_name').val();
                    var instructorID = $('#updateTeacherID').val(); // Assuming you have an input field with the ID 'instructorID'
                    var subjectID = $('#updateSubjectID').val(); // Assuming you have an input field with the ID 'subjectID'

                    // Prepare the data to be sent to the server for updating
                    var updatedData = {
                        classID: classID,
                        classCode: classCode,
                        className: className,
                        instructorID: instructorID,
                        subjectID: subjectID
                    };

                    // Send the updated data to the server for updating
                    $.ajax({
                        type: 'POST',
                        url: 'update_class.php',
                        data: updatedData,
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                // Display success message with SweetAlert
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Data updated successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function () {
                                    // Optionally, you can reload the page or perform other actions
                                    location.reload(); // Reload the page
                                });
                            } else {
                                // Display error message with SweetAlert
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Error updating data: ' + response.message
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            // Display error message with SweetAlert
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'An error occurred while updating data. Please try again later.'
                            });
                        }
                    });
                });


                    $('.delete-btn').click(function() {
                            var classID = $(this).data('class-id');

                            Swal.fire({
                                title: 'Are you sure?',
                                text: 'You will not be able to recover this category!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'No, cancel!',
                                reverseButtons: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'delete_class.php',
                                        data: {
                                            classID: classID  // Make sure the parameter name matches what your PHP script expects
                                        },
                                        dataType: 'json',
                                        success: function(response) {
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

            });

        </script>

</body>

</html>
