<?php
session_start();
//error_reporting(E_ERROR);
include('include/connections.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Redbubble</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/citizenlogo.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include 'partials/navbar.php' ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
     
      <!-- partial:../../partials/_sidebar.html -->
      <?php include 'partials/sidebar.php' ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Item Details </h4>
                 
                 
                 
                                            
                                            <?php
                    $select="SELECT * FROM order_items oi INNER JOIN bookings b on oi.order_id = b.order_id
                      WHERE  oi.order_id=".$_GET['get'];
        $query=mysqli_query($con,$select);
       $row=mysqli_fetch_array($query);
                    ?>
                          
                            <table class="table">
                                  <tbody>
                                    <tr><td><b>Item </b></td><td><?php print $row['product_name']?></td></tr>
                        <tr><td><b> Quantity</b></td><td><?php print $row['quantity']?></td></tr>
                        <tr><td><b> Item Price</b></td><td> Kes <?php print number_format($row['item_price'])?></td></tr>
                        <tr><td><b> Total Price</b></td><td><?php print $row['total_price']?></td></tr>
                        <tr><td><b> Size</b></td><td><?php print $row['dimension']?></td></tr>
                        <tr><td><b> Print Area</b></td><td><?php print $row['print_area']?></td></tr>
                        <tr><td><b> Color</b></td><td><?php print $row['color']?></td></tr>

                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
      
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
   <!-- this page js -->
    <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>
  <!-- End custom js for this page-->
</body>

</html>
