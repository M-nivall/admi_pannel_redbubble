<nav class="sidebar sidebar-offcanvas bg-dark text-white" id="sidebar" style="color: white;">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link text-white" href="index.php">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Customers</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link text-white" href="newcustomers.php">Pending Approval</a></li>
          <li class="nav-item"> <a class="nav-link text-white" href="approvedcustomers.php">Approved</a></li>
          <li class="nav-item"> <a class="nav-link text-white" href="rejectedcustomers.php">Rejected</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
        <i class="icon-columns menu-icon"></i>
        <span class="menu-title">Payments</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link text-white" href="newpayments.php">Pending Approval</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="approvedpayments.php">Completed Payments</a></li>
            <!--<li class="nav-item"><a class="nav-link text-white" href="approvedservpayments.php">Service Payments</a></li> -->
          <li class="nav-item"><a class="nav-link text-white" href="rejectedpayments.php">Rejected</a></li>
          <li class="nav-item"> <a class="nav-link text-white" href="completedsupply.php">Supply Payment</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Orders</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="charts">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link text-white" href="neworders.php">Pending Approval</a></li>
          <li class="nav-item"> <a class="nav-link text-white" href="approvedorders.php">Approved</a></li>
          <li class="nav-item"> <a class="nav-link text-white" href="ordersshipping.php">Under Shipment</a></li>
          <li class="nav-item"> <a class="nav-link text-white" href="deliveredorders.php">Delivered</a></li>
          <li class="nav-item"> <a class="nav-link text-white" href="rejectedorders.php">Rejected</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" data-toggle="collapse" href="#charts2" aria-expanded="false" aria-controls="charts2">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Supply Management</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="charts2">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link text-white" href="newsupply.php">New Supply Requests</a></li>
          <li class="nav-item"> <a class="nav-link text-white" href="approvedsupply.php">Approved Supplies</a></li>
        </ul>
      </div>
    </li>
   <!-- <li class="nav-item"> 
      <a class="nav-link text-white" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
        <i class="icon-grid-2 menu-icon"></i>
        <span class="menu-title">Services</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="tables">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link text-white" href="newbookings.php">New Bookings</a></li>
          <li class="nav-item"> <a class="nav-link text-white" href="assignedtechnician.php">Assigned to Technician</a></li>
          <li class="nav-item"> <a class="nav-link text-white" href="completedservices.php">Completed Services</a></li>
        </ul>
      </div>
    </li> -->
    <li class="nav-item">
            <a class="nav-link text-white" data-toggle="collapse" href="#feedback" aria-expanded="false" aria-controls="feedback">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Feedback History</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="feedback">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link text-white" href="feedback.php">Feedback</a></li>
              </ul>
            </div>
          </li>
  </ul>
</nav>
