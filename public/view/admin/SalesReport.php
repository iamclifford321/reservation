<?php
  
  if (!isset($_GET['type']) || !isset($_GET['value']) ) die('Error parameter');

    require_once 'Config/Config.php'; 

    require_once 'Model/Model.php'; 

    require_once 'Controller/Controller.php'; 

    $controller = new Controller(); 
    
    $getTheSales = $controller->salesReports($_GET['value'], $_GET['type']);
    // echo "<pre>";
    // print_r($getTheSales);
    // die();
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
              
                <?php 
                    echo (isset($_GET['type'])) ? $_GET['type'] . ' Sales Report' :''; 
                ?>
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Sales report</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <h5 class="filter-by">Filtered by:
          <select name="filteredBy" id="">
            <?php // echo $_GET['value']; ?>
            <?php foreach (['Weekly', 'Yearly', 'Monthly'] as $key => $value) : ?>
              <?php 
                
                $selected = '';
                if( $_GET['type'] == $value){
                  $selected = 'Selected';
                }
              ?>
              <option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
            <?php endforeach; ?>
          </select>
        </h5> 

        <!-- Main content here -->
        <div class="card">
          <div class="card-header">
            <button class="btn btn-secondary" id="print-btn">Print</button>
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
                    <td><?php echo $value['PaymentDate'] ?></td>
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

<style>
  
  div.print-details{
    display: none;
  }

  @media print {

      .filter-by {
        display: none;
      }
      #print-btn{
        display: none;
      }
      .print-details{
        display: inline !important;
      }
      .main-footer{
        display: none !important;
      }

  }
</style>

<script>

// Some Script Here!
$('[name=filteredBy]').on('change', function(){

  if($(this).val() == 'Weekly'){
    window.location.href = 'adminIndex.php?page=SalesReport&type=Weekly&value=This Week';
  }else if($(this).val() == 'Yearly'){
    window.location.href = 'adminIndex.php?page=SalesReport&type=Yearly&value=This Year';
  }else{
    window.location.href = 'adminIndex.php?page=SalesReport&type=Monthly&value=This Month';
  }
});

$('#print-btn').on('click', function(){
  window.print();
})
</script>