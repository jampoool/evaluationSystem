<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" /> 
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>

</head>
<body>
 
    <div class="container">
        
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                     <th>Class Code</th>
                    <th>Class Name</th>
                    <th>Instructor ID</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database connection
                include "../connect.php";
                
                // SQL query to fetch data
                $sql = "SELECT classCode, className, instructorID, date_created, date_updated FROM tblclass";
                $result = mysqli_query($con, $sql);

                // Check if there are any rows returned
                if (mysqli_num_rows($result) > 0) {
                    // Loop through each row of data
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["classCode"] . "</td>";
                        echo "<td>" . $row["className"] . "</td>";
                        echo "<td>" . $row["instructorID"] . "</td>";
                        echo "<td>" . $row["date_created"] . "</td>";
                        echo "<td>" . $row["date_updated"] . "</td>";
                        echo '<td><a href="#" class="btn btn-primary">Edit</a> 
                                  <a href="#" class="btn btn-danger">Delete</a></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No data found</td></tr>";
                }

                // Close connection
                mysqli_close($con);
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Class Modal -->
    <div class="modal fade" id="addClassModal" tabindex="-1" role="dialog" aria-labelledby="addClassModalLabel" aria-hidden="true">
        <!-- Modal content here -->
    </div>

    <!-- Edit Class Modal -->
    <div class="modal fade" id="editClassModal" tabindex="-1" role="dialog" aria-labelledby="editClassModalLabel" aria-hidden="true">
        <!-- Modal content here -->
    </div>

    <!-- Your custom script -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>
</html>
