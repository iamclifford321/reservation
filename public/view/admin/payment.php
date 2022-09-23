
<?php
    if(!isset($_GET['reservationId'])) die('error');
    require_once 'Config/Config.php';
    require_once 'Model/Model.php'; 
    require_once 'Controller/Controller.php'; 
    $controller = new Controller(); 
    $resrvations = $controller->getSpecificReservation($_GET['reservationId']);
    $payments = $controller->getSpecificPays($_GET['reservationId']);
    
    // echo '<pre>';
    // print_r($payments);
    // die();
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Payment</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">

        <!-- Main content here -->

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
        

        <div class="row" style="justify-content:center;">
            <div class="col-sm-12 col-md-8">

                <div class="card">
                    <form action="adminAction.php" method="POST" name="booking-form" enctype="multipart/form-data">
                        <div class="card-header">
                            <h4 class="modal-title">Make Payment</h4>
                            </div>
                            <div class="card-body">
                                <div class="customer-details">
                                    <div class="row">
                                    
                                    <div class="col-sm-12 col-md-12 margin bottom mb-4">
                                        <label for="">Reservation Information</label>
                                        <table class="table table-bordered">
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

                                    <div class="col-sm-8 col-md-8 margin bottom">
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

                                    <div class="col-sm-4 col-md-4 margin bottom">

                                        <div class="form-group">
                                            <!-- <label for="gcash-numner">Gcash number</label> -->
                                            <input type="hidden" name="gcash-numner" id="gcash-numner" value="" class="form-control">
                                        </div>

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

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="sunmitButtonIndicator" value="customer-details">
                            <div class="card-footer justify-content-between">
                            <button type="submit" class="btn btn-secondary" name="action" value="makePayment" id="submitBook" <?php echo $disabled; ?>>submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- /.Main content here -->

    </div>
</section>

<!-- Default Modal-->

<div class="modal fade" id="modal-new-customer">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Default Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>One fine body&hellip;</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.Default Modal -->
<?php if(isset($_GET['message'])) : ?>
    <script>
            swal.fire(
                'Success',
                '<?php echo $_GET['message']; ?>',
                'success'
            )
    </script>
<?php endif; ?>

<script>

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
        
        if(parseFloat($(this).val()) > parseFloat($('#payment-amount').attr('totalAll'))){
            alert('Amount entered should not be Greater than the current Balance!');
            $(this).val('');
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
// Some Script Here!

</script>