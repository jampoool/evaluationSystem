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
    <style>
       
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
                <small class="text-muted p-5">Manage Form</small>
                </h5>
                <div id="page-content" class="col-md-12 px-5 py-1" >
                <div class="row">
                <div class="shadow p-3 mb-5 bg-body rounded ">

                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Manage Question</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-element">
              <form id="add_name" class="row g-3" name="add_name" method="POST">
                <div class="col-12">
                  <label class="form-label">Form Number</label>
                  <select id="formNumber" name="formNumber" class="form-select">
                    <option selected disabled>Choose</option>
                    <?php
                      $sqlquery = mysqli_query($con, "SELECT * FROM tbl_evaluation_form");
                      while ($rows = mysqli_fetch_array($sqlquery)) {
                          echo "<option value='" . $rows['id'] . "'>" . $rows['form_description'] . "</option>";
                      }
                    ?>
                  </select>
                </div>
                <!-- Additional question fields go here -->
              </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="scrollable-area">
              <table class="table table-bordered table-sm" id="dynamic_field">
                <!-- Table content -->
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
  <!-- "Add More" button within the modal body -->
        <button type="button" name="add" id="add" class="btn btn-sm rounded-pill btn-success add-more-button">Add More</button>
        <div class="ms-auto">
            <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Close</button>
            <input type="submit" name="submit" id="submit" class="btn btn-primary btn-sm rounded-pill" value="Submit" />
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
                                        <h5 class="modal-title" id="editModalLabel">Edit Question</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="form-element">
                                                <form class="row g-3" method="POST">
                                                    <input type="hidden" id="questionID" name="questionID">
                                                    <div class="col-6">
                                                    <label class="form-label">Form No</label>
                                                    <select id="updateForm" name="updateForm" class="form-select" aria-label="Default select example">
                                                        <option selected disabled>Choose</option>
                                                            <?php
                                                            $sqlquery = mysqli_query($con, "SELECT * FROM tbl_evaluation_form");
                                                            while($rows = mysqli_fetch_array($sqlquery))
                                                                { ?>
                                                                    <option value="<?php echo $rows['id'];?>"><?php echo $rows['form_description'];?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                    </select>
                                                </div>
                                                    <div class="col-7">
                                                        <label class="form-label">Question</label>
                                                        <input type="text" class="form-control" id="updateQuestion" name="updateQuestion">
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
                    <i class="fa-solid fa-plus"></i> Add Question
                </button>
                <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%; font-size: 12px !important;">
                                        <thead>
                                            <tr>
                                                <th style="display:none;">No.</th>
                                                <th>No.</th>
                                                <th>Form</th>
                                                <th>Question</th>
                                                <th>Status</th>
                                                <th>Date Created</th>
                                                <th>Date Updated</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                        <?php
                        $sqlquery = mysqli_query($con, "SELECT * FROM tbl_question ORDER BY id DESC;");
                        $i = 1;
                        while ($rows = mysqli_fetch_array($sqlquery)) {
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td style="display:none;"><?php echo $rows['id']; ?></td>
                            <td style="width: 15%;">
                                <?php 
                                // Fetching category description from tbl_category based on category_id
                                $form_id = $rows['evaluation_form_id'];
                                $form_query = mysqli_query($con, "SELECT form_description FROM tbl_evaluation_form WHERE id = $form_id");
                                $form_row = mysqli_fetch_assoc($form_query);
                                echo $form_row['form_description'];
                                ?>
                            </td>
                            <td style="width: 30%;"><?php echo $rows['question']; ?></td>
                            <td style="width: 10%;"><?php echo ($rows['is_active'] == 1) ? 'Active' : 'Inactive'; ?></td>
                            <td style="width: 15%;"><?php echo date('F j, Y, g:i A', strtotime($rows['date_created'])); ?></td>
                            <td style="width: 15%;"> <?php 
                                if (!empty($rows['date_updated'])) {
                                    echo date('F j, Y, g:i A', strtotime($rows['date_updated'])); 
                                } 
                            ?>
                            </td>
                            <td style="width: 10%;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-5">
                                            <button type="button" class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-question-id="<?php echo $rows['id']; ?>">Edit</button>
                                        </div>
                                        <div class="col-5">
                                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-question-id="<?php echo $rows['id']; ?>">Delete</button>
                                        </div>
                                    </div>
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
    
    <script>
   $(document).ready(function(){
    $('#submit').click(function(){
        var formNumber = $('#formNumber').val(); // Get the selected form number
        var questions = []; // Array to store questions

        // Loop through each input field with class name_list (containing questions)
        $('.name_list').each(function(){
            questions.push($(this).val()); // Add the value of each input field to the questions array
        });

        // Send form data to PHP script using AJAX
        $.ajax({
            type: 'POST',
            url: 'save_question.php',
            data: {
                formNumber: formNumber,
                questions: questions
            },
            success: function(response){
                // Handle successful response from server
                console.log(response); // Log response for debugging
                var responseData = JSON.parse(response); // Parse JSON response
                if (responseData.status === "success") {
                    // Show SweetAlert notification if questions are inserted successfully
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: responseData.message
                    }).then(function() {
                        $('#staticBackdrop').modal('hide');
                        $('.modal-backdrop').remove();
                        location.reload();
                    });
                } else {
                    // Handle other cases if needed
                    console.error(responseData.message);
                }
            },
            error: function(xhr, status, error){
                // Handle errors (if any)
                console.error(error); // Log error for debugging
            }
        });
    });
});
        </script>

    <!-- Your custom scripts -->
    <script src="../admin/script.js"></script>
    <script>
       new DataTable('#example');
    </script>
    <script src="question.js">

    </script>
      <script>
      $(document).ready(function() {
        $('.edit-btn').click(function() {
                    var questionID = $(this).data('question-id');
                    var id = $('#questionID').val(questionID); // Retrieve the category ID from the hidden input
                    // AJAX request to fetch category description based on catID
                    $.ajax({
                        type: 'POST',
                        url: 'fetch_question.php',
                        data: {
                            questionID: questionID
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success' && response.question) {
                                $('#updateQuestion').val(response.question);
                                // Select the correct category in the dropdown
                                $('#updateForm').val(response.formID);
                                
                                $('#editModal').modal('show');
                            } else {
                                alert('Question not found');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('An error occurred while fetching Question ID. Please try again.');
                        }
                    });
                });
                $('#updateBtn').click(function(event) {
                            event.preventDefault(); // Prevent default form submission
                            var questionID = $('#questionID').val();
                            var formID = $('#updateForm').val();
                            var question = $('#updateQuestion').val();

                            // AJAX request to update form data
                            $.ajax({
                                type: 'POST',
                                url: 'update_question.php',
                                data: {
                                    questionID: questionID,
                                    formID: formID,
                                    question: question
                                },
                                dataType: 'json',
                                success: function(response) {
                                    // Display SweetAlert confirmation
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 1500 // Hide after 1.5 seconds
                                    }).then(function() {
                                        // Hide modal after showing the SweetAlert
                                        $('#staticBackdrop').modal('hide');
                                        $('.modal-backdrop').remove();
                                        location.reload();
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                    alert('An error occurred while saving the Question. Please try again.');
                                }
                            });
                        });
                   $('.delete-btn').click(function() {
                        var questionID = $(this).data('question-id');

                        // Use SweetAlert for confirmation
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
                                // AJAX request to delete category
                                $.ajax({
                                    type: 'POST',
                                    url: 'delete_question.php',
                                    data: {
                                        questionID: questionID
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.status === 'success') {
                                            // Display success message using SweetAlert
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Deleted!',
                                                text: response.message,
                                                showConfirmButton: false,
                                                timer: 1500
                                            }).then(function() {
                                                // Reload the page or remove the deleted row from the table
                                                location.reload(); // Reload the page
                                            });
                                        } else {
                                            // Display error message using SweetAlert
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error!',
                                                text: response.message
                                            });
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(xhr.responseText);
                                        // Display error message using SweetAlert
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
  
  
</body>

</html>
