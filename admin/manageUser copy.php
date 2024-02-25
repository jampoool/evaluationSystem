<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Evaluation System</title>
    <link rel="stylesheet" href="css/mGuidance.css">
       
    <style>
        .container {
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="container-fluid shadow p-3 mb-5 bg-body rounded">
        <div class="d-grid gap-2 col-1 mx-2">
            <h5>
                <p class="font-monospace">Manage User</p>
            </h5>
        </div>
            <button type="button" class="btn btn-primary mx-auto " data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            <i class="fa-solid fa-plus"></i>
            Add User
            </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-element">
                            <form class="row g-3" method="POST">
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                    <button class="btn btn-primary" name="save_changes">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body gap-3">
                        <?php include "editdata.php"; ?>
                    </div>
                </div>
            </div>
        </div>
            <div class="mt-3"></div>
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
                    <td><?php echo ($rows['department'] == 1) ? 'Basic Education Department' : 'Higher Education
                        Department'; ?></td>
                    <td><?php echo $rows['date_created']; ?></td>
                    <td><?php echo $rows['date_updated']; ?></td>
                    <td>
                        <div class="d-inline d-lg-none">
                            <button class="btn btn-primary btn-sm" id="ellipsisButton">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                        <div class="d-none d-lg-inline">
                            <button type="button" class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal"
                                data-bs-target="#editModal" data-user-id="<?php echo $rows['user-id']; ?>">Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
     
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" /> 
        <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>

        <script src="manageUser.js"></script>
    </div>
</body>

</html>
