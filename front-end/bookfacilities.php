
<!doctype html>
<?php

    require_once '../Config/Config.php'; 
    require_once '../Model/Model.php'; 
    require_once '../Controller/Controller.php'; 
    $controller = new Controller(); 
    $aminities = $controller->getAminities();

?>
<html lang="en">
    
    <?php include 'head.php'; ?>
    <body>
        <!--================Header Area =================-->
        <?php include 'header.php'; ?>
        <!--================Header Area =================-->
        
        <!--================Breadcrumb Area =================-->
        <!-- <section class="breadcrumb_area">
            <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" style="background:none"></div>
            <div class="container">
                <div class="page-cover text-center">
                    <h2 class="page-cover-tittle">Facilities</h2>
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Facilities</li>
                    </ol>
                </div>
            </div>
        </section> -->
        <!--================Breadcrumb Area =================-->
        
        <!--================Contact Area =================-->
        <style>
            .card-content-divider{
                display: flex;
                align-content: center;
                align-items: center;
            }
            .card-content-divider .card-image{
                width: 120px; flex: 1;
            }
            .card-content-divider .card-content{
                flex: 3;
            }

            .card-content-divider .card-content a, .card-content-divider .card-content label{
                font-size: 16px;
            }
        </style>
        
        <section class="contact_area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                    <?php 
                        
                        $total = 0;
                        $disabled = 'disabled';
                        if(isset($_SESSION['Facilities']) && count($_SESSION['Facilities']) > 0){
                            $disabled = null;
                            // echo '<pre>';
                            // print_r($_SESSION['Facilities']);
                            // die();
                            foreach ($_SESSION['Facilities'] as $key => $facility) {
                                $total += floatval($facility['totalAmount']);
                                ?>
                                    <div class="mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-content-divider">
                                                    <div class="card-image">
                                                        <img class="card-img-top d-block" src="../public/uploads/images/<?php echo explode(',', $facility['faclityImg'])[0] ?>" alt="Card image cap">
                                                    </div>
                                                    <div class="card-content pl-3">
                                                        <h5 class="card-title"><?php echo $facility['facilityName']; ?></h5>
                                                        <p class="card-text"><?php echo $facility['description'] ?></p>
                                                        <p><?php echo date('M , d Y',strtotime($facility['dateFrom'])); ?> - <?php echo date('M , d Y',strtotime($facility['dateTo'])); ?></p>
                                                        <label for="" class="mr-2">₱<?php echo number_format($facility['totalAmount'], 2); ?> </label> | <a href="removeFacility.php?key=<?php echo $key; ?>" class="text-secondary ml-2"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                <?php
                            }
                        }else{
                            ?>
                                <p>No record found, add reservation <a href="index.php#reservation-section">Here</a></p>
                            <?php
                        }
                    ?>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="card" style="position: relative">
                            <?php if(!isset($_SESSION['user_data']['customer_id'])) : ?>
                            <div style="    position: absolute;
                            top: 0;
                            right: 0;
                            bottom: 0;
                            left: 0;
                            background: hsl(0deg 0% 100% / 81%);
                            display: flex;
                            justify-content: center;
                            align-items: center;">

                                <div>
                                    <a href="login.php" class="btn btn-link">login</a> or <a href="register-customer.php" class="btn btn-link">register</a>
                                </div>

                            </div>
                            <?php endif; ?>
                            <form action="../customerAction.php" method="POST">

                                <div class="card-header">
                                    <label>Booking info</label>
                                </div>
                                <div class="card-body">

                                    <!-- <div class="form-group">
                                        <h4>Entrance fee</h4>
                                        <label for="">Adult: ₱30</label> <br>
                                        <label for="">Children: ₱20</label>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="">Facility Reservation fee</label>
                                        <input type="text" class="form-control totalReadOnly" readonly value="₱<?php echo number_format($total, 2); ?>">
                                        <input type="hidden" name="total" value="<?php echo $total; ?>">
                                        <input type="hidden" name="temTotal" value="<?php echo $total; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="">No. of Adults</label>
                                        <input type="number" class="form-control" name="adultNumber" required>
                                    </div>
                                    <input type="hidden" id="aminities" name="aminities">

                                    <div class="form-group">
                                        <label for="">No. of Children</label>
                                        <input type="number" class="form-control" name="childNumber" required="true">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Total Entrance Fee</label>
                                        <input type="text" class="form-control" readonly name="entranceFee">
                                        <input type="hidden" id="totalIntrance" value="0">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Total Fee</label>
                                        <input type="text" class="form-control" readonly name="totalFee">
                                    </div>



                                    <!-- <div class="col-sm-12"><label for="">Aminities</label></div>
                                    <?php foreach($aminities as $aminity) : ?>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="aminityClass"
                                                id="<?php echo $aminity['aminitiesId']; ?>" 
                                                value="<?php echo $aminity['aminitiesId']; ?>" 
                                                aminName="<?php echo $aminity['Name']; ?>"
                                                aminPrice="<?php echo $aminity['price']; ?>">
                                                <label for="<?php echo $aminity['aminitiesId']; ?>"><?php echo $aminity['Name']; ?>(₱<?php echo number_format($aminity['price'], 2); ?>)</label>
                                        </div>
                                    <?php endforeach; ?> -->

                                </div>
                                <div class="card-footer">
                                    <button type="submit" name="action" value="submitReservation" class="btn btn-secondary" <?php echo $disabled; ?>>Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Contact Area =================-->
        
        <!--================ start footer Area  =================-->	
        <?php include 'footer-links.php'; ?>
        
    </body>

    <script>
        $(document).ready(function(){

            // 
            // 

            $('form').on('submit', function(e){
                var formatted = '';
                var aminities = [];
                $('.aminityClass').each(function(){
                    if($(this).prop('checked')){
                        aminities.push(
                            {
                                name: $(this).attr('aminname'),
                                price: $(this).attr('aminprice'),
                                amId: $(this).val()
                            }
                        );
                    }
                });
                if(aminities.length > 0){
                    formatted = JSON.stringify(aminities);
                }
                

                $('#aminities').val(formatted);
                // e.preventDefault();
            });

            $('.aminityClass').on('change', function(){
                calculateTotal();
                // 
                //         totalReadOnly
            });
            // $('[name=numberOfAdults]').on('change', function(){
            //     calculateTotal();
            // });

            // $('[name=childNumber]').on('change', function(){
            //     calculateTotal();
            // })
            
            function calculateTotal() {

                var totalCalc = parseFloat($('[name=temTotal]').val());
                $('.aminityClass').each(function(){
                    if($(this).prop('checked')){
                        totalCalc += parseFloat($(this).attr('aminprice'))
                    }
                });
                $('.totalReadOnly').val('₱' + totalCalc.toFixed(2).toLocaleString('en-US'));
                $('[name=total]').val(totalCalc);
                var totalAmount = parseFloat($('#totalIntrance').val());
                var totalAll = parseFloat($('[name=total]').val()) + totalAmount;
                $('[name=totalFee]').val('₱' + totalAll.toFixed(2).toLocaleString('en-US'));


            }
            $('#hasChildren').on('change', function(){
                if($(this).prop('checked')){
                    $('.childNumber').removeClass('d-none');
                    $('[name=childNumber]').prop('required', true);
                }else{
                    $('.childNumber').addClass('d-none');
                    $('[name=childNumber]').prop('required', false);
                    $('[name=childNumber]').val(null);
                }
            });
            

            $('[name=childNumber]').on('change', function(){
                var numberOfChild = ($(this).val() != '') ? parseInt($(this).val()) : 0;
                var paymentForChild = numberOfChild * 20;

                var numberAdult = 0; 
                if($('[name=adultNumber]').val() != ''){
                    numberAdult = parseInt($('[name=adultNumber]').val()) * 30;
                }

                var totalAmount = paymentForChild + numberAdult;
                if(isNaN(totalAmount)){
                    totalAmount = 0;
                }
                $('[name=entranceFee]').val('₱' + totalAmount.toFixed(2).toLocaleString('en-US'));
                var totalAll = parseFloat($('[name=total]').val()) + totalAmount;
                $('[name=totalFee]').val('₱' + totalAll.toFixed(2).toLocaleString('en-US'));
                $('#totalIntrance').val(totalAmount);
            });

            
            $('[name=adultNumber]').on('change', function(){
                var adultNum = ($(this).val() != '') ? parseInt($(this).val()) : 0;
                var paymentForAdult = adultNum * 30;

                var numberOfChild = 0;
                
                if($('[name=childNumber]').val() != ''){
                    numberOfChild = parseInt($('[name=childNumber]').val()) * 20;
                }

                var totalAmount = paymentForAdult + numberOfChild;
                if(isNaN(totalAmount)){
                    totalAmount = 0;
                }
                $('[name=entranceFee]').val('₱' + totalAmount.toFixed(2).toLocaleString('en-US'));
                var totalAll = parseFloat($('[name=total]').val()) + totalAmount;
                $('[name=totalFee]').val('₱' + totalAll.toFixed(2).toLocaleString('en-US'));
                $('#totalIntrance').val(totalAmount);
            });


            $('[name=date]').daterangepicker({
                locale : {
                    format : 'YYYY/MM/DD'
                },
                isInvalidDate: function(ele) {
                    var currDate = moment(ele._d).format('YY-MM-DD');
                    console.log('currDate', currDate);
                    return ["22-09-09", "22-09-10", "22-09-11"].indexOf(currDate) != -1;
                }
            });

        })
    </script>
</html>