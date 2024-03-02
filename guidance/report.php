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
            <div class="container-fluid">
    <div class="row">
        <!-- Left side: Pie Chart -->
        <div class="col-md-4 position-fixed left-0">
            <div class="col-md-12">
                <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
                    <!-- Pie Chart Canvas -->
                    <canvas id="pieChart" style="max-width: 100%; height: auto;"></canvas>
                </div>
            </div>
        </div>
        <!-- Right side: Faculty Evaluation Form -->
        <div class="col-md-8 offset-md-4">
            <div class="card mt-5">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Faculty Evaluation Form</h5>
                </div>
                <div class="card-body">
                    <form id="teacherForm" method="POST">
                        <?php
                        $sql = "SELECT Q.id, Q.question, C.category_description 
                                FROM tbl_question Q
                                JOIN tbl_evaluation_form F ON Q.evaluation_form_id = F.id
                                JOIN tbl_category C ON F.category_id = C.id
                                ORDER BY C.category_description"; // Order by category for grouping

                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            $currentCategory = null;

                            while ($row = $result->fetch_assoc()) {
                                if ($currentCategory !== $row["category_description"]) {
                                    // If category changed, display new category header
                                    $currentCategory = $row["category_description"];
                                    echo '<h4>' . $currentCategory . '</h4>';
                                }

                                echo '<div class="mb-3">';
                                echo '<label for="question_' . $row["id"] . '" class="form-label">' . $row["question"] . '</label>';
                                echo '<div class="btn-group-toggle" data-toggle="buttons">';
                                for ($i = 1; $i <= 5; $i++) {
                                    echo '<label class="btn btn-outline-primary">';
                                    echo '<input type="radio" name="responses[' . $row["id"] . ']" value="' . $i . '" autocomplete="off">' . $i;
                                    echo '</label>';
                                }
                                echo '</div>'; // close btn-group-toggle
                                echo '</div>'; // close mb-3
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
    
    <?php
    // Your PHP code to fetch data from the database and format it as JSON
    // For example, you might retrieve category names and corresponding counts
    $categories = array(); // Array to store category names
    $counts = array(); // Array to store counts

    // Your database connection code here (e.g., $con = new mysqli(...);)

    // Your database query to retrieve data and populate $categories and $counts arrays
    $sql = "SELECT category_description, COUNT(*) AS count FROM tbl_category GROUP BY category_description";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row['category_description'];
            $counts[] = $row['count'];
        }
    }

    // Convert PHP arrays to JavaScript arrays
    $categories_json = json_encode($categories);
    $counts_json = json_encode($counts);
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Convert PHP categories JSON to JavaScript array
    var categories = <?php echo $categories_json; ?>;

    // Generate dynamic colors based on the number of categories
    var dynamicColors = [];
    for (var i = 0; i < categories.length; i++) {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        dynamicColors.push('rgba(' + r + ', ' + g + ', ' + b + ', 0.6)');
    }

    // Create pie chart
    var ctx = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: categories,
            datasets: [{
                data: <?php echo $counts_json; ?>,
                backgroundColor: dynamicColors,
                borderWidth: 1
            }]
        },
        options: {
            // Your chart options
        }
    });
</script>

    <!-- Your custom scripts -->
    <script src="../admin/script.js"></script>
    <script>
       new DataTable('#example');
    </script>
</body>

</html>
