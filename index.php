<?php
   include "connect.php";

   // Check if the form is submitted
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $username = $_POST['email'];
       $password = $_POST['password'];
       $userType = $_POST['user_type']; // Get selected user type from the form
   
       // Perform SQL query to check user credentials
       $query = "SELECT * FROM user WHERE email='$username' AND password='$password' AND type='$userType'";
       $result = $con->query($query);
   
       if ($result->num_rows > 0) {
           // User found, store user type in the session
           session_start();
           $_SESSION['user_type'] = $userType;
   
           // Redirect based on user type
           switch ($userType) {
               case '3':
                   header("Location: student/dashboard.php");
                   break;
               case '2':
                   header("Location: guidance/dashboard.php");
                   break;
               case '1':
                   header("Location: admin/adminpanel.php");
                   break;
               default:
                   echo "Invalid user type.";
           }
       } else {
           echo "Invalid username or password.";
       }
   }
   
   // Close the database connection
   $con->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Evaluation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="index.css" rel="stylesheet">
</head>
<body>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="img/cartoon-man-leaving-review.jpg"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

        <form method="POST">

           <!-- select user -->
           <select class="form-select" aria-label="Default select example" name="user_type">
           <option selected>Login As</option>
                <option value="1">Admin</option>
                <option value="2">Guidance</option>
                <option value="3">Student</option>
            </select>

          <!-- Email input -->
          <div class="form-outline mb-4 mt-4">
            <input type="email" id="form3Example3" class="form-control form-control-lg"
                placeholder="Enter a valid email address" name="email" />
            <label class="form-label" for="form3Example3">Email address</label>
            </div>
          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Enter password" name="password"/>
            <label class="form-label" for="form3Example4">Password</label>
          </div>

         
          <div class="d-flex justify-content-between align-items-center mt-4">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
               Show Password
              </label>
            
            </div>
           
            <div class="d-grid gap-2 col-6 mx-end">
            <input class="btn btn-primary" type="submit" value="Login"/>
            </div>
         
          </div>
          
        </form>
      </div>
    </div>
  </div>
  
</section>
</body>
</html>