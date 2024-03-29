<?php $rtrnRes = $controller->reservationPaymentsReports($_GET['value'], $_GET['type']); ?>
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
          <h2>Payments Reservation</h2>
            <table class="table table-bordered">
              <thead>

                <th>Reservation Date</th>
                <th>Customer</th>
                <th># of Guests</th>
                <th>Status</th>
                <th>Amount</th>

              </thead>
              <tbody>
                <?php $total = 0; foreach ($rtrnRes as $key => $value) : ?>
                <?php 
                    // $numberAdult = $value['number_of_adults'] * 30;
                    // $numberChild = $value['number_of_children'] * 20;
                    // $totalPayment = $numberChild + $numberAdult;
                    $total += $value['totalPaid'];
                ?>
                  <tr>
                    <td><?php echo date('M. d Y', strtotime($value['date'])); ?></td>
                    <td><?php echo $value['customer']; ?></td>
                    <td><?php echo $value['numberOfCustomer']; ?></td>
                    <td><?php echo $value['status']; ?></td>
                    <td>₱<?php echo number_format($value['totalPaid'], 2); ?></td>
                  </tr>

                <?php endforeach; ?>
                <tr>
                    <td colspan="4"><label for="">Total</label></td>
                    <td>₱<?php echo number_format($total, 2); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- /.Main content here -->

    </div>
</section>