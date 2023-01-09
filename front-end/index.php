<!doctype html>
<html lang="en">
    <?php 

        require_once '../Config/Config.php'; 

        require_once '../Model/Model.php'; 
        
        require_once '../Controller/Controller.php'; 

        $controller = new Controller(); 
        $getTheFacilities = $controller->getFacilityAndCat();
        // echo '<pre>';
        // print_r($getTheFacilities);

        // foreach ($getTheFacilities as $key => $value) {
        //     print_r($value);
        // }

        // die();
    ?>
    <?php include 'head.php'; ?>
    <body>
        <!--================Header Area =================-->
        <?php include 'header.php'; ?>
        <!--================Header Area =================-->
        <style>
            .hotel_img {
                height: 330px;
            }
            div.checkAvail{
                display: none;
            }
            div.hotel_img:hover .checkAvail{
                display: block;
            }
            div.custom-modal{
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 1000;
                background-color: #bbbabaa1;
                opacity: 0;
            }
            div.custom-modal-inner{
                height: auto;
                width: 50em;
                margin: auto;
                background-color: white;
                padding: 5px 30px 30px 30px;
                margin-top: 40px;
            }
            .facility-image{
                width: 100%;
            }
            .close-button{
                float: right;
            }
            .entrance-info{
                width: 600px;
                background: #00000052;
                margin: auto;
                padding: 30px;
            }
        </style>
        <?php if(isset($_GET['facilityId'])) : include 'FacilityInfo.php'; endif; ?>
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
                                    <input type="hidden" name="faclityImg">
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
            <div class="booking_table d_flex align-items-center" style="background:url(image/321037410_1237344170527706_6969103792943382784_n.jpg);     background-repeat: no-repeat;
            background-size: cover;">
            	<div class="" ></div> 
				<div class="container">
					<div class="banner_content text-center">
						<!-- <h6>Away from monotonous life</h6> -->
						<!-- <h2>Relax Your Mind</h2> -->
						
						<div class="entrance-info">
                            <div>
                                <h3>G-Em's Pool Park</h3>
                            </div>
                            <div style="margin-top: 10px">
                                <h4>Entrance fee</h4>
                       
                                    <label style="display: block;
                                            margin: 0;
                                            line-height: 1; font-size:30px;"> <b>Adult:</b> Php 30.00</label>
                                                                            <label style="display: block;
                                            margin: 0;
                                            line-height: 1; font-size:30px;"><b>Children:</b> Php 20.00</label> 
                                    
                            </div>
                            <div style="margin-top: 10px; font-size:30px;">
                                <!-- <h4>Facility prices</h4>
                       
                                <label style="display: block;
                                        margin: 0;
                                        line-height: 1;"> <b>Cottages:</b> Php 30.00</label>
                                                                    <label style="display: block;
                                        margin: 0;
                                        line-height: 1;"><b>Room:</b> Php 20.00</label>  -->
                                        <p>Open Monday to Sunday
                                            8 am-5pm</p>
                            </div>


                    
                    </div>

                        </div>
					</div>
				</div>
            </div>
        </section>
        <!-- <input type="text" id="rangrpick"> -->
        <!--================Banner Area =================-->
        
        <!--================ Accomodation Area  =================-->
    

        <?php
            
            foreach ($getTheFacilities as $key => $value) {
                ?>

                <section class="accomodation_area section_gap" id="reservation-section">
                    <div class="container">
                        <div class="section_title text-center">
                            <h2 class="title_color"><?php echo ucfirst($value['categoryName']); ?></h2>
                        </div>
                        <div class="row mb_30">
                            <?php
                                $partialReservedFacilityIds = [];
                                if(isset($_SESSION['Facilities'])){
                                    foreach ($_SESSION['Facilities'] as $facility) {
                                        array_push($partialReservedFacilityIds, $facility['facilityId']);
                                    }
                                }
                                $getTheFacilitiesData = $value['facilties'];
                                foreach ($getTheFacilitiesData as $getTheFacility) {
   
                                    if($getTheFacility['status'] == 'Activated' || $getTheFacility['status'] == ''){
                                        ?>
                                            <div class="col-lg-3 col-sm-6">
                                                <div class="accomodation_item text-center">
                                                    <div class="hotel_img">
                                                        <img src="../public/uploads/images/<?php echo  explode(',', $getTheFacility['Image'])[0]; ?>" alt="" class="facility-image">
                                                        <div class="checkAvail" style="position: absolute;
                                                                                        bottom: 50%;
                                                                                        left: 50%;
                                                                                        -webkit-transform: translate(-50%);
                                                                                        -ms-transform: translate(-50%);
                                                                                        transform: translate(-50%);
                                                                                        max-width: 128px;">
                                                            <button class="btn btn-secondary availabilty-button" facility-Id="<?php echo $getTheFacility['Facility_id'] ?>">Availability</button>
                                                        </div>

                                                        <div class="checkAvail" style="position: absolute;
                                                                                        bottom: 65%;
                                                                                        left: 50%;
                                                                                        -webkit-transform: translate(-50%);
                                                                                        -ms-transform: translate(-50%);
                                                                                        transform: translate(-50%);
                                                                                        max-width: 128px;">
                                                        
                                                            <a class="btn btn-primary" href="index.php?facilityId=<?php echo $getTheFacility['Facility_id'] ?>" style="color: white;">Check info</a>
                                                        </div>
                                                        <?php if(in_array($getTheFacility['Facility_id'], $partialReservedFacilityIds)) :?>
                                                            <button class="btn theme_btn btn-disabled" dsiabled style="background: #c3b88d">ADDED</button>
                                                        <?php else : ?>
                                                            <button class="btn theme_btn button_hover book_btn" facility-description="<?php echo $getTheFacility['description'] ?>" facility-Id="<?php echo $getTheFacility['Facility_id'] ?>" facility-Name="<?php echo $getTheFacility['Facility_name'] ?>" facility-price="<?php echo $getTheFacility['Price'] ?>" faclity-img="<?php echo $getTheFacility['Image'] ?>">ADD</button>
                                                        <?php endif; ?>
                                                        
                                                    </div>
                                                    <a href="#"><h4 class="sec_h4"><?php echo $getTheFacility['Facility_name'] ?></h4></a>
                                                    <h5>₱<?php echo $getTheFacility['Price'] ?></h5>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                    
                                }

                            ?>
                        </div>
                    </div>
                </section>

                <?php
            }

        ?>
        

        <!--================ Accomodation Area  =================-->
        
        <!--================ About History Area  =================-->
        <section class="about_history_area section_gap">
            <div class="container">
                <div class="row">
                    <!-- <div class="col-md-6 d_flex align-items-center">
                        <div class="about_content ">
                            <h2 class="title title_color">About Us <br>Our History<br>Mission & Vision</h2>
                            <p>inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach. inappropriate behavior is often laughed.</p>
                            <a href="#" class="button_hover theme_btn_two">Request Custom Price</a>
                        </div>
                    </div> -->
                    <div class="col-md-6" style="margin: 0px">
                        <img class="img-fluid" src="image/315428876_2219123081593320_5842634044671867908_n.jpg" alt="img">
                    </div>

                    <div class="col-md-6" style="margin: 0px">
                        <img class="img-fluid" src="image/315309838_1255862745191327_1797608035436533867_n.jpg" alt="img">
                    </div>
                    
                    <div class="col-md-6" style="margin: 0px">
                        <img class="img-fluid" src="image/315333879_1684836628597836_1472535249096587123_n.jpg" alt="img">
                    </div>
                    
                    <div class="col-md-6" style="margin: 0px">
                        <img class="img-fluid" src="image/315501084_1995454697314149_1894333834487987860_n.jpg" alt="img">
                    </div>

                </div>
            </div>
            
        </section>
       
        <!-- Modal -->
        <div class="custom-modal">
            
            <div class="custom-modal-inner">
                <p class="clearfix"><span class="close-button" style="text-align: right; cursor:pointer; font-weight:bold">Close</span></p>
                <div id="calendar"></div>
            </div>
        </div>
        <!-- / Modal -->
        <?php include 'footer.php'; ?>
    </body>
    <script>

        $(document).ready(function(){

            $('div.custom-modal').fadeOut('display');
            $('.close-button').on('click', function(){
                $('.custom-modal').fadeOut();
                window.location.reload();
                calendar.removeAllEvents();
            })
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl,{
                initialView: 'dayGridMonth'
            });
            calendar.render();
            $('.availabilty-button').on('click', function(){
                $('div.custom-modal').css('opacity', 1);
                var facId = $(this).attr('facility-Id');
                $.ajax({
                    url : "../customerAction.php",
                    method : "POST",
                    dataType: 'JSON',
                    data : {
                        action : 'getFacilityReservation',
                        faciltyId : facId
                    },
                    success: function(res){
                        // calendar.removeAllEvents();
                        console.log('res', res);
                        $('.custom-modal').fadeIn();
                        if(res.length > 0){
                            for (let index = 0; index < res.length; index++) {
                                const element = res[index];
                                var date = new Date(element + 'T00:00:00'); // will be in local time
                                calendar.addEvent({
                                    title: 'Reserved',
                                    start: date,
                                    allDay: true,
                                    backgroundColor: '#ff5b5b'
                                });
                            }
                        }
                    }
                });
            });

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
                var faclityImg = $(this).attr('faclity-img');
                
                $('[name=facilityId]').val(facility_id);
                $('[name=facilityPrice]').val(facility_price);
                $('[name=facilityName]').val(facility_name);
                $('[name=facilityDescription]').val(facilityDescription);
                $('[name=faclityImg]').val(faclityImg);
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
                        var today = new Date();
                        // var dd = String(today.getDate()).padStart(2, '0');
                        // var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                        // var yyyy = today.getFullYear();
                        $('[name=reserveDate]').daterangepicker({
                                                                    timePicker: true,
                                                                    locale : {
                                                                        format : 'YYYY/MM/DD'
                                                                    },
                                                                    isInvalidDate: function(ele) {
                                                                        var currDate = moment(ele._d).format('YY-MM-DD');
                                                                        return disabledDates.indexOf(currDate) != -1;
                                                                    },
                                                                    autoUpdateInput: false,
                                                                    minDate: today ,
                                                                },function(start, end, label){
                                                                    var strtDate = start.format('Y-MM-DD HH:mm');
                                                                    var endDate = end.format('Y-MM-DD HH:mm');
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
                });
            });

            $(".owl-carousel").owlCarousel({
                items:1,
                // loop:true,
                // nav:true,
                merge:true,
                autoHeight:true
            });
        })
    </script>
</html>