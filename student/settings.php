<?php 
    include "../connect.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

      <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>
<body>

<section class="section profile mt-5 col-md-12 px-5 py-1">
      <div class="row">

        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

              <?php
                // Assuming the session ID is stored in $_SESSION['user_id']
                // Fetch user details from the database using the session ID
                $userId = $_SESSION['user_id'];
                $query = "SELECT * FROM user WHERE id = '$userId'";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {
                    $userDetails = mysqli_fetch_assoc($result);
            ?>
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title fw-bold">Profile Details</h5>
                    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Full Name</div>
                        <div class="col-lg-9 col-md-8"><?php echo $userDetails['firstname'] . ' ' . $userDetails['lastname']; ?></div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Email</div>
                        <div class="col-lg-9 col-md-8"><?php echo $userDetails['email']; ?></div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Department</div>
                        <div class="col-lg-9 col-md-8">
                                <?php
                                $department = $userDetails['department'];
                                if ($department == 1) {
                                    echo "Basic Education Program";
                                } elseif ($department == 2) {
                                    echo "Higher Education Program";
                                } else {
                                    echo "Unknown Department";
                                }
                                ?>
                            </div>
                    </div>
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                    <?php if (isset($_SESSION['success_message'])) : ?>
                        <script>
                            swal("Success", "<?php echo $_SESSION['success_message']; ?>", "success");
                        </script>
                        <?php unset($_SESSION['success_message']); ?>
                    <?php elseif (isset($_SESSION['error_message'])) : ?>
                        <script>
                            swal("Error", "<?php echo $_SESSION['error_message']; ?>", "error");
                        </script>
                        <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>
                    <!-- Profile Edit Form -->
                    <form method="post">
                        <div class="row mb-3">
                            <label for="firstname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="firstname" type="text" class="form-control" id="firstname" value="<?php echo $userDetails['firstname'];?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="lastname" type="text" class="form-control" id="lastname" value="<?php echo $userDetails['lastname'];?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="email" type="email" class="form-control" id="Email" value="<?php echo $userDetails['email']; ?>">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form><!-- End Profile Edit Form -->

                </div>
            <?php
                } else {
                    echo "User not found";
                }
            ?>


                <div class="tab-pane fade pt-3" id="profile-change-password">
                    <!-- Change Password Form -->
                    <form method="post"> <!-- Assuming your update password logic is in update_password.php -->
                        <div class="row mb-3">
                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="currentPassword" type="password" class="form-control" id="currentPassword" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="newPassword" type="password" class="form-control" id="newPassword" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="renewPassword" type="password" class="form-control" id="renewPassword" required>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="changePassword" class="btn btn-primary">Change Password</button>
                        </div>
                    </form><!-- End Change Password Form -->
                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
    <div class="text-center mt-3">
                        <button id="backButton" class="btn btn-secondary"><a class="text-white" href="dashboard.php">Back</a></button>
      </div>
</body>
    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script>
    // Function to display success message
 

   // Function to display an error message using SweetAlert
        function showErrorMessage(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: message,
            });
        }

        $('#changePassword').submit(function(event) {
                event.preventDefault(); // Prevent form submission
                var formData = $(this).serialize(); // Serialize form data

                // Get the new password and confirm password fields
                var newPassword = $('#newPassword').val();
                var confirmNewPassword = $('#renewPassword').val();

                // Check if the new password and confirm password match
                if (newPassword !== confirmNewPassword) {
                    showErrorMessage('New password and confirm password do not match.');
                    return; // Exit the function
                }

                $.ajax({
                    type: 'POST',
                    url: 'update_password.php', // Your PHP file to handle form submission
                    data: formData,
                    dataType: 'json', // Expect JSON response
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            }).then((result) => {
                                // Reload the page or redirect after success
                                location.reload();
                            });
                        } else {
                            // Display error message returned from the server
                            showErrorMessage(response.message);
                        }
                    },
                    error: function() {
                        showErrorMessage('An error occurred while processing your request.');
                    }
                });
            });
</script>
</html>