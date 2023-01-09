<?php
    if(!isset($_GET['reservationId'])) die('error');
    require_once 'Config/Config.php';
    require_once 'Model/Model.php'; 
    require_once 'Controller/Controller.php'; 
    $controller = new Controller(); 
    $payments = $controller->getSpecificPays($_GET['reservationId']);
    $total = 0;
    
    foreach ($payments as $payment) {
        
        if(!$payment['isRefund']){
            $total += $payment['Amount'];
        }

    }

    if($total == 0){
        $payments = $controller->updateSpecificRes($_GET['reservationId']);
        ?>
            <script>
                location.href="adminIndex.php?page=reservations";
            </script>
        <?php
    }
    $finalAmount = (20/100) * $total;
    $amountDiscounted = $total - $finalAmount;

    // echo $total - $finalAmount;
    // die();
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
            <li class="breadcrumb-item active">Approve Cancel</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">

        <!-- Main content here -->
        <div class="row" style="justify-content:center;">
            <div class="col-sm-12 col-md-4">

                <div class="card">
                    <form action="adminAction.php" method="POST" name="booking-form" enctype="multipart/form-data">
                        <div class="card-header">
                            <h4 class="modal-title">Approve Reservation Cancelation</h4>
                            </div>
                            <div class="card-body">
                                <div class="customer-details">
                                    <div class="row">
                                        <!-- <div class="alert alert-info">
                                            <label>
                                                The refund should be sent 
                                            </label>
                                            <p></p>
                                        </div> -->
                                        <div class="col-sm-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">Gcash referencce No.</label>
                                                <input type="text" name="gcashNumber" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">Amount <small></small></label>
                                                <input type="text" class="form-control" value="₱<?php echo number_format($amountDiscounted, 2); ?>" readonly>
                                                <input type="hidden" name="amount" value="<?php echo $amountDiscounted ?>">
                                            </div>
                                        </div>
                                        <input type="hidden" name="resId" value="<?php echo $_GET['reservationId']; ?>">
                                        <input type="hidden" name="cusId" value="<?php echo $_GET['customerId']; ?>">
                                        <label for="reciept">
                                            <img src="public/images/gcash-qr-ss.jpg" alt="" width="100%" height="100%" id="reciept-img">
                                        </label>
                                        <input type="file" class="" name="reciept" id="reciept" required="true" style="opacity: 0; height:1px;">
                                        <input type="checkbox" id="isManualPayment" name="isManualPayment"> <label for="isManualPayment">This is a manual payment</label> &nbsp; 
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer justify-content-between">
                                <button type="submit" class="btn btn-secondary" name="action" value="makeRefund" id="submitBook">submit</button>
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


<script>
    $(document).ready(function(){
        $('#isManualPayment').on('change', function(){
            if($(this).prop('checked')){
                $('#reciept-img').addClass('d-none');
                $('#reciept').prop('required', false);
                $('[name=gcashNumber]').prop('required', false).addClass('d-none').val(null).prev().addClass('d-none');
            }else{
                $('#reciept').prop('required', true);
                $('#reciept-img').removeClass('d-none');
                $('[name=gcashNumber]').prop('required', true).removeClass('d-none').prev().removeClass('d-none');;
            }
            
        });

        $('#reciept').on('change', function(){
            
            var file = this.files[0];
            console.log('file', file);
            var reader = new FileReader();
            reader.onload = function(){
                $('#reciept-img').attr('src', this.result);
            }
            reader.readAsDataURL(file);
            console.log($(this).val());
        });

    })
// Some Script Here!

</script>