<?php 
    $controller = new Controller(); 
    $getThePayments = $controller->getThePayments();
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Payment History</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Payment History</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">

        <!-- Main content here -->

        <div class="card">
            <div class="card-body">
                <table class="table res-table table-bordered">
                    <thead>
                        <th>Payment Date</th>
                        <th>Payment type</th>
                        <th>Gcash No.</th>
                        <th>Receipt</th>
                        <th>Is Refund</th>
                        <th>Status</th>
                        <th>Amount</th>
                    </thead>
                    <tbody>
                        <?php
                        $totalAmount = 0;
                        $hasRefund = false;
                            foreach ($getThePayments as $payment) {
                                $minus = '';
                                if($payment['isRefund']){
                                    $totalAmount -= $payment['Amount'];
                                    $minus = "-";
                                    $hasRefund = true;
                                }else{
                                    $totalAmount += $payment['Amount'];
                                }
                                
                                ?>
                                    <tr>
                                        <td><?php echo date('M. d Y @ H:m', strtotime($payment['createdDate'])); ?></td>
                                        <td><?php echo $payment['type']; ?></td>
                                        <td><?php echo $payment['Gcash_number']; ?></td>
                                        <td>
                                            <?php if($payment['type'] == 'Manual') : ?>
                                            N/A
                                            <?php else: ?>
                                            <div class="custom-file" style="width:100px; height: 100%;">
                                                <label for="payment-receipt">
                                                    <img src="public/uploads/images/<?php echo $payment['Receipt']; ?>" alt="Payment Receipt here" width="100%" height="100%">
                                                </label>
                                                
                                            </div>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo (!$payment['isRefund']) ? 'No' : 'Yes'; ?></td>
                                        <td><?php echo $payment['Status']; ?></td>
                                        <td><?php echo $minus; ?>₱<?php echo number_format($payment['Amount'], 2); ?></td>
                                    </tr>
                                <?php
                            }
                        ?>
                        <tr>
                            <td colspan="5" style="test-align:right"></td>
                            <td>Total paid</td>
                            <td>₱<?php echo number_format($totalAmount, 2); ?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="test-align:right"></td>
                            <td>Total reservation fee</td>
                            <td>₱<?php echo number_format($_GET['totalAmountFac'], 2); ?></td>
                        </tr>
                        <?php $bal = $_GET['totalAmountFac'] - $totalAmount; ?>
                        <tr>
                            <td colspan="5" style="test-align:right"></td>
                            <td><b>Balance</b></td>
                            <td>₱<?php echo (!$hasRefund) ? number_format($bal, 2) : 0; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="float-right mt-3">
                    <?php if($bal == 0 || $hasRefund || $_GET['status'] == 'Cancelled'): ?>
                        <span class="btn btn-primary mb-3 btn-secondary">Add Payment</span>
                    <?php else : ?>
                        <a href="?page=payment&reservationId=<?php echo $_GET['reservationId']; ?>&customerId=<?php echo $_GET['customerId']; ?>" class="btn btn-primary mb-3">Add Payment</a>
                    <?php endif; ?>
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


<div class="modal fade" id="recieptImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form action="" method="POST" name="book-form" id="create-book-form">
                    <div class="modal-body">
                        <div class="custom-file" style="width:100%; height: 100%;">
                            <label class="" for="payment-receipt" style="width:100%; height: 100%;">
                                <img src="" id="reciept-image-modal" alt="Payment Receipt here" width="100%" height="100%">
                            </label>
                        </div>
                    </div>
                    <!-- <input type="hidden" id="sunmitButtonIndicator" value="customer-details"> -->
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
    </div>
</div>

<!-- /.Default Modal -->


<script>
    $(document).ready(function(){
        $('[for=payment-receipt]').on('click', function(){
            $('#recieptImage').modal('show');
            $('#reciept-image-modal').attr('src', $(this).find('img').attr('src'))
        })
        
        // $('.table').DataTable();
    })
// Some Script Here!

</script>