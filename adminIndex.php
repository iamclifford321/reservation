<?php
    include 'Config/sessionAdmin.php';
    require_once 'Config/Config.php'; 
    require_once 'Model/Model.php'; 
    require_once 'Controller/Controller.php'; 
    if(!isset($_GET['page'])) die("<center><h1 class='text-align: center'>Page not found</h1></center>");
     $dashboard     = '';
     $reservation   = '';
     $users         = '';
     $facilities    = '';
     $billing       = '';
     $payment       = '';
     $customer      = '';
     $refund        = '';

     if($_GET['page']=='dashboard'){

        $dashboard      = 'active';

     }elseif ($_GET['page']=='reservations' || $_GET['page']=='payment' || $_GET['page']=='paymentHistory' || $_GET['page'] == 'approveCancelation') {

        $reservation    = 'active';

     }elseif ($_GET['page']=='facilities') {

        $facilities     = 'active';

     }elseif ($_GET['page']=='users') {

        $users          = 'active';

     }elseif ($_GET['page']=='billing') {

        $billing        = 'active';

     }elseif ($_GET['page']=='payments') {

        $payment        = 'active';

     }elseif ($_GET['page']=='customer') {

        $customer       = 'active';

     }elseif ($_GET['page']=='refund') {

        $refund       = 'active';

     }elseif ($_GET['page']=='SalesReport') {


     }elseif ($_GET['page']=='editProfile') {


    }elseif($_GET['page'] == 'amenities'){
        $amenities = 'active';
    }
    elseif($_GET['page'] == 'approve'){
        
    }
     else{
        die("<center><h1 class='text-align: center'>Page not found</h1></center>");
     }
     
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservation and Billing system</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="public/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="public/assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="public/assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="public/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="public/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- Datepicker -->
    <link rel="stylesheet" href="public/assets/plugins/datepicker/jquery-ui.css">
    <!-- summernote -->
    <link rel="stylesheet" href="public/assets/plugins/summernote/summernote-bs4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="public/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    
    <!-- jQuery -->
    <script src="public/assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="public/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <!-- Bootstrap 4 -->
    <script src="public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="public/assets/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="public/assets/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="public/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="public/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="public/assets/plugins/jquery-knob/jquery.knob.min.js"></script>

    <!-- daterangepicker -->
    <script src="public/assets/plugins/moment/moment.min.js"></script>
    <script src="public/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    
    <!-- <script src="public/assets/plugins/datepicker/jquery-3.6.0.js"></script> -->
    <!-- <script src="public/assets/plugins/datepicker/jquery-ui.js"></script> -->
    <!-- Tempusdominus Bootstrap 4 -->
    
    <script src="public/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="public/assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="public/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="public/assets/dist/js/adminlte.js"></script>


    <script src="public/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="public/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="public/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="public/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="public/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="public/assets/plugins/jszip/jszip.min.js"></script>
    <script src="public/assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="public/assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="public/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="public/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="public/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="public/assets/plugins/sweetalert2/sweetalert2.min.js"></script>


    <!-- Full calendar -->
    <link rel="stylesheet" href="public/assets/plugins/fullcalendar/main.css">
    <script src="public/assets/plugins/fullcalendar/main.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">


                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <!-- <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a> -->
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="public/assets/dist/img/Basic_Ui_(186).jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="public/assets/dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="public/assets/dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="Config/logout.php?isAdmin=true">
                        Sign Out
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <i class="far fas-g"></i>
                <!-- <img src="public/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
                <span class="brand-text font-weight-light">Gem's Eco Park</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <i class="fa-solid fa-g"></i>
                        <img src="public/assets/dist/img/Basic_Ui_(186).jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="?page=editProfile" class="d-block"><?php echo ucfirst($_SESSION['user_data']['FirstName']) . ' ' . ucfirst($_SESSION['user_data']['LastName']) ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="?page=dashboard" class="nav-link <?php echo $dashboard ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=customer" class="nav-link <?php echo $customer ?>">
                                <i class="nav-icon fas fa-file-invoice"></i>
                                <p>
                                    Customers
                                </p>
                            </a>
                        </li>
                        <!-- <li class="nav-header">EXAMPLES</li> -->
                        <li class="nav-item">
                            <a href="?page=reservations" class="nav-link <?php echo $reservation ?>">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Reservations
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=facilities" class="nav-link <?php echo $facilities ?>">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Facilities
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?page=amenities" class="nav-link <?php echo $amenities ?>">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Amenities
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?page=users" class="nav-link <?php echo $users ?>">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=payments" class="nav-link <?php echo $payment ?>">
                                <i class="nav-icon fas fa-money-bill-alt"></i>
                                <p>
                                    Entrance fee
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=SalesReport&type=Weekly&value=This Week" class="nav-link">
                                <i class="nav-icon fas fa-file-invoice"></i>
                                <p>
                                    Report
                                </p>
                            </a>
                        </li>

                        <!-- <li class="nav-item">
                            <a href="?page=refund" class="nav-link <?php echo $refund ?>">
                                <i class="nav-icon fas fa-money-bill-alt"></i>
                                <p>
                                    Refund
                                </p>
                            </a>
                        </li> -->

                        <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Search
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/search/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Search</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/search/enhanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Enhanced</p>
                </a>
              </li>
            </ul>
          </li> -->

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <?php
        require_once 'public/view/admin/' . $_GET['page'] . '.php';
    ?>

        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

</body>

</html>