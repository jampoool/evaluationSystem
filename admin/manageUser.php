<?php
include "../connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/mGuidance.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

</head>

<body>
    <div class="d-grid gap-2 col-2 mx-2">
        <h3>
            <p class="font-monospace">Manage User</p>
        </h3>
        <button type="button" class="btn btn-primary mx-auto mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-plus"></i>
            Add User
        </button>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="manageUser.php" class="row g-3" method="POST">
                        <div class="col-5">
                            <label for="inputID4" class="form-label">Guidance ID</label>
                            <input type="text" class="form-control" id="inputID4" name="id">
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
                                <option value="admin">admin</option>
                                <option value="guidance">guidance</option>
                                <option value="student">student</option>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" name="save_changes">Submit</button>
                        </div>
                    </form>
                    <?php
                    include "../connect.php";

                    if (isset($_POST['save_changes'])) {
                        $guidanceId = $_POST['id'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $type = $_POST['type'];
                        $department = $_POST['department'];
                        $dateCreated = date("Y-m-d");

                        $sql = "INSERT INTO user (`user-id`, email, password, type, department, date_created) VALUES (?, ?, ?, ?, ?,?)";

                        $stmt = $con->prepare($sql);
                        $stmt->bind_param("ssssis", $guidanceId, $email, $password, $type, $department, $dateCreated);

                        if ($stmt->execute()) {
                            echo '<script>alert("User inserted successfully!");</script>';
                        } else {
                            echo "Error: " . $stmt->error;
                        }

                        $stmt->close();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            toggleDepartmentField();

            $('#inputType').on('change', function () {
                toggleDepartmentField();
            });

            function toggleDepartmentField() {
                var selectedType = $('#inputType').val();
                var isDepartmentDisabled = (selectedType === 'admin');

                $('#inputDepartment').prop('disabled', isDepartmentDisabled);

                if (isDepartmentDisabled) {
                    $('#inputDepartment').val('');
                }
            }
        });
    </script>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
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
            $sqlquery = mysqli_query($con, "SELECT * FROM user");

            while ($rows = mysqli_fetch_array($sqlquery)) {
            ?>
                <tr class="mt-4">
                    <td><?php echo $rows['user-id']; ?></td>
                    <td><?php echo $rows['email']; ?></td>
                    <td><?php echo $rows['type']; ?></td>
                    <td><?php echo ($rows['department'] == 1) ? 'Basic Education Department' : 'Higher Education Department'; ?></td>
                    <td><?php echo $rows['date_created']; ?></td>
                    <td><?php echo $rows['date_updated']; ?></td>
                    <td>
                        <div class="d-inline d-lg-none">
                            <button class="btn btn-primary btn-sm" id="ellipsisButton">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                        <div class="d-none d-lg-inline">
                            <a href="?id=1" class="btn btn-primary btn-sm">Edit</a>
                            <a href="?id=1" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
        })
    </script>

    <script>
        $(document).ready(function () {
            $("#ellipsisButton").click(function () {
                $("#ellipsisMenu").toggle();
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

</body>

</html>
