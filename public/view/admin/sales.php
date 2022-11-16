<?php $getTheSales = $controller->salesReports($_GET['value'], $_GET['type']); ?>
<section class="content">
    <div class="container-fluid">
        <!-- Main content here -->
        <div class="card">
          <div class="card-header">
            <button class="btn btn-secondary print-btn" id="print-btn">Print</button>
            <div class="print-details">
              <div class="row">
                <div class="col-md-6">
                  <p><label for="">Name: </label> <?php echo ucfirst($_SESSION['user_data']['FirstName']) . ' ' . ucfirst($_SESSION['user_data']['LastName'])?></p>
                  <p><label for="">Report filter: </label> <?php echo $_GET['value']; ?></p>
                </div>
                <div class="col-md-6">
                  <p><label for="">Date: </label> <?php echo date("Y-m-d"); ?></p>
                  <p><label for="">Signature: </label></p>
                </div>
              </div>

            </div>

          </div>
          <div class="card-body">
          <h2>Sales</h2>
            <table class="table table-bordered">
              <thead>
                <th>Date</th>
                <th>is Refund</th>
                <th>Payment Mode</th>
                <th>Amount</th>
              </thead>
              <tbody>
                <?php $total = 0; foreach ($getTheSales as $key => $value) : ?>
                <?php 
                  $total += $value['TotalBill'];
                ?>
                  <tr>
                    <td><?php echo date('M. d Y', strtotime($value['PaymentDate'])) ?></td>
                    <td><?php echo ($value['isRefund']) ? 'Yes' : 'No'; ?></td>
                    <td><?php echo $value['PaymentMode'] ?></td>
                    <td>₱<?php echo number_format($value['TotalBill'], 2) ?></td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  
                  <td colspan="3"> <label for="">Total</label></td>
                  <td>₱<?php echo number_format($total, 2); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- /.Main content here -->

    </div>
</section>