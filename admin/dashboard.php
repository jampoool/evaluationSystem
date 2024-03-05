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
  

    <style>
      body{
   
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
      #card{
        background-color: #1F2377;
      }
      path{
         background-color: #1F2377;
      }
      @media (min-width:992px) {
    .page-container {
        max-width: 1140px;
        margin: 0 auto
    }

    .page-sidenav {
        display: block !important
    }
}

.padding {
    padding: 2rem
}

.w-32 {
    width: 32px !important;
    height: 32px !important;
    font-size: .85em
}

.tl-item .avatar {
    z-index: 2
}

.circle {
    border-radius: 500px
}

.gd-warning {
    color: #fff;
    border: none;
    background: #f4c414 linear-gradient(45deg, #f4c414, #f45414)
}

.timeline {
    position: relative;
    border-color: rgba(160, 175, 185, .15);
    padding: 0;
    margin: 0
}

.p-4 {
    padding: 1.5rem !important
}

.block,
.card {
    background: #fff;
    border-width: 0;
    border-radius: .25rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
    margin-bottom: 1.5rem
}

.mb-4,
.my-4 {
    margin-bottom: 1.5rem !important
}

.tl-item {
    border-radius: 3px;
    position: relative;
    display: -ms-flexbox;
    display: flex
}

.tl-item>* {
    padding: 10px
}

.tl-item .avatar {
    z-index: 2
}

.tl-item:last-child .tl-dot:after {
    display: none
}

.tl-item.active .tl-dot:before {
    border-color: #448bff;
    box-shadow: 0 0 0 4px rgba(68, 139, 255, .2)
}

.tl-item:last-child .tl-dot:after {
    display: none
}

.tl-item.active .tl-dot:before {
    border-color: #448bff;
    box-shadow: 0 0 0 4px rgba(68, 139, 255, .2)
}

.tl-dot {
    position: relative;
    border-color: rgba(160, 175, 185, .15)
}

.tl-dot:after,
.tl-dot:before {
    content: '';
    position: absolute;
    border-color: inherit;
    border-width: 2px;
    border-style: solid;
    border-radius: 50%;
    width: 10px;
    height: 10px;
    top: 15px;
    left: 50%;
    transform: translateX(-50%)
}

.tl-dot:after {
    width: 0;
    height: auto;
    top: 25px;
    bottom: -15px;
    border-right-width: 0;
    border-top-width: 0;
    border-bottom-width: 0;
    border-radius: 0
}

tl-item.active .tl-dot:before {
    border-color: #448bff;
    box-shadow: 0 0 0 4px rgba(68, 139, 255, .2)
}

.tl-dot {
    position: relative;
    border-color: rgba(160, 175, 185, .15)
}

.tl-dot:after,
.tl-dot:before {
    content: '';
    position: absolute;
    border-color: inherit;
    border-width: 2px;
    border-style: solid;
    border-radius: 50%;
    width: 10px;
    height: 10px;
    top: 15px;
    left: 50%;
    transform: translateX(-50%)
}

.tl-dot:after {
    width: 0;
    height: auto;
    top: 25px;
    bottom: -15px;
    border-right-width: 0;
    border-top-width: 0;
    border-bottom-width: 0;
    border-radius: 0
}

.tl-content p:last-child {
    margin-bottom: 0
}

.tl-date {
    font-size: .85em;
    margin-top: 2px;
    min-width: 100px;
    max-width: 100px
}

.avatar {
    position: relative;
    line-height: 1;
    border-radius: 500px;
    white-space: nowrap;
    font-weight: 700;
    border-radius: 100%;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: center;
    justify-content: center;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-negative: 0;
    flex-shrink: 0;
    border-radius: 500px;
    box-shadow: 0 5px 10px 0 rgba(50, 50, 50, .15)
}

.b-warning {
    border-color: #f4c414!important;
}

.b-primary {
    border-color: #448bff!important;
}

