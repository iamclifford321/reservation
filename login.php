<?php
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reservation and Billing system</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
       <link rel="stylesheet" type="text/css" href="loginTemplate/vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
       <link rel="stylesheet" type="text/css" href="loginTemplate/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
       <link rel="stylesheet" type="text/css" href="loginTemplate/fonts/iconic/css/material-design-iconic-font.min.css">
  <!--===============================================================================================-->
       <link rel="stylesheet" type="text/css" href="loginTemplate/vendor/animate/animate.css">
  <!--===============================================================================================-->	
       <link rel="stylesheet" type="text/css" href="loginTemplate/vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
       <link rel="stylesheet" type="text/css" href="loginTemplate/vendor/animsition/css/animsition.min.css">
  <!--===============================================================================================-->
       <link rel="stylesheet" type="text/css" href="loginTemplate/vendor/select2/select2.min.css">
  <!--===============================================================================================-->	
       <link rel="stylesheet" type="text/css" href="loginTemplate/vendor/daterangepicker/daterangepicker.css">
  <!--===============================================================================================-->
       <link rel="stylesheet" type="text/css" href="loginTemplate/css/util.css">
       <link rel="stylesheet" type="text/css" href="loginTemplate/css/main.css">
  <!--===============================================================================================-->
       <!-- SweetAlert2 -->
       <link rel="stylesheet" href="public/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <style>
          
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="" id="formLogin" action="adminAction.php" method="POST">
					<span class="login100-form-title p-b-26">
						Welcome
					</span>

					<div class="wrap-input100" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="username"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn" >
								Login
							</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>

<!-- ./wrapper -->

</body>
<!--===============================================================================================-->
<script src="loginTemplate/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="loginTemplate/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="loginTemplate/vendor/bootstrap/js/popper.js"></script>
	<script src="loginTemplate/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="loginTemplate/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="loginTemplate/vendor/daterangepicker/moment.min.js"></script>
	<script src="loginTemplate/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="loginTemplate/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <!-- SweetAlert2 -->
    <script src="public/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
	<script src="loginTemplate/js/main.js"></script>
<script>
     $(document).ready(function(){
          var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
          });

          $('form#formLogin').on('submit', function(event){
               try {
                    $.ajax({
                         url : 'adminAction.php',
                         method : 'POST',
                         dataType : 'JSON',
                         data : {
                              action : 'login',
                              password : $('[name=password]').val(),
                              username : $('[name=username]').val()
                         },
                         success: function(res){
                              if( res['status'] == 'invalid'){
                                   Toast.fire({
                                        icon: 'error',
                                        title: 'Username and Password is Invalid'
                                   });
                              }else{
                                   Toast.fire({
                                        icon: 'success',
                                        title: 'Login successful'
                                   });
                                   window.location.href = "./?isAdmin=true";
                              }
                         },
                         error : function(error){
                              console.log(error);
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