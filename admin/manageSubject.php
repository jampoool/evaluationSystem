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
                                <small class="text-muted p-5">Manage Form</small>
                                </h5>
        <div id="page-content" class="col-md-12 px-5 py-1" >
            <div class="row">
                   <div class="shadow p-3 mb-5 bg-body rounded ">

                   <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Manage Subject</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <form id="add_subject" class="row g-3" name="add_subject" method="POST">
                                                <div class="col-12">
                                                    <label for="add_code" class="form-label">Subject Code</label>
                                                    <input type="text" class="form-control" id="add_code" name="add_code">
                                                </div>
                                                <div class="col-12">
                                                    <label for="add_name" class="form-label">Subject Name</label>
                                                    <input type="text" class="form-control" id="add_name" name="add_name">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="ms-auto">
                                        <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary btn-sm rounded-pill" form="add_subject">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                                    <!-- edit modal -->
                                    <div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Subject</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="form-element">
                                                            <form class="row g-3" method="POST">
                                                                <input type="hidden" id="subject_id" name="subject_id">
                                                                <div class="col-7">
                                                                    <label class="form-label">Subject Code</label>
                                                                    <input type="text" class="form-control" id="update_code" name="update_code">
                                                                </div>
                                                                <div class="col-7">
                                                                    <label class="form-label">Subject Name</label>
                                                                    <input type="text" class="form-control" id="update_name" name="update_name">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                                                    </button>
                                                                    <button id="updateBtn" class="btn btn-primary" name="update">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <button type="button" class="btn btn-primary mx-auto" style="font-size: 12px !important;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <i class="fa-solid fa-plus"></i> Add Category
                                    </button>

                                    <div class="mt-2"></div>

                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped" style="width:100%; font-size: 14px !important;">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Subject Code</th>
                                                    <th>Subject Name</th>
                                                    <th>Status</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sqlquery = mysqli_query($con, "SELECT * FROM tbl_subject ORDER BY id DESC;");
                                                $i = 1;
                                                while ($rows = mysqli_fetch_array($sqlquery)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $rows['subject_code']; ?></td>
                                                    <td><?php echo $rows['subject_name']; ?></td>
                                                    <td><?php echo ($rows['is_active'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                                    <td><?php echo date('F j, Y, g:i A', strtotime($rows['created_at'])); ?></td>
                                                    <td>
                                                        <div class="d-inline d-lg-none">
                                                            <button class="btn btn-primary btn-sm" id="ellipsisButton">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="ellipsis-menu" style="display: none;">
                                                                <button type="button" class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-subject-id="<?php echo $rows['id']; ?>">Edit</button>
                                                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-subject-id="<?php echo $rows['id']; ?>">Delete</button>
                                                            </div>
                                                        </div>
                                                        <div class="d-none d-lg-inline">
                                                            <button type="button" class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-subject-id="<?php echo $rows['id']; ?>">Edit</button>
                                                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-subject-id="<?php echo $rows['id']; ?>">Delete</button>
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
    $(document).ready(function(){
        $('.edit-btn').click(function() {
                var subjectID = $(this).data('subject-id');

                $.ajax({
                    type: 'POST',
                    url: 'fetch_subject.php',
                    data: {
                        subjectID: subjectID
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success' && response.categoryDescription) {
                            $('#update_code').val(response.categoryDescription);
                            $('#update_name').val(catID); 
                            $('#').val(catID); 
                            $('#editModal').modal('show');
                        } else {
                            alert('Category description not found');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('An error occurred while fetching category description. Please try again.');
                    }
                });
            });
            $('#updateBtn').click(function(event) {
                event.preventDefault(); 

                    var updatedCatDescription = $('#updatedCatDescription').val();
                    var catID = $('#updateCat').val(); 

                    $.ajax({
                        type: 'POST',
                        url: 'update_category.php',
                        data: {
                            update: true,
                            editID: catID, 
                            editCatDescription: updatedCatDescription
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    $('#editModal').modal('hide');
                                    $('.modal-backdrop').remove();
                                    location.reload();
                                });
                            } else {
                                alert('Failed to update category');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('An error occurred while updating the category. Please try again.');
                        }
                    });
                });
                $('#saveChangesBtn').click(function(event) {
                        event.preventDefault(); 

                        var addCode = $('#add_code').val();
                        var addName = $('#add_name').val();

                        $.ajax({
                            type: 'POST',
                            url: 'save_subject.php',
                            data: {
                                addCode: addCode,
                                addName: addName
                            },
                            dataType: 'json',
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500 
                                }).then(function() {
                                    $('#staticBackdrop').modal('hide');
                                    $('.modal-backdrop').remove();
                                    location.reload(); 
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                alert('An error occurred while saving the data. Please try again.');
                            }
                        });
                    });

                $('.delete-btn').click(function() {
                        var catID = $(this).data('category-id');

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
                                    url: 'delete_category.php',
                                    data: {
                                        categoryID: catID
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
                                            text: 'An error occurred while deleting the category. Please try again.'
                      });
                     }
                });
              }
           });
       });
    });
</script>                                           
    <!-- Your custom scripts -->
    <script src="script.js"></script>
    <script>
       new DataTable('#example');
    </script>
</body>

</html>