.b-danger {
    border-color: #f54394!important;
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
                    <a href="manageSubject.php" class="sidebar-link">
                        <i class="fa-solid fa-house-user"></i>
                        <span>Subject</span>
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
                <a href="../logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
    
        <div class="main" style="background-color: #F5F5F5;">
            <nav class="navbar navbar-expand px-4 py-2 shadow p-3 mb-5 bg-body rounded sticky-top">
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
                        <div class="card order-card" id="card">
                            <div class="card-block">
                            <h6 class="m-b-20">Total Students</h6>
                                <h2 class="text-right"><i class="bi bi-person"></i> <span> 
                                         <?php
                                                $sql = "SELECT * from user where type='student'";
                                                if ($result = mysqli_query($con, $sql)) {
                                                
                                                    // Return the number of rows in result set
                                                    $rowcount = mysqli_num_rows( $result );
                                                    
                                                    // Display result
                                                    printf(" %d\n", $rowcount);
                                                }
                                             ?>
                                        </span></h2>
                                <a href="#" id="view" class="text-decoration-underline d-block mt-1 f-right" style="font-size: 13px;color: white; transition: text-decoration 0.5s;">View Details <i class="bi bi-arrow-right" style="font-size: 10px;"></i></a>
                            </div>
                        </div>
                     </div>
                    
                    <div class="col-md-4 col-xl-3">
                        <div class="card order-card" id="card">
                            <div class="card-block">
                                <h6 class="m-b-20">Total Guidance</h6>
                                <h2 class="text-right"><i class="bi bi-person"></i> <span>
                                         <?php
                                                $sql = "SELECT * from user where type='Guidance'";
                                                if ($result = mysqli_query($con, $sql)) {
                                                
                                                    // Return the number of rows in result set
                                                    $rowcount = mysqli_num_rows( $result );
                                                    
                                                    // Display result
                                                    printf(" %d\n", $rowcount);
                                                }
                                             ?>
                                </span></h2>
                                <a href="#" id="view" class="text-decoration-underline d-block mt-1 f-right" style="font-size: 13px;color: white; transition: text-decoration 0.5s;">View Details <i class="bi bi-arrow-right" style="font-size: 10px;"></i></a>
                           </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-xl-3">
                        <div class="card order-card" id="card">
                            <div class="card-block">
                                <h6 class="m-b-20">Total Teacher</h6>
                                <h2 class="text-right"><i class="bi bi-person"></i> <span>
                                        <?php
                                                $sql = "SELECT * from user where type='teacher'";
                                                if ($result = mysqli_query($con, $sql)) {
                                                
                                                    // Return the number of rows in result set
                                                    $rowcount = mysqli_num_rows( $result );
                                                    
                                                    // Display result
                                                    printf(" %d\n", $rowcount);
                                                }
                                             ?>
                                </span></h2>
                                <a href="#" id="view" class="text-decoration-underline d-block mt-1 f-right" style="font-size: 13px;color: white; transition: text-decoration 0.5s;">View Details <i class="bi bi-arrow-right" style="font-size: 10px;"></i></a>
                          </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-xl-3">
                        <div class="card order-card" id="card">
                            <div class="card-block">
                                <h6 class="m-b-20">Total Admin</h6>
                                <h2 class="text-right"><i class="bi bi-person"></i> <span>
                                         <?php
                                                $sql = "SELECT * from user where type='admin'";
                                                if ($result = mysqli_query($con, $sql)) {
                                                
                                                    // Return the number of rows in result set
                                                    $rowcount = mysqli_num_rows( $result );
                                                    
                                                    // Display result
                                                    printf(" %d\n", $rowcount);
                                                }
                                             ?>
                                </span></h2>
                                <a href="#" id="view" class="text-decoration-underline d-block mt-1 f-right" style="font-size: 13px;color: white; transition: text-decoration 0.5s;">View Details <i class="bi bi-arrow-right" style="font-size: 10px;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          
                      <div class="col-md-12 px-5 py-1">
                      <p class="col-md-4">Recent Added Users</p>
                                  <div class="row">
                                  <div class="col-sm-7 shadow p-3 mb-5 bg-body rounded">
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

                                  <div class="col-sm-5 shadow p-3 mb-5 bg-body rounded">
                                  <p>Basic Timeline</p>
                                        <div class="timeline p-4 block mb-4" id="timelineContainer">
                                            
                                        </div>
                                    </div>

    <!-- Your custom scripts -->
    <script src="script.js"></script>
    <script>
       $(document).ready(function () {
                    loadRecentActivities();

                    function loadRecentActivities() {
                        $.ajax({
                            url: 'adminInsert.php', // Replace with the actual path
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                if (data.status === 'success') {
                                    displayActivities(data.activities);
                                } else {
                                    console.error('Failed to fetch activities.');
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('AJAX request failed:', status, error);
                            }
                        });
                    }

                    function displayActivities(activities) {
                        var timelineContainer = $('#timelineContainer');

                        // Clear existing content
                        timelineContainer.empty();

                        // Add new timeline items
                        activities.forEach(function (activity) {
                            var timelineItem = $('<div class="tl-item">');
                            timelineItem.append('<div class="tl-dot ' + activity.dotColor + '"></div>');
                            var tlContent = $('<div class="tl-content">');
                            tlContent.append('<div class="">' + activity.details + '</div>');
                            tlContent.append('<div class="tl-date text-muted mt-1">' + activity.created_at + '</div>');
                            timelineItem.append(tlContent);
                            timelineContainer.append(timelineItem);
                        });
                    }
                });
            </script>
    <script>
       $(document).ready(function () {
            // Initialize DataTable
            $('#example').DataTable();
            
          
          });
    </script>
</body>
