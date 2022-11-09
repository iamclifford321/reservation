<?php
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reservation and Billing system</title>
     <!-- SweetAlert2 -->
     <link rel="stylesheet" href="../public/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
     <!-- custom style -->
  
    <!-- SweetAlert2 -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="loginTemplate/css/style.css">
    
</head>
<body class="hold-transition sidebar-mini layout-fixed">

     <!-- <div class="wrapper">
          <div id="formContent" class="d-flex align-items-center justify-content-center mt-5">

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
     </div> -->

     <section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img" style="background-image: url(loginTemplate/images/bg-1.jpg);"></div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
							<div class="w-100">
								<p class="social-media d-flex justify-content-end">
									<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
									<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
								</p>
							</div>
			      		</div>
							<form action="#" class="signin-form">

                                        <div class="form-group mt-3">
                                             <input type="text" class="form-control" required name="username">
                                             <label class="form-control-placeholder" for="username">Username</label>
                                        </div>
                                        <div class="form-group">
                                             <input id="password-field" type="password" name="password" class="form-control" required>
                                             <label class="form-control-placeholder" for="password">Password</label>
                                             <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                        <div class="form-group">
                                             <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                                        </div>

                                   </form>
		          <p class="text-center">Not a member? <a href="register-customer.php">Sign Up</a></p>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>
<!-- ./wrapper -->

</body>
<script src="loginTemplate/js/jquery.min.js"></script>
<script src="loginTemplate/js/popper.js"></script>
<script src="loginTemplate/js/bootstrap.min.js"></script>
<script src="loginTemplate/js/main.js"></script>
<script src="../public/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
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
                              console.log('res', res);
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
                                             var header = `index.php`; 
                                             if(res.reservationIdTemp != null){
                                                  header = `makePayment.php?reservationId=${res.reservationIdTemp}&customerId=${res.customerId}`; 
                                             }
                                             window.location.href = header;
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