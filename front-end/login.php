<?php
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reservation and Billing system</title>

     <!-- Google Font: Source Sans Pro -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
     <!-- Font Awesome -->
     <link rel="stylesheet" href="../public/assets/plugins/fontawesome-free/css/all.min.css">
     <!-- Ionicons -->
     <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
     <!-- Tempusdominus Bootstrap 4 -->
     <link rel="stylesheet" href="../public/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
     <!-- iCheck -->
     <link rel="stylesheet" href="../public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
     <!-- JQVMap -->
     <link rel="stylesheet" href="../public/assets/plugins/jqvmap/jqvmap.min.css">
     <!-- Theme style -->
     <link rel="stylesheet" href="../public/assets/dist/css/adminlte.min.css">
     <!-- overlayScrollbars -->
     <link rel="stylesheet" href="../public/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
     <!-- Daterange picker -->
     <link rel="stylesheet" href="../public/assets/plugins/daterangepicker/daterangepicker.css">
     <!-- summernote -->
     <link rel="stylesheet" href="../public/assets/plugins/summernote/summernote-bs4.min.css">
     <!-- SweetAlert2 -->
     <link rel="stylesheet" href="../public/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
     <!-- custom style -->
     <link rel="stylesheet" href="../public/assets/dist/css/custom.css">
    <!-- jQuery -->
    <script src="../public/assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../public/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <!-- Bootstrap 4 -->
    <script src="../public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../public/assets/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../public/assets/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../public/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../public/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../public/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../public/assets/plugins/moment/moment.min.js"></script>
    <script src="../public/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../public/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../public/assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../public/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../public/assets/dist/js/adminlte.js"></script>


    <script src="../public/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../public/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../public/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../public/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../public/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../public/assets/plugins/jszip/jszip.min.js"></script>
    <script src="../public/assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../public/assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../public/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../public/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../public/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../public/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

     <div class="wrapper">
          <div id="formContent" class="d-flex align-items-center justify-content-center mt-5">
               <!-- Tabs Titles -->
               <!-- Login Form -->
               <form action="adminAction.php" method="POST">
                    <div class="logo mb-5">
                         <h2 class="text-center">Login</h2>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" name="username">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                    </div>
                    <a href="register-customer.php">Register here</a>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
               </form>
          
          </div>
     </div>

<!-- ./wrapper -->

</body>
<script>
     $(document).ready(function(){
          var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
          });
          $('form').on('submit', function(event){
               try {


                    $.ajax({
                        url : '../customerAction.php',
                        method : 'POST',
                        dataType : "JSON",
                        data : {
                            action : 'login',
                            password : $('[name=password]').val(),
                            username : $('[name=username]').val()
                        },
                        success : function(res){

                            if( res['status'] == 'invalid'){

                                   Swal.fire(
                                    'Invalid Credentials',
                                    'The Provided Credential is invalid',
                                    'error'
                                   );

                              }else{

                                   Swal.fire({
                                        title: 'Login Success',
                                        text: 'Succesfully logged in',
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Proceed'
                                   }).then((result) => {
                                        if (result.isConfirmed) {
                                             window.location.href = 'index.php'
                                        }
                                   });
                              }
                        }
                    });
               } catch (error) {
                    console.log('error', error);
               }

               event.preventDefault(); 
                     
          })
     })
</script>
</html>