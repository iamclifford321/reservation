<!doctype html>
<html lang="en">
    <?php 

        require_once '../Config/Config.php'; 

        require_once '../Model/Model.php'; 
        
        require_once '../Controller/Controller.php'; 

        $controller = new Controller(); 
        $getTheFacilities = $controller->getTheFicilities();
    ?>
    <?php include 'head.php'; ?>
    <body>
        <!--================Header Area =================-->
        <?php include 'header.php'; ?>
        <!--================Header Area =================-->
        
        <!-- Modal Area -->
            <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          <form action="addBook.php" method="GET" name="booking-form">
                              <div class="modal-header">
                                  <h4 class="modal-title">Fill-in Booking info</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                    <input type="hidden" name="facilityId">
                                    <input type="hidden" name="facilityPrice">
                                    <input type="hidden" name="facilityName">
                                    <input type="hidden" name="facilityDescription">
                                    <input type="hidden" name="fromDate">
                                    <input type="hidden" name="toDate">


                                    <div class="form-group">
                                        <label for="reserveDate">Reservation Date</label>
                                        <input type="text" name="reserveDate" id="reserveDate" class="form-control">
                                        <small class="text-danger d-none alert-reserve">There has already been a reservation on the selected date.</small>
                                    </div>
                                </div>
                                <input type="hidden" id="sunmitButtonIndicator" value="customer-details">
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default close-modal-booking" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary" id="submitBook" disabled="true">Proceed</button>
                                </div>
                          </form>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                </div>
            </div>
            

            <div class="modal fade" id="book-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          <form action="" method="POST" name="book-form" id="create-book-form">
                              <div class="modal-header">
                                  <h4 class="modal-title">Booking details</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    
                                <div class="booking-details">

                                    <div class="row">


                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="facility-direct">Facility</label><a href="#"><small>(Check Reservation)</small></a>
                                                <input type="text" name="facility-direct" id="facility-direct" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="event-direct">Event</label>
                                                <input type="text" name="event-direct" id="event-direct" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="guest-direct">No of Guest</label>
                                                <input type="number" name="guest-direct" id="guest-direct" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="event-from-direct">Reservation date</label>
                                                <input type="text" name="event-from-direct" id="event-from-direct" class="form-control datepicker">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- <input type="hidden" id="sunmitButtonIndicator" value="customer-details"> -->
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary" id="">Book</button>
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
                                  <h4 class="modal-title">Login first</h4>
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
                                <!-- <input type="hidden" id="sunmitButtonIndicator" value="customer-details"> -->
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
        <!-- <input type="text" id="rangrpick"> -->
        <!--================Banner Area =================-->
        
        <!--================ Accomodation Area  =================-->
        <section class="accomodation_area section_gap" id="reservation-section">
            <div class="container">
                <div class="section_title text-center">
                    <h2 class="title_color">Hotel Accomodation</h2>
                    <p>We all live in an age that belongs to the young at heart. Life that is becoming extremely fast, </p>
                </div>
                <div class="row mb_30">
                    <?php
                        $partialReservedFacilityIds = [];
                        if(isset($_SESSION['Facilities'])){
                            foreach ($_SESSION['Facilities'] as $facility) {
                                array_push($partialReservedFacilityIds, $facility['facilityId']);
                            }
                        }
                        foreach ($getTheFacilities as $getTheFacility) {
                            ?>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="accomodation_item text-center">
                                        <div class="hotel_img">
                                            <img src="image/room1.jpg" alt="">
                                            <?php if(in_array($getTheFacility['Facility_id'], $partialReservedFacilityIds)) :?>
                                                <button class="btn theme_btn btn-disabled" dsiabled style="background: #c3b88d">ADDED</button>
                                            <?php else : ?>
                                                <button class="btn theme_btn button_hover book_btn" facility-description="<?php echo $getTheFacility['description'] ?>" facility-Id="<?php echo $getTheFacility['Facility_id'] ?>" facility-Name="<?php echo $getTheFacility['Facility_name'] ?>" facility-price="<?php echo $getTheFacility['Price'] ?>">ADD</button>
                                            <?php endif; ?>
                                        </div>
                                        <a href="#"><h4 class="sec_h4"><?php echo $getTheFacility['Facility_name'] ?></h4></a>
                                        <h5>₱<?php echo $getTheFacility['Price'] ?></h5>
                                    </div>
                                </div>
                            <?php
                        }
                    ?>
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
            
            // console.log( isDateBetween('2022-10-11', '2022-10-15', '2022-10-14') );
            function isDateBetween(dateFrom, dateTo, dateCheck){
                console.log('dateFrom', dateFrom);
                var from = new Date(dateFrom);  // -1 because months are from 0 to 11
                var to   = new Date(dateTo);
                var check = new Date(dateCheck);

                return check >= from && check <= to;
            }



            $('.book_btn').on('click', function(){
                var facility_id = $(this).attr('facility-id');
                var facility_name = $(this).attr('facility-name');
                var facility_price = $(this).attr('facility-price');
                var facilityDescription = $(this).attr('facility-description');

                $('[name=facilityId]').val(facility_id);
                $('[name=facilityPrice]').val(facility_price);
                $('[name=facilityName]').val(facility_name);
                $('[name=facilityDescription]').val(facilityDescription);
                $('#bookingModal').modal('show');
                $.ajax({
                    url : "../customerAction.php",
                    method : "POST",
                    dataType: 'JSON',
                    data : {
                        action : 'getFacilityReservation',
                        faciltyId : facility_id
                    },
                    success: function(res){

                        let disabledDates = [];
                        for (const elmnt of res) {
                            disabledDates.push(moment(elmnt).format('YY-MM-DD'));
                        }
                        $('[name=reserveDate]').daterangepicker({
                                                                    locale : {
                                                                        format : 'YYYY/MM/DD'
                                                                    },
                                                                    isInvalidDate: function(ele) {
                                                                        var currDate = moment(ele._d).format('YY-MM-DD');
                                                                        return disabledDates.indexOf(currDate) != -1;
                                                                    },
                                                                    autoUpdateInput: false,
                                                                },function(start, end, label){
                                                                    var strtDate = start.format('Y-MM-DD');
                                                                    var endDate = end.format('Y-MM-DD');
                                                                    // console.log(endDate);
                                                                    var isValid = true;
                                                                    for (const elmnt of res) {
                                                                        if(isDateBetween(strtDate, endDate, elmnt)){
                                                                            isValid = false;
                                                                        }
                                                                    }
                                                                    if(!isValid){
                                                                        $('.alert-reserve').removeClass('d-none');
                                                                        $('#submitBook').prop('disabled', true);
                                                                        $('[name=reserveDate]').val(strtDate + ' to ' + endDate);
                                                                        return;
                                                                    }
                                                                    $('.alert-reserve').addClass('d-none');
                                                                    
                                                                    $('#submitBook').prop('disabled', false);
                                                                    $('[name=fromDate]').val(strtDate);
                                                                    $('[name=toDate]').val(endDate);
                                                                    $('[name=reserveDate]').val(strtDate + ' to ' + endDate);
                                                                });
                    }
                })


            });
        })
    </script>
</html>