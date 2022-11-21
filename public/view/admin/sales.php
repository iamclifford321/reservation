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
                <th>Customer</th>
                <th>Facility Name</th>
                <th>Date from</th>
                <th>Date to</th>
                <th>is Refund</th>
                <th>Payment Mode</th>
                <th>Payment for</th>
                <th>Amount</th>

              </thead>
              <tbody>
                <?php $total = 0; foreach($getTheSales as $key => $value) : ?>
                <?php 
                  $porpuse = 'Entrance fee';
                  $total += $value['amount'];
                  if($value['reservationId'] != null || $value['reservationId'] != ''){
                    $porpuse = 'Reservation fee';
                  }
                ?>
                <?php foreach($value['facilities'] as $facility): ?>
                <tr>
                  <td><?php echo date('M. d Y', strtotime($value['date'])) ?></td>
                  <td><?php echo $value['customer'] ?></td>
                  <td><?php echo (isset($facility['facilityName'])) ? $facility['facilityName'] : ''; ?>(<?php echo (isset($facility['Category'])) ? $facility['Category'] : ''; ?>)</td>
                  
                  <td><?php echo date('M. d Y', strtotime($facility['dateFrom'])); ?></td>
                  <td><?php echo date('M. d Y', strtotime($facility['dateTo'])); ?></td>
                  <td><?php echo $value['isRefund'] ?></td>
                  <td><?php echo $value['PaymentMode'] ?></td>
                  <td><?php echo $porpuse ?></td>
                  <td>₱<?php echo number_format($value['amount'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
                
                <?php endforeach; ?>
                <tr>
                  <td colspan="8"> <label for="">Total</label></td>
                  <td>₱<?php echo number_format($total, 2); ?></td>
                </tr>
              </tbody>
              
            </table>

          </div>
        </div>

        <!-- /.Main content here -->

    </div>
</section>