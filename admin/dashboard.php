<?php
include "../connect.php";
session_start();
if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
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
    <link rel="stylesheet" href="css/dashboard.css">
    
    
     <!-- DataTables CSS -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
         <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
     <!-- Font Awesome -->
     <script src="https://kit.fontawesome.com/658ff99b54.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/charts/chart-8/assets/css/chart-8.css">
    <!-- <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css"> -->

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://unpkg.com/bs-brain@2.0.3/components/charts/chart-8/assets/controller/chart-8.js"></script>

    <style>
      body{
    margin-top:20px;
    background:#FAFAFA;
      }
      .order-card {
          color: #fff;
      }

      .bg-c-blue {
          background: linear-gradient(45deg,#4099ff,#73b4ff);
      }

      .bg-c-green {
          background: linear-gradient(45deg,#2ed8b6,#59e0c5);
      }

      .bg-c-yellow {
          background: linear-gradient(45deg,#FFB64D,#ffcb80);
      }

      .bg-c-pink {
          background: linear-gradient(45deg,#FF5370,#ff869a);
      }


      .card {
          border-radius: 5px;
          -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
          box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
          border: none;
          margin-bottom: 30px;
          -webkit-transition: all 0.3s ease-in-out;
          transition: all 0.3s ease-in-out;
      }

      .card .card-block {
          padding: 25px;
      }

      .order-card i {
          font-size: 26px;
      }

      .f-left {
          float: left;
      }

      .f-right {
          float: right;
      }
    </style>
</head>
<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Faculty Evaluation System</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item ">
                    <a href="dashboard.php" class="sidebar-link active">
                        <i class="fa-solid fa-table-cells-large"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="profile.php" class="sidebar-link">
                        <i class="fa-solid fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="manageUser.php" class="sidebar-link">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Manage User</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="manageClass.php" class="sidebar-link">
                        <i class="fa-solid fa-house-user"></i>
                        <span>Class</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="manageStudentClasses.php" class="sidebar-link">
                        <i class="fa-solid fa-circle-plus"></i>
                        <span>Student Classes</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
    
        <div class="main" style="background-color: #F5F5F5;">
            <nav class="navbar navbar-expand px-4 py-2 shadow p-3 mb-5 bg-body roundedsticky-top">
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
           
            <div class="container">
                <div class="row shadow-sm p-2 mb-2 bg-white rounded">
                      <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Total Students</h6>
                                <h2 class="text-right"><i class="bi bi-person"></i> <span>486</span></h2>
                                <p class="m-b-0">Total Active Students<span class="f-right">351</span></p>
                            </div>
                        </div>
                     </div>
                    
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-green order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Orders Received</h6>
                                <h2 class="text-right"><i class="fa fa-rocket f-left"></i> <span>486</span></h2>
                                <p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-yellow order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Orders Received</h6>
                                <h2 class="text-right"><i class="fa fa-refresh f-left"></i> <span>486</span></h2>
                                <p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-pink order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Orders Received</h6>
                                <h2 class="text-right"><i class="fa fa-credit-card f-left"></i> <span>486</span></h2>
                                <p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
                      <div class="container shadow-sm p-3 mb-5 bg-white rounded">
                                  <div class="row">
                                  <div class="col-sm-8">
                                      <div class="table-responsive">
                                      <table id="example" class="table table-hover" style="width:100%; font-size: 12px !important;">
                                              <thead class="bg-primary text-white">
                                                  <tr>
                                                      <th style="display:none;">No.</th>
                                                      <th>No.</th>
                                                      <th>Email</th>
                                                      <th>Type</th>
                                                      <th>Department</th>
                                                      <th>Date Created</th>
                                                      <th>Status</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php
                                                  $sqlquery = mysqli_query($con, "SELECT * FROM user ORDER BY id DESC;");
                                                  $i = 1;
                                                  while ($rows = mysqli_fetch_array($sqlquery)) {
                                                    $dateCreated = strtotime($rows['date_created']);
                                                    $currentDate = strtotime(date('Y-m-d'));
                                                
                                                    // Calculate the difference in seconds
                                                    $timeDifference = $currentDate - $dateCreated;
                                                
                                                    // Calculate the difference in years
                                                    $yearsDifference = floor($timeDifference / (365 * 24 * 60 * 60));
                                                
                                                    // Set the status based on the time difference
                                                    $status = ($yearsDifference >= 1) ? 0 : 1;
                                                
                                                  ?>
                                                      <tr class="mt-4">
                                                          <td><?php echo $i++; ?></td>
                                                          <td style="display:none;"><?php echo $rows['id']; ?></td>
                                                          <td><?php echo $rows['email']; ?></td>
                                                          <td><?php echo $rows['type']; ?></td>
                                                          <td><?php echo ($rows['department'] == 1) ? 'Basic Education Department' : 'Higher Education Department'; ?></td>
                                                          <td><?php echo $rows['date_created']; ?></td>
                                                          <td><?php echo ($status == 1) ? 'Active' : 'Inactive'; ?></td>
                                                      </tr>
                                                  <?php
                                                  }
                                                  ?>
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>

                                    <div class="col-sm-4">
                                    <section class="py-3 py-md-3">
                                          <div class="card widget-card border-light shadow-sm">
                                            <div class="card-body p-4">
                                              <h5 class="card-title widget-card-title mb-2">Customers</h5>
                                              <div class="row gy-0">
                                                <div class="col-12">
                                                  <h4>3,131</h4>
                                                </div>
                                                <div class="col-12">
                                                  <div class="d-flex align-items-center">
                                                    <span class="fs-6 bsb-w-25 bsb-h-25 bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center me-2">
                                                      <i class="bi bi-arrow-right-short bsb-rotate-n45"></i>
                                                    </span>
                                                    <div>
                                                      <span class="fs-7">+19%</span>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div id="bsb-chart-8" class="mt-2"></div>
                                            </div>
                                          </div>
                                        </div>
                                  </section>
                              </div>
                          </div>
            </div>
        </div>
    </div>
    
    

    <!-- Your custom scripts -->
    <script src="script.js"></script>
    <script>
       $(document).ready(function () {
            // Initialize DataTable
            $('#example').DataTable();
            
          
          });
    </script>
</body>
