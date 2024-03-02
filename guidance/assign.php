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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                <h5>
                <small class="text-muted p-5">Manage Form</small>
                </h5>
                <div id="page-content" class="col-md-12 px-5 py-1" >
                <div class="row">
                <div class="shadow p-3 mb-5 bg-body rounded ">

                       <!-- Add Modal -->
                       <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Assign Teacher Evaluation</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <form id="teacherForm" method="POST">
                            <label class="form-label">Evaluation Form</label>
                            <select id="formID" name="formID" class="form-select" aria-label="Default select example">
                                <option selected disabled>Choose</option>
                                <?php
                                    $sqlquery = mysqli_query($con, "SELECT * FROM tbl_evaluation_form");
                                    while($row = mysqli_fetch_array($sqlquery)) {
                                ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['form_description']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                    </div>
                    <div class="col-md-8">
                        <?php
                            $sqlquery = mysqli_query($con, "SELECT * FROM user WHERE type='teacher'");
                            $count = 0; // Counter for tracking the number of teachers displayed
                            while($row = mysqli_fetch_array($sqlquery)) {
                                if ($count % 2 == 0) {
                                    // Open a new row for every two teachers
                                    echo '<div class="row">';
                                }
                        ?>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title" style="font-size: 12pt;"><?php echo $row['email']; ?></h5>
                                        <div class="form-check">
                                            <input class="form-check-input form-check-sm" type="checkbox" name="teacherID[]" value="<?php echo $row['id']; ?>" id="teacher_<?php echo $row['id']; ?>">
                                            <label class="form-check-label" for="teacher_<?php echo $row['id']; ?>">Assign</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                                $count++;
                                if ($count % 2 == 0) {
                                    // Close the row after displaying two teachers
                                    echo '</div>'; // Close the row
                                }
                            }
                            // Check if there's an unclosed row
                            if ($count % 2 != 0) {
                                echo '</div>'; // Close the row
                            }
                        ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="assignTeachersBtn" class="btn btn-primary" name="save_changes">Submit</button>
            </div>
        </div>
    </div>
</div>



                        <!-- end of modal -->

                <button type="button" class="btn btn-primary mx-auto" style="font-size: 12px !important;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="fa-solid fa-plus"></i> Assign Teacher
                </button>
                <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%; font-size: 12px !important;">
                                        <thead>
                                            <tr>
                                                <th style="display:none;">No.</th>
                                                <th>No.</th>
                                                <th>Form No.</th>
                                                <th>Teacher</th>
                                                <th>Status</th>
                                                <th>Date Created</th>
                                                <th>Date Updated</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                        <?php
                        $sqlquery = mysqli_query($con, "SELECT * FROM tbl_assign ORDER BY id DESC;");
                        $i = 1;
                        while ($rows = mysqli_fetch_array($sqlquery)) {
                        ?>
                        <tr>
                            <td style="width: 10%;"><?php echo $i++; ?></td>
                            <td style="display:none;"><?php echo $rows['id']; ?></td>
                           
                            <td style="width: 15%;">
                                <?php 
                                // Fetching category description from tbl_category based on category_id
                                $formID = $rows['evaluation_form_id'];
                                $formQuery = mysqli_query($con, "SELECT form_no FROM tbl_evaluation_form WHERE id = $formID");
                                $formRow = mysqli_fetch_assoc($formQuery);
                                echo $formRow['form_no'];
                                ?>
                            </td>
                             <td style="width: 25%;">
                                <?php 
                                // Fetching category description from tbl_category based on category_id
                                $teacherID = $rows['instructor_id'];
                                $teacherQuery = mysqli_query($con, "SELECT email FROM user WHERE id = $teacherID");
                                $teacherRow = mysqli_fetch_assoc($teacherQuery);
                                echo $teacherRow['email'];
                                ?>
                            </td>
                            <td style="width: 10%;">
                                <?php if($rows['is_active'] == 1): ?>
                                    <button type="button" class="btn btn-success btn-sm enable-btn" data-enable-id="<?php echo $rows['id']; ?>" data-is-active="<?php echo $rows['is_active']; ?>">Enabled</button>
                                <?php elseif ($rows['is_active'] == 0): ?>
                                    <button type="button" class="btn btn-secondary btn-sm enable-btn" data-enable-id="<?php echo $rows['id']; ?>" data-is-active="<?php echo $rows['is_active']; ?>">Disabled</button>
                                <?php endif; ?>
                            </td>
                            <td style="width: 15%;"><?php echo date('F j, Y, g:i A', strtotime($rows['date_created'])); ?></td>
                            <td style="width: 15%;"> <?php 
                                if (!empty($rows['date_updated'])) {
                                    echo date('F j, Y, g:i A', strtotime($rows['date_updated'])); 
                                } 
                            ?>
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
    
    

    <!-- Your custom scripts -->
    <script src="../admin/script.js"></script>
    <script>
       new DataTable('#example');
    </script>
      <script>
            document.addEventListener('DOMContentLoaded', function () {
    var assignTeachersBtn = document.getElementById('assignTeachersBtn');

    if (assignTeachersBtn) {
        assignTeachersBtn.addEventListener('click', function (e) {
            e.preventDefault();

            var teacherCheckboxes = document.querySelectorAll('#teacherFields input[name="teacherID[]"]:checked');
            var formID = document.getElementById('formID');

            if (formID) {
                formID = formID.value;

                var teacherIDs = [];
                teacherCheckboxes.forEach(function (checkbox) {
                    teacherIDs.push(checkbox.value);
                });

                console.log("Teacher IDs:", teacherIDs);
                console.log("Form ID:", formID);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'save_assign.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);

                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function () {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.message
                                });
                            }
                        } else {
                            console.error('Error occurred during AJAX request:', xhr.statusText);
                            alert('An error occurred while saving the form. Please try again.');
                        }
                    }
                };
                xhr.send('teacherIDs=' + JSON.stringify(teacherIDs) + '&formID=' + formID + '&save_changes=1');
            } else {
                console.error('Form ID element not found');
                alert('An error occurred. Please try again.');
            }
        });
    }
});

    </script>
    
    <script src="assign.js"></script>
</body>

</html>
