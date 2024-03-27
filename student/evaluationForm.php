<?php
    include "../connect.php";
    session_start();
if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'student') {
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

     <!-- Custom CSS -->
     <link rel="stylesheet" href="form.css">

</head>

<body>
    <div class="wrapper">
       
        <div class="main">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 py-3 shadow p-3 bg-body rounded sticky-top">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <label for="">Faculty Evaluation System</label>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../img/cartoon-man-leaving-review.jpg" class="avatar img-fluid" alt="">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="col-md-12 px-5 py-1 mt-5">
                <div class="row">
                    <div class="col-md-12">
                    <div class="container mt-3 mb-4">
                        <a href="dashboard.php" class="btn btn-secondary">Back</a>
                    </div>
                    <form id="evaluationForm">
                        <div class="form-group">
                            <label for="ratingMatrix">Evaluation Rating:</label>
                            <div class="table-responsive">
                                <table id="ratingMatrix" class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>Strongly Disagree</th>
                                            <th>Disagree</th>
                                            <th>Neutral</th>
                                            <th>Agree</th>
                                            <th>Strongly Agree</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Include your database connection
                                        include "../connect.php";
                                        // Check connection
                                        if ($con->connect_error) {
                                            die("Connection failed: " . $con->connect_error);
                                        }
                                        $teacher_id = $_GET['teacher_id'];
                                        $sql = "SELECT * FROM tbl_assign
                                                JOIN user ON tbl_assign.instructor_id = user.id
                                                JOIN tbl_evaluation_form ON tbl_assign.evaluation_form_id = tbl_evaluation_form.id
                                                JOIN tbl_category ON tbl_evaluation_form.category_id = tbl_category.id
                                                JOIN tbl_question ON tbl_evaluation_form.id = tbl_question.evaluation_form_id
                                                WHERE tbl_assign.instructor_id = $teacher_id
                                                ORDER BY tbl_category.category_description, tbl_question.question"; // Order by category and question for grouping

                                        $result = $con->query($sql);

                                        if ($result->num_rows > 0) {
                                            $currentCategory = null;
                                            $currentQuestion = null;
                                            $questionNumber = 1; // Initialize question number counter
                                            while ($row = $result->fetch_assoc()) {
                                                if ($currentCategory !== $row["category_description"]) {
                                                    // If category changed, display new category header
                                                    $currentCategory = $row["category_description"];
                                                    echo '<tr class="table-info">';
                                                    echo '<th colspan="5">' . $currentCategory . '</th>';
                                                    echo '</tr>';
                                                    // Reset question number for each category
                                                    $questionNumber = 1;
                                                }
                                                // Display question row with radio buttons
                                                echo '<tr>';
                                                echo '<td>' . $row["question"] . '</td>';
                                                echo '<td><input type="radio" name="responses[' . $row["id"] . ']" value="1" class="form-radio"></td>';
                                                echo '<td><input type="radio" name="responses[' . $row["id"] . ']" value="2" class="form-radio"></td>';
                                                echo '<td><input type="radio" name="responses[' . $row["id"] . ']" value="3" class="form-radio"></td>';
                                                echo '<td><input type="radio" name="responses[' . $row["id"] . ']" value="4" class="form-radio"></td>';
                                                echo '<td><input type="radio" name="responses[' . $row["id"] . ']" value="5" class="form-radio"></td>';
                                                echo '</tr>';
                                                  // Increment question number for the next question
                                                 $questionNumber++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>No questions found.</td></tr>";
                                        }
                                     
                                        // Close database connection
                                        $con->close();
                                        ?>
                                    </tbody>
                                </table>
                                <button type="button" id="submitButton" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
          $(document).ready(function() {
            // Add click event listener to the submit button
            $("#submitButton").click(function() {
                // Get the teacher ID from the URL
                var teacherID = getParameterByName('teacher_id'); // Function to extract URL parameters

                // Serialize the form data
                var formData = $("#evaluationForm").serialize();

                // Send AJAX request
                $.ajax({
                    url: "process_responses.php",
                    type: "POST",
                    data: {
                        formData: formData,
                        teacherID: teacherID
                    },
                    success: function(response) {
                        console.log(response);
                        // Display success message using SweetAlert
                        Swal.fire({
                            title: "Success!",
                            text: "Responses inserted successfully",
                            icon: "success",
                            confirmButtonText: "OK",
                            onClose: function() {
                                // Redirect to dashboard.php
                                window.location.href = "dashboard.php";
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                        alert("An error occurred while processing the responses.");
                    }
                });
            });
        });


      // Function to extract URL parameters
        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }
        </script> 
           <script src="../admin/script.js"></script>
    <script>
       new DataTable('#example');
    </script>
</body>

</html>
