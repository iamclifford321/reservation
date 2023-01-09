
<!doctype html>
<html lang="en">
    <?php
        if(!isset($_GET['reservationId'])) die('error');
        require_once '../Config/Config.php'; 
        require_once '../Model/Model.php'; 
        require_once '../Controller/Controller.php'; 
        $controller = new Controller(); 
        $resrvations = $controller->getSpecificReservation($_GET['reservationId']);
        $payments = $controller->getSpecificPays($_GET['reservationId']);
        // echo '<pre>';
        // print_r($resrvation);
        // die();
    ?>
    <?php include 'head.php'; ?>
    <?php if(!isset($_SESSION['user_data'])) header('Location:login.php'); ?>
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
                <div class="row" style="justify-content:center;">
                    <div class="col-sm-12 col-md-10">

                        <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">How does this work?</h4>
                            <ul>
                                <li>
                                    Send money through Gcash, send it to 09272555640, under the name <b>Maria Emma Aljas</b>
                                </li>
                                <li>
                                    Save the image of the reciept.
                                </li>
                                <li>
                                    Upload it, by clicking the image below.
                                </li>
                            </ul>
                            <b>Note</b>
                            <ul>
                                <li>Make sure that the amount sent is equal to the amount entered below, or if this is a parial payment please tick the <b>Checkbox</b> for partial payments below</li>
                            </ul>
                        </div>

                        <div class="card">
                            <form action="../customerAction.php" method="POST" name="booking-form" enctype="multipart/form-data">
                                <div class="card-header">
                                    <h4 class="modal-title">Make Payment</h4>
                                  </div>
                                  <div class="card-body">
                                      <div class="customer-details">
                                          <div class="row">
                                           
                                            <div class="col-sm-12 col-md-12 margin bottom">
                                                <table class="table">
                                                    <thead>
                                                        <th>Facility</th>
                                                        <th>Date reserved</th>
                                                        <th>Calc(Price × N days)</th>
                                                        <th>Total Price</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php $dateScheds = array(); $facilityIds = []; $totalAll = 0; foreach( $resrvations as $resrvation) : ?>
                                                        <?php
                                                            $totalAll += $resrvation['totalAmout']; 

                                                            $dateScheds[$resrvation['facilityId']] = array(
                                                                'dateIn' => $resrvation['dateIn'],
                                                                'dateOut' => $resrvation['dateOut']
                                                            );
                                                            array_push($facilityIds, $resrvation['facilityId']);
                                                            $dateIn = strtotime($resrvation['dateIn']);
                                                            $dateOut = strtotime($resrvation['dateOut']);
                                                            $dateDiff = $dateOut - $dateIn;
                                                            $daysDiff = round($dateDiff / (60 * 60 * 24)) + 1;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $resrvation['Facility_name'] ?></td>
                                                            <td><?php echo $resrvation['dateIn'] ?> to <?php echo $resrvation['dateOut'] ?></td>
                                                            <td><?php echo number_format($resrvation['Price'], 2) . ' × ' . $daysDiff ?></td>
                                                            <td>₱<?php echo number_format($resrvation['totalAmout'], 2) ?></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                        <tr>
                                                            <td colspan="3" class="text-bold"><b>Total</b></td>
                                                            <td colspan="">₱<?php echo number_format($totalAll, 2) ?></td>
                                                        </tr>
                                                        <?php $serialized = serialize($dateScheds); //echo $serialized; ?>
                                                        <?php // echo serialize($facilityIds); ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-sm-12 col-md-6 margin bottom">
                                                <label for="">Payment history</label>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <th>Paid date</th>
                                                        <th>Mode</th>
                                                        <th>Amount</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php $total = 0; foreach($payments as $payment) : ?>
                                                        <?php $total += $payment['Amount']; ?>
                                                        <tr>
                                                            <td><?php echo $payment['Payment_date'] ?></td>
                                                            <td><?php echo $payment['type'] ?></td>
                                                            <td>₱<?php echo number_format($payment['Amount'], 2) ?></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                        <tr>
                                                            <td colspan="2"> <label for="">Total Fee</label> </td>
                                                            <td>₱<?php echo number_format($totalAll, 2); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"> <label for="">Total Paid</label> </td>
                                                            <td>₱<?php echo number_format($total, 2); ?></td>
                                                        </tr>
                                                        <?php 
                                                            $balance = $totalAll - $total;
                                                            $disabled = ''; 
                                                            if($balance <= 0){
                                                                $disabled = 'disabled';
                                                            }
                                                        ?>
        
                                                        <tr>
                                                            <td colspan="2"> <label for="">Balance</label> </td>
                                                            <td>₱<?php echo number_format($balance, 2); ?></td>
                                                        </tr>
        
                                                    </tbody>
                                                </table>
        
                                            </div>


                                            <div class="col-sm-12 col-md-6 margin bottom">

                                                <div class="form-group">
                                                    <label for="gcash-numner">Customer's Gcash Reference number</label>
                                                    <input type="text" name="gcash-numner" id="gcash-numner" required class="form-control">
                                                </div>
                                                <input type="hidden" value="<?php echo $balance; ?>" name="balance">
                                                <div class="form-group">
                                                    <label for="payment-amount">Amount</label>
                                                    <input type="text" required id="payment-amount" readonly="true" value="₱<?php echo number_format($balance, 2) ?>" class="form-control" totalAll=<?php echo $balance; ?>>
                                                    <input type="hidden" required name="payment-amount" id="payment-amount-hidden" class="form-control" value="<?php echo $balance; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="patial">Check this if this is a partial payment</label>
                                                    <input type="checkbox" id="patial" name="isPartial">
                                                   
                                                </div>
                                                
                                            </div>
                                            <input type="hidden" value="<?php echo $_GET['reservationId']; ?>" name="resId">
                                            <textarea value="" name="facilityIds" class="d-none"></textarea>
                                            <input type="hidden" value="<?php echo $_GET['customerId']; ?>" name="cusId">
                                            <textarea type="text" name="scheduled" class="d-none"><?php echo $serialized; ?></textarea>
                                            <div class="col-sm-12 col-md-12 margin-20px">
                                                <div class="custom-file" style="width:100%; height: 100%;">
                                                    <label class="custom-file-label" for="payment-receipt" style="width:100%; height: 100%;">
                                                        <img src="../public/images/gcash-qr-ss.jpg" id="reciept-image" alt="Payment Receipt here" width="100%" height="100%">
                                                    </label>
                                                    <input type="file" required name="payment-receipt" id="payment-receipt" class="custom-file-input form-control" accept="image/png, image/gif, image/jpeg" >
                                                </div>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                                  <input type="hidden" id="sunmitButtonIndicator" value="customer-details">
                                  <div class="card-footer justify-content-between">
                                    <button type="submit" class="btn btn-secondary" name="action" value="makePayment" id="submitBook">submit</button>
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
            $('#payment-amount').on('click', function(){
                
                if(!$(this).prop('readonly')){
                    $(this).val('');
                    $('#payment-amount-hidden').val('');
                }

            });

            $('#payment-amount').on('change', function(){

                var valueFormat = '₱' + $(this).val();
                let isnum = /^\d+$/.test($(this).val());
                if(!isnum){
                    if($(this).val() == '₱'){
                        $(this).val('');
                        return false;
                    }
                    alert('only number is allowed')
                    return false;
                }
                $('#payment-amount-hidden').val($(this).val());
                $(this).val(valueFormat);

            });


            $('#patial').on('change', function(){
                if($(this).prop('checked')){
                    $('#payment-amount').prop('readonly', false);
                    $('#payment-amount').val('');
                    $('#payment-amount-hidden').val('');
                }else{

                    $('#payment-amount').prop('readonly', true);
                    $('#payment-amount').val('₱' + parseFloat($('#payment-amount').attr('totalAll')).toFixed(2));
                    $('#payment-amount-hidden').val($('#payment-amount').attr('totalAll'));
                    // $('#payment-amount').removeAttr('readonly');
                }
            })
            
            var sheds = '<?php echo json_encode(unserialize($serialized)); ?>';
            var parsedJson = JSON.parse(sheds);
                        // console.log( isDateBetween('2022-10-11', '2022-10-15', '2022-10-14') );
            function isDateBetween(dateFrom, dateTo, dateCheck){

                console.log('dateFrom', dateFrom);
                var from = new Date(dateFrom);  // -1 because months are from 0 to 11
                var to   = new Date(dateTo);
                var check = new Date(dateCheck);

                return check >= from && check <= to;

            }

           $('#payment-receipt').on('change', function(){
                var file = this.files[0];
                console.log('file', file);
                var reader = new FileReader();
                reader.onload = function(){
                    $('#reciept-image').attr('src', this.result);
                }
                reader.readAsDataURL(file);
                console.log($(this).val());
           });


           $('[name=booking-form]').on('submit', function(e){
                

            
                var bal = parseInt($('[name=balance]').val());
                var payment = parseInt($('#payment-amount-hidden').val());
                
                if(bal < payment){
                    alert('Payment should be lesser or equal to the current balance');
                    e.preventDefault();
                }

                var paymentamount = parseFloat($('[name=payment-amount]').val());
                var balancePay = parseFloat($('[name=balance]').val())/2;

                
                if(paymentamount < balancePay){
                    alert(`Amount should be atleast 50 percent of the remaining balance`);
                    e.preventDefault();
                }

                // $.ajax({
                //     url : '../customerAction.php',
                //     method: 'POST',
                //     dataType : 'JSON',
                //     data: {
                //         action : 'getTheResInDate',
                //         facilityIds : $('[name=facilityIds]').val()
                //     },
                //     success: function(res){
                //         console.log('res', res);
                //         for (const ids in parsedJson) {
                //             console.log('res', res[ids]);
                //             console.log( isDateBetween() );
                //         }

                //     }

                // })
           })

        })
    </script>
</html>