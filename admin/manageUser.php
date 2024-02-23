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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <style>
        .container{
            background-color: #ffffff;

        }
    </style>
</head>

<body>
    <div class="container-fluid shadow p-3 mb-5 bg-body rounded">
    <div class="d-grid gap-2 col-2 mx-2">
        <h5>
            <p class="font-monospace">Manage User</p>
        </h5>
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
                    <div class="form-element">
                    <form class="row g-3" method="POST" action="adminCrud.php">
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
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="" method="POST" enctype="multipart/form-data"  method="POST" id="ModalForm">
                        {{csrf_field()}}
                        <input type="hidden" id="editId" value="">
                        <div class="form-group">
                            <label for="editUserID">User ID</label>
                            <input type="text" name="userID" class="form-control" id="editUserID" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="editEmail" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="editType">Type</label>
                            <select id="editType" class="form-select" name="editType">
                                <option selected>Choose...</option>
                                <option value="admin">admin</option>
                                <option value="guidance">guidance</option>
                                <option value="student">student</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editDepartment">Department</label>
                            <select id="editDepartment" class="form-select" name="editDepartment">
                                <option selected>Choose...</option>
                                <option value="1">Basic Education Department</option>
                                <option value="2">Higher Education Department</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <a  class="btn btn-secondary" data-dismiss="modal">Close</a>
                            <button type="button"  id="saveModalButton" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                        <button type="button" class="btn btn-sm btn-primary fas fa-pencil-alt noUnderlineCustom text-white" data-toggle="modal" data-target="#editModal"></button>
                            <a href="" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
       $(function() {
        //Take the data from the TR during the event button
        $('table').on('click', 'button.editingTRbutton',function (ele) {
            //the <tr> variable is use to set the parentNode from "ele
            var tr = ele.target.parentNode.parentNode;

            //I get the value from the cells (td) using the parentNode (var tr)
            var id = tr.cells[0].textContent;
            var email = tr.cells[1].textContent;
            var type = tr.cells[2].textContent;
            var department = tr.cells[3].textContent;

            //Prefill the fields with the gathered information
            $('h5.modal-title').html('Edit Admin Data: '+email);
            $('#editEmail').val(email);
            $('#editType').val(surname);
            $('#editEmail').val(email);
            $('#editPhone').val(phone);
            $('#editId').val(id);
            $("#editLevel").val(level).attr('selected', 'selected');

            //If you need to update the form data and change the button link
            $("form#ModalForm").attr('action', window.location.href+'/update/'+id);
            $("a#saveModalButton").attr('href', window.location.href+'/update/'+id);
        });
    });
    </script>

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
</div>
</body>

</html>
