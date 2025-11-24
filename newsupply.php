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

  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="images/citizenlogo.png" />
</head>

<body>
  <div class="container-scroller">

    <?php include 'partials/navbar.php' ?>

    <div class="container-fluid page-body-wrapper">

      <?php include 'partials/sidebar.php' ?>

      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                  <h4 class="card-title">New Supply Requests From Stock Manager</h4>

                  <!-- ✅ PRINT BUTTON ADDED -->
                  <button class="btn btn-primary mb-3" onclick="printTable()">Print</button>

                  <div class="">
                    <table id="zero_config" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Supplier</th>
                          <th>Amount KES</th>
                          <th>Supply Items</th>
                          <th>Invoice Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        $select = "SELECT * FROM clients c 
                                   INNER JOIN supply_payment o 
                                   ON c.client_id = o.supplier_id 
                                   WHERE o.payment_status='unpaid'";
                        $query = mysqli_query($con, $select);
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                          <tr class="odd gradeX">
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></td>
                            <td><?php echo $row['amount'] ?></td>
                            <td><?php echo $row['payment_description'] ?></td>
                            <td><?php echo $row['payment_date'] ?></td>
                            <td><?php echo $row['payment_status'] ?></td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>

                    </table>
                  </div>

                </div>
              </div>
            </div>
          </div>

        </div>

        <?php include 'partials/footer.php' ?>

      </div>

    </div>

  </div>

  <!-- JS -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>

  <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
  <script>
    $('#zero_config').DataTable();
  </script>

  <!-- ✅ PRINT FUNCTION ADDED -->
  <script>
    function printTable() {
      var printContents = document.querySelector(".table").outerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML =
        "<html><head><title>Print</title></head><body>" +
        printContents +
        "</body></html>";

      window.print();
      document.body.innerHTML = originalContents;
      location.reload();
    }
  </script>

</body>
</html>
