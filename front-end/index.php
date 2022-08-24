<!doctype html>
<html lang="en">

    <?php include 'head.php'; ?>
    <body>
        <!--================Header Area =================-->
        <?php include 'header.php'; ?>
        <!--================Header Area =================-->
        
        <!-- Modal Area -->
            <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          <form action="" method="POST" name="booking-form">
                              <div class="modal-header">
                                  <h4 class="modal-title">Fill-in Booking info</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <div class="customer-details">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="firstname">Firstname</label><small>(Required)</small>
                                                    <input type="text" name="firstname" id="firstname" class="form-control" required>
                                                </div>
                                            </div>
                        
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="middlename">Middlename</label>
                                                    <input type="text" name="middlename" id="middlename" class="form-control">
                                                </div>
                                            </div>
                        
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="lastname">Lastname</label><small>(Required)</small>
                                                    <input type="text" name="lastname" id="lastname" class="form-control" required>
                                                </div>
                                            </div>
                        
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Phone</label><small>(Required)</small>
                                                    <input type="number" name="phone" id="phone" class="form-control" required>
                                                </div>
                                            </div>
                        
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="age">Age</label>
                                                    <input type="number" name="age" id="age" class="form-control">
                                                </div>
                                            </div>
                        
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                  <div class="d-block">
                                                      <label for="gender">Gender</label>
                                                  </div>
                                                    <label for="genderMale" class="mr-5">Male <input type="radio" name="gender" value="Male" id="genderMale"> </label>
                                                    <label for="genderFemale">Female <input type="radio" name="gender" value="Female" id="genderFemale"> </label>
                                                    
                                                    <!-- <select name="gender" id="gender" class="form-control" required>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select> -->
                                                </div>
                                            </div>
                        
                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control">
                                                </div>
                                            </div>
                        
                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <textarea name="address" id="address" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="booking-details d-none">

                                        <div class="row">

                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="customer">Customer</label>
                                                    <input type="text" readonly name="customer" id="customer" class="form-control">
                                                </div>
                                            </div>
                    
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="facility">Facility</label><a href="#"><small>(Check Reservation)</small></a>
                                                    <input type="text" name="facility" id="facility" class="form-control">
                                                </div>
                                            </div>
                    
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="event">Event</label>
                                                    <input type="text" name="event" id="event" class="form-control">
                                                </div>
                                            </div>
                    
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="guest">No of Guest</label>
                                                    <input type="number" name="guest" id="guest" class="form-control">
                                                </div>
                                            </div>
                    
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="event-from">From</label>
                                                    <input type="text" name="event-from" id="event-from" class="form-control datepicker">
                                                </div>
                                            </div>
                    
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="event-to">To</label>
                                                    <input type="text" name="event-to" id="event-to" class="form-control datepicker">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="sunmitButtonIndicator" value="customer-details">
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default close-modal-booking" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-default prev-modal-booking d-none">Prev</button>
                                  <button type="submit" class="btn btn-primary" id="submitBook">Next</button>
                                </div>
                          </form>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                </div>
            </div>



            <div class="modal fade" id="userRegistrationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          <form action="" method="POST" name="login-form" id="register-login-form">
                              <div class="modal-header">
                                  <h4 class="modal-title">Login</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <div class="login-details">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="login-username">Username</label><small></small>
                                                    <input type="text" name="login-username" id="login-username" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="login-password">Password</label>
                                                    <input type="password" name="login-password" id="login-password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="register-details d-none">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="register-username">Username</label><small>(Required)</small>
                                                    <input type="text" name="register-username" id="register-username" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="register-password">Password</label><small>(Required)</small>
                                                    <input type="password" name="register-password" id="register-password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <input type="hidden" id="sunmitButtonIndicator" value="customer-details">
                                <div class="modal-footer">
                                    <a href="#" class="alreadyHave d-none">I already have an Account</a>
                                    <a href="#" class="dontHave">I don't have an Account</a>
                                  <button type="submit" class="btn btn-primary" id="submitLogReg">Login</button>
                                </div>
                          </form>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                </div>
            </div>
        <!-- Modal -->

        <!--================Banner Area =================-->
        <section class="banner_area">
            <div class="booking_table d_flex align-items-center">
            	<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<div class="container">
					<div class="banner_content text-center">
						<h6>Away from monotonous life</h6>
						<h2>Relax Your Mind</h2>
						<p>If you are looking at blank cassettes on the web, you may be very confused at the<br> difference in price. You may see some for as low as $.17 each.</p>
						<a href="#" class="btn theme_btn button_hover">Get Started</a>
					</div>
				</div>
            </div>
        </section>
        <!--================Banner Area =================-->
        
        <!--================ Accomodation Area  =================-->
        <section class="accomodation_area section_gap">
            <div class="container">
                <div class="section_title text-center">
                    <h2 class="title_color">Hotel Accomodation</h2>
                    <p>We all live in an age that belongs to the young at heart. Life that is becoming extremely fast, </p>
                </div>
                <div class="row mb_30">

                    <div class="col-lg-3 col-sm-6">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img">
                                <img src="image/room1.jpg" alt="">
                                <button class="btn theme_btn button_hover book_btn" facility-Id="1" facility-Name="room 1" data-toggle="modal" data-target="#bookingModal">Book</button>
                            </div>
                            <a href="#"><h4 class="sec_h4">Double Deluxe Room</h4></a>
                            <h5>$250<small>/night</small></h5>
                        </div>
                    </div>

                    <!-- <div class="col-lg-3 col-sm-6">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img">
                                <img src="image/room2.jpg" alt="">
                                <a href="#" class="btn theme_btn button_hover">Add to List</a>
                            </div>
                            <a href="#"><h4 class="sec_h4">Single Deluxe Room</h4></a>
                            <h5>$200<small>/night</small></h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img">
                                <img src="image/room3.jpg" alt="">
                                <a href="#" class="btn theme_btn button_hover">Add to List</a>
                            </div>
                            <a href="#"><h4 class="sec_h4">Honeymoon Suit</h4></a>
                            <h5>$750<small>/night</small></h5>
                        </div>
                    </div>


                    <div class="col-lg-3 col-sm-6">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img">
                                <img src="image/room4.jpg" alt="">
                                <a href="#" class="btn theme_btn button_hover">Add to List</a>
                            </div>
                            <a href="#"><h4 class="sec_h4">Economy Double</h4></a>
                            <h5>$200<small>/night</small></h5>
                        </div>
                    </div> -->


                </div>
            </div>
        </section>
        <!--================ Accomodation Area  =================-->
        
        <!--================ About History Area  =================-->
        <section class="about_history_area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 d_flex align-items-center">
                        <div class="about_content ">
                            <h2 class="title title_color">About Us <br>Our History<br>Mission & Vision</h2>
                            <p>inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach. inappropriate behavior is often laughed.</p>
                            <a href="#" class="button_hover theme_btn_two">Request Custom Price</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img class="img-fluid" src="image/about_bg.jpg" alt="img">
                    </div>
                </div>
            </div>
        </section>
        <!--================ About History Area  =================-->
        
        <!--================ Testimonial Area  =================-->
        <section class="testimonial_area section_gap">
            <div class="container">
                <div class="section_title text-center">
                    <h2 class="title_color">Testimonial from our Clients</h2>
                    <p>The French Revolution constituted for the conscience of the dominant aristocratic class a fall from </p>
                </div>
                <div class="testimonial_slider owl-carousel">
                    <div class="media testimonial_item">
                        <img class="rounded-circle" src="image/testtimonial-1.jpg" alt="">
                        <div class="media-body">
                            <p>As conscious traveling Paupers we must always be concerned about our dear Mother Earth. If you think about it, you travel across her face, and She is the </p>
                            <a href="#"><h4 class="sec_h4">Fanny Spencer</h4></a>
                            <div class="star">
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star-half-o"></i></a>
                            </div>
                        </div>
                    </div>    
                    <div class="media testimonial_item">
                        <img class="rounded-circle" src="image/testtimonial-1.jpg" alt="">
                        <div class="media-body">
                            <p>As conscious traveling Paupers we must always be concerned about our dear Mother Earth. If you think about it, you travel across her face, and She is the </p>
                            <a href="#"><h4 class="sec_h4">Fanny Spencer</h4></a>
                            <div class="star">
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star-half-o"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="media testimonial_item">
                        <img class="rounded-circle" src="image/testtimonial-1.jpg" alt="">
                        <div class="media-body">
                            <p>As conscious traveling Paupers we must always be concerned about our dear Mother Earth. If you think about it, you travel across her face, and She is the </p>
                            <a href="#"><h4 class="sec_h4">Fanny Spencer</h4></a>
                            <div class="star">
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star-half-o"></i></a>
                            </div>
                        </div>
                    </div>    
                    <div class="media testimonial_item">
                        <img class="rounded-circle" src="image/testtimonial-1.jpg" alt="">
                        <div class="media-body">
                            <p>As conscious traveling Paupers we must always be concerned about our dear Mother Earth. If you think about it, you travel across her face, and She is the </p>
                            <a href="#"><h4 class="sec_h4">Fanny Spencer</h4></a>
                            <div class="star">
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star-half-o"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ Testimonial Area  =================-->
        
        <!--================ start footer Area  =================-->	
        <?php include 'footer.php'; ?>
    </body>
    <script>
        $(document).ready(function(){

            $('.alreadyHave').on('click', function(){
                $('.register-details').addClass('d-none');
                $('.login-details').removeClass('d-none');
                $('#userRegistrationModal .modal-title').text('Login')
                $(this).addClass('d-none');
                $('.dontHave').removeClass('d-none');
                $('#register-login-form').attr('name', 'login-form');
                $('#submitLogReg').text('Login');

            })
            $('.dontHave').on('click', function(){
                $('.login-details').addClass('d-none');
                $('.register-details').removeClass('d-none');
                $('#userRegistrationModal .modal-title').text('Register');
                $(this).addClass('d-none');
                $('.alreadyHave').removeClass('d-none');
                $('#register-login-form').attr('name', 'register-form');
                $('#submitLogReg').text('Sign up');

            })

            $('.book_btn').on('click', function(){
                
                $('#facility').val( $(this).attr('facility-Name') );
            });
            $('[name=booking-form]').on('submit', function(e){
                if($('#sunmitButtonIndicator').val() == 'customer-details'){
                    // modal becomes booking

                    $('.prev-modal-booking').removeClass('d-none');
                    $('.close-modal-booking').addClass('d-none');
                    $('#sunmitButtonIndicator').val('booking-details');
                    $('.customer-details').addClass('d-none');

                    
                    $("#event").attr('required', true);
                    $("#event-from").attr('required', true);
                    $("#event-to").attr('required', true);
                    $('.booking-details').removeClass('d-none');
                    $('#customer').val($('#firstname').val() + ' ' + $('#lastname').val());
                    $('#submitBook').text('Submit');
                }else if($('#sunmitButtonIndicator').val() == 'booking-details'){
                    // modal becomes booking

                    var firstname = $('#firstname').val();
                    var lastname = $('#lastname').val();
                    var phone = $('#phone').val();
                    var middlename = $('#middlename').val();
                    var age = $('#age').val();
                    var gender = $("[name=gender]").val();
                    var email = $('#email').val();
                    var address = $('#address').val();
                    var facility = $('#facility').val();
                    var event = $('#event').val();
                    var guest = $('#guest').val();
                    var eventrom = $('#event-from').val();
                    var evento = $('#event-to').val();
                    $.ajax({
                        url : '../customerAction.php',
                        method : 'POST',
                        dataType : "JSON",
                        data : {
                            action : 'reserve',
                            firstname : firstname,
                            lastname : lastname,
                            phone : phone,
                            middlename : middlename,
                            age : age,
                            gender : gender,
                            email : email,
                            address : address,
                            facility : facility,
                            event : event,
                            guest : guest,
                            eventrom : eventrom,
                            evento : evento
                        },
                        success : function(res){
                            console.log('res', res);
                            if(res.status == 'success'){
                                $('#bookingModal').modal('hide');
                                Swal.fire({
                                        title: 'Good job!',
                                        text: 'Your reservation has been succesfully Queed, proceed to payment.',
                                        type: 'success',
                                        timer: 2000
                                });
                                setTimeout(() => {
                                    $('#userRegistrationModal').modal('show');
                                }, 2000);
                            }else{
                                alert(res.message);
                            }
                        }
                    })

                }
                e.preventDefault();



            });

            $('.prev-modal-booking').on('click', function(){
                if($('#sunmitButtonIndicator').val() == 'booking-details'){
                    // modal becomes booking
                    $("#event").removeAttr('required');
                    $("#event-from").removeAttr('required');
                    $("#event-to").removeAttr('required');
                    $('#sunmitButtonIndicator').val('customer-details');
                    $(this).addClass('d-none');
                    $('.close-modal-booking').removeClass('d-none');
                    $('.customer-details').removeClass('d-none');
                    $('.booking-details').addClass('d-none');
                    $('#submitBook').text('Next');
                }
            });

            $('[name=event-from]').datepicker();
            $('[name=event-to]').datepicker();
        })
    </script>
</html>