<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Redbubble</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="images/citizenlogo.png" />
</head>

<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/citizenlogo.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="index.php?logout='1'">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <?php include 'partials/sidebar.php' ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <h3 class="font-weight-bold">Welcome Admin</h3>
            </div>
          </div>
          <div class="row d-flex flex-wrap justify-content-center">
            <!-- All Customers Card -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="card shadow bg-white w-100">
                <div class="card-body text-center">
                  <p class="mb-4 font-weight-bold">All Customers</p>
                  <a href="approvedcustomers.php"><p class="fs-30 mb-2">View</p></a>
                </div>
              </div>
            </div>
            <!-- All Staff Members Card -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="card shadow bg-white w-100">
                <div class="card-body text-center">
                  <p class="mb-4 font-weight-bold">All Staff Members</p>
                  <a href="allstaff.php"><p class="fs-30 mb-2">View</p></a>
                </div>
              </div>
            </div>
            <!-- All Suppliers Card -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="card shadow bg-white w-100">
                <div class="card-body text-center">
                  <p class="mb-4 font-weight-bold">All Suppliers</p>
                  <a href="suppliers.php"><p class="fs-30 mb-2">View</p></a>
                </div>
              </div>
            </div>
            <!-- All Order Records Card -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="card shadow bg-white w-100">
                <div class="card-body text-center">
                  <p class="mb-4 font-weight-bold">All Order Records</p>
                  <a href="allorders.php"><p class="fs-30 mb-2">View</p></a>
                </div>
              </div>
            </div>
            <!-- All Payment Records Card -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="card shadow bg-white w-100">
                <div class="card-body text-center">
                  <p class="mb-4 font-weight-bold">Received Supply</p>
                  <a href="approvedsupply.php"><p class="fs-30 mb-2">View</p></a>
                </div>
              </div>
            </div>
            <!-- All Service Bookings Card -->
            <div class="col-md-4 mb-4 d-flex">
              <div class="card shadow bg-white w-100">
                <div class="card-body text-center">
                  <p class="mb-4 font-weight-bold">Fedback History</p>
                  <a href="feedback.php"><p class="fs-30 mb-2">View</p></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©2025 Redbubble. All rights reserved</span>
          </div>
        </footer> 
      </div>
    </div>
  </div>
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
</body>

</html>
