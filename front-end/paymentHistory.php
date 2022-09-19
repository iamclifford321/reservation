
<!doctype html>
<?php

    require_once '../Config/Config.php'; 
    require_once '../Model/Model.php'; 
    require_once '../Controller/Controller.php'; 
    $controller = new Controller(); 
    $getThePayments = $controller->getThePayments();

    if(!isset($_GET['reservationId']) || !isset($_GET['customerId'])){
        header('location:reserved.php');
    }

?>
<html lang="en">
    
    <?php include 'head.php'; ?>
    <?php if(!isset($_SESSION['user_data'])) header('Location:login.php'); ?>
    <body>
        <!--================Header Area =================-->
        <?php include 'header.php'; ?>
        <!--================Header Area =================-->
        <!-- ===============Modals ===================== -->

        <div class="modal fade" id="recieptImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <form action="" method="POST" name="book-form" id="create-book-form">
                            <div class="modal-body">
                                <div class="custom-file" style="width:100%; height: 100%;">
                                    <label class="custom-file-label" for="payment-receipt" style="width:100%; height: 100%;">
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
        <!-- ===============Modals ===================== -->
        <!--================Breadcrumb Area =================-->
        
        <section class="breadcrumb_area">
            <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" style="background:none"></div>
            <div class="container">
                <div class="page-cover text-center">
                    <h2 class="page-cover-tittle">Payment history</h2>
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Reserved</li>
                        <li class="active">Payment history</li>
                    </ol>
                </div>
            </div>
        </section>
        <!--================Breadcrumb Area =================-->
        
        <!--================Contact Area =================-->
        <section class="contact_area section_gap">
            <div class="container">
                <table class="table res-table table-bordered">
                    <thead>
                        <th>Payment Date</th>
                        <th>Receipt</th>
                        <th>Status</th>
                        <th>Amount</th>
                    </thead>
                    <tbody>
                        <?php
                        $totalAmount = 0;
                            foreach ($getThePayments as $payment) {
                                $totalAmount += $payment['Amount'];
                                ?>
                                    <tr>
                                        <td><?php echo date('M d, Y', strtotime($payment['createdDate'])); ?></td>
                                        <td>
                                            <div class="custom-file" style="width:100px; height: 100%;">
                                                <label class="custom-file-label" for="payment-receipt" style="width:100%; height: 100%;">
                                                    <img src="../public/uploads/images/<?php echo $payment['Receipt']; ?>" alt="Payment Receipt here" width="100%" height="100%">
                                                </label>
                                            </div>
                                        </td>
                                        
                                        <td><?php echo $payment['Status']; ?></td>
                                        <td>₱<?php echo number_format($payment['Amount'], 2); ?></td>
                                    </tr>
                                <?php
                            }    
                        ?>
                        <tr>
                            <td colspan="2" style="test-align:right"></td>
                            <td>Total paid</td>
                            <td>₱<?php echo number_format($totalAmount, 2); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="test-align:right"></td>
                            <td>Total reservation fee</td>
                            <td>₱<?php echo number_format($_GET['totalAmountFac'], 2); ?></td>
                        </tr>
                        <?php $bal = $_GET['totalAmountFac'] - $totalAmount; ?>
                        <tr>
                            <td colspan="2" style="test-align:right"></td>
                            <td><b>Balance</b></td>
                            <td>₱<?php echo number_format($bal, 2); ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="float-right">
                    <?php if($bal == 0): ?>
                        <span class="btn btn-primary mb-3 btn-secondary">Add Payment</span>
                    
                    <?php else : ?>
                        <a href="makePayment.php?reservationId=<?php echo $_GET['reservationId']; ?>&customerId=<?php echo $_GET['customerId']; ?>" class="btn btn-primary mb-3">Add Payment</a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <!--================Contact Area =================-->
        
        <!--================ start footer Area  =================-->	
        <?php// include 'footer.php'; ?>
        <?php include 'footer-links.php'; ?>
        
    </body>

    <script>
        $(document).ready(function(){
            $('[for=payment-receipt]').on('click', function(){
                $('#recieptImage').modal('show');
                $('#reciept-image-modal').attr('src', $(this).find('img').attr('src'))
            })
            
            // $('.table').DataTable();
        })
    </script>
</html>