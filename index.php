<?php
                    include "connect.php";
                    session_start();

                    function authenticateUser($username, $password) {
                      global $con;

                      $query = "SELECT * FROM user WHERE email = ? AND password = ? LIMIT 1";

                      $stmt = $con->prepare($query);
                      $stmt->bind_param("ss", $username, $password);

                      $stmt->execute();
                      $result = $stmt->get_result();

                      if ($result->num_rows === 1) {
                          $user = $result->fetch_assoc();
                          $_SESSION['user_id'] = $user['id'];  // Set the user ID in the session
                          $_SESSION['type'] = $user['type'];   // Set the user type in the session
                          return $user;
                      } else {
                          return null;
                      }

                      $stmt->close();
                    }

                    if (isset($_POST['login'])) {
                      $username = $_POST['email'];
                      $password = $_POST['password'];

                      $user = authenticateUser($username, $password);

                      if ($user) {
                          // Authentication successful
                          // Redirect to the appropriate dashboard based on user role
                          if ($user['type'] == 'admin') {
                              header("Location: admin/dashboard.php");
                          } elseif ($user['type'] == 'guidance') {
                              header("Location: guidance/dashboard.php");
                          } elseif ($user['type'] == 'student') {
                              header("Location: student/dashboard.php");
                          } elseif ($user['type'] == 'teacher') {
                              header("Location: teacher/dashboard.php");
                          } else {
                              // Handle other roles if needed
                              echo "Invalid user type";
                          }

                          exit();
                      } else {
                          echo '<script>
                                  Swal.fire({
                                      icon: "error",
                                      title: "Invalid Credentials",
                                      text: "Please check your email and password and try again.",
                                  });
                                </script>';
                      }
                    }
                    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Evaluation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="index.css" rel="stylesheet">
</head>
<body>
      <section class="vh-100">
          <div class="container-fluid h-100">
              <div class="row justify-content-center align-items-center h-100">
                  <div class="col-lg-6 col-xl-5 d-none d-lg-block"> <!-- Hide this column on smaller screens -->
                      <img src="img/cartoon-man-leaving-review.jpg" class="img-fluid" alt="Sample image">
                  </div>
                  <div class="col-lg-6 col-xl-5">
                      <div class="card">
                          <div class="card-body shadow">
                              <h1 class="card-title text-center mb-4">Log in to your account</h1>
                              <form method="POST">
                                  <div class="form-group mb-4">
                                      <label for="email" class="form-label">Email address</label>
                                      <input type="email" class="form-control form-control-lg" id="email" placeholder="Enter a valid email address" name="email" required>
                                  </div>
                                  <div class="form-group mb-4">
                                      <label for="password" class="form-label">Password</label>
                                      <input type="password" class="form-control form-control-lg" id="password" placeholder="Enter password" name="password" required>
                                  </div>
                                  <div class="form-check mb-3">
                                      <input class="form-check-input" type="checkbox" value="" id="showPassword">
                                      <label class="form-check-label" for="showPassword">Show Password</label>
                                  </div>
                                  <div class="d-grid gap-2">
                                      <button type="submit" class="btn btn-primary btn-lg" name="login">Login</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
   </body>
                 
</html>