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

    
</head>
<body>
            <div class="d-grid gap-2 col-2 mx-2">
            <p class="font-monospace">Manage Guidance</p>
            <!-- <button class="btn btn-primary mx-auto mb-3" type="button"><i class="fa-solid fa-plus"></i>
            Add Guidance
            </button> -->
            <button type="button" class="btn btn-primary mx-auto mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-plus"></i>
            Add Guidance
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
                    <form class="row g-3" method="POST">
                                 <div class="col-5">
                                    <label for="inputID4" class="form-label">Guidance ID</label>
                                    <input type="email" class="form-control" id="inputID4">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="inputPassword4">
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress2" class="form-label">Address 2</label>
                                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">City</label>
                                    <input type="text" class="form-control" id="inputCity">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputState" class="form-label">State</label>
                                    <select id="inputState" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="inputZip">
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        Check me out
                                    </label>
                                    </div>
                                </div>
                               
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
                </div>
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Email</th>
            <th>Department</th>
            <th>Date Created</th>
            <th>Date Updated</th>
            <th>Action</th>
           
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php 
                 $sqlquery = mysqli_query($con, "SELECT * FROM user WHERE `type`= 2");
           
                 while ($rows = mysqli_fetch_array($sqlquery)) {           
                   ?>
                    <td><?php echo $rows['user-id']; ?></td>
                    <td><?php echo $rows['email']; ?></td>
                    <td><?php echo $rows['password']; ?></td>
                    <td><?php echo $rows['date_created']; ?></td>
                    <td><?php echo $rows['date_updated']; ?></td>
                    <td> 
                        <div class="d-inline d-lg-none">
                                <button class="btn btn-secondary" id="ellipsisButton">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu" id="ellipsisMenu">
                                    <a class="dropdown-item" href="edit_user.php?id=1">Edit</a>
                                    <a class="dropdown-item" href="delete_user.php?id=1">Delete</a>
                                </div>
                            </div>
                            <div class="d-none d-lg-inline">
                                <a href="?id=1" class="btn btn-primary">Edit</a>
                                <a href="?id=1" class="btn btn-danger">Delete</a>
                            </div>
                     </td> 
                     <?php 
                 }
                     ?>
        </tr>
        <!-- <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>Edinburgh</td>
            <td>Edinburgh</td>
            <td> 
              <div class="d-inline d-lg-none">
                    <button class="btn btn-secondary" id="ellipsisButton">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu" id="ellipsisMenu">
                        <a class="dropdown-item" href="edit_user.php?id=1">Edit</a>
                        <a class="dropdown-item" href="delete_user.php?id=1">Delete</a>
                    </div>
                </div>
                <div class="d-none d-lg-inline">
                    <a href="?id=1" class="btn btn-primary">Edit</a>
                    <a href="?id=1" class="btn btn-danger">Delete</a>
                </div>
            </td>
        </tr> -->
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
    $(document).ready(function(){
        $("#ellipsisButton").click(function(){
            $("#ellipsisMenu").toggle();
        });
    });
</script>   
<script>
                    $('#example').DataTable();
                    </script>
</body>
</html>
