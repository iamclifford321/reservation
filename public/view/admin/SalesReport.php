<?php
  
  if (!isset($_GET['type']) || !isset($_GET['value']) ) die('Error parameter');

    require_once 'Config/Config.php'; 

    require_once 'Model/Model.php'; 

    require_once 'Controller/Controller.php'; 

    $controller = new Controller();
    
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

<!-- Tabs navs -->
<ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
  <li class="nav-item" role="presentation">
    <a
      class="nav-link nav-link-tab"
      id="ex1-tab-1"
      data-mdb-toggle="tab"
      href="#tab-content-Sales"
      role="tab"
      aria-controls="tab-content-Sales"
      aria-selected="false">Sales</a>
  </li>
  <li class="nav-item" role="presentation">
    <a
      class="nav-link nav-link-tab"
      id="ex1-tab-2"
      data-mdb-toggle="tab"
      href="#tab-content-Entrances"
      role="tab"
      aria-controls="tab-content-Entrances"
      aria-selected="false">Entrances</a>
  </li>
  <!-- <li class="nav-item" role="presentation">
    <a class="nav-link nav-link-tab" 
        id="ex1-tab-3" 
        data-mdb-toggle="tab" 
        href="#tab-content-Cottages" 
        role="tab" 
        aria-controls="tab-content-Cottages" 
        aria-selected="false">Cottages</a>
  </li> -->

  <!-- <li class="nav-item" role="presentation">
    <a class="nav-link nav-link-tab" 
        id="ex1-tab-3" 
        data-mdb-toggle="tab" 
        href="#tab-content-Rooms" 
        role="tab" 
        aria-controls="tab-content-Rooms" 
        aria-selected="false">Rooms</a>
  </li> -->

  <!-- <li class="nav-item" role="presentation">
    <a class="nav-link nav-link-tab" 
        id="ex1-tab-3" 
        data-mdb-toggle="tab" 
        href="#tab-content-Entertainment" 
        role="tab" 
        aria-controls="tab-content-Entertainment" 
        aria-selected="false">Entertainment</a>
  </li> -->

  <li class="nav-item" role="presentation">
    <a class="nav-link nav-link-tab" 
        id="ex1-tab-3" 
        data-mdb-toggle="tab" 
        href="#tab-content-Reservations" 
        role="tab" 
        aria-controls="tab-content-Reservations" 
        aria-selected="false">Reservations</a>
  </li>


  <li class="nav-item" role="presentation">
    <a class="nav-link nav-link-tab" 
        id="ex1-tab-3" 
        data-mdb-toggle="tab" 
        href="#tab-content-Payment-Reservations" 
        role="tab" 
        aria-controls="tab-content-Payment-Reservations" 
        aria-selected="false">Payment of Reservation</a>
  </li>



</ul>
<!-- Tabs navs -->

<!-- Tabs content -->
<div class="tab-content" id="ex1-content">

  <div class="tab-pane fade" id="tab-content-Sales" role="tabpanel" aria-labelledby="ex1-tab-1">
    <?php include 'sales.php'; ?>
  </div>
  <div class="tab-pane fade" id="tab-content-Entrances" role="tabpanel" aria-labelledby="ex1-tab-2">
    <?php include 'entrances.php'; ?>
  </div>
  <div class="tab-pane fade" id="tab-content-Cottages" role="tabpanel" aria-labelledby="ex1-tab-3">
    <?php include 'cottages.php'; ?>
  </div>
  <div class="tab-pane fade" id="tab-content-Rooms" role="tabpanel" aria-labelledby="ex1-tab-1">
    <?php include 'rooms.php'; ?>
  </div>

  <div class="tab-pane fade" id="tab-content-Entertainment" role="tabpanel" aria-labelledby="ex1-tab-1">
    <?php include 'entertainment.php'; ?>
  </div>
  
  <div class="tab-pane fade" id="tab-content-Reservations" role="tabpanel" aria-labelledby="ex1-tab-2">
    <?php include 'reservation.php'; ?>
  </div>
  <div class="tab-pane fade" id="tab-content-Payment-Reservations" role="tabpanel" aria-labelledby="ex1-tab-3">
    <?php include 'payments_of_reservation.php'; ?>
  </div>

</div>
<!-- Tabs content -->















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
      .print-btn{
        display: none;
      }
      .print-details{
        display: inline !important;
      }
      .main-footer{
        display: none !important;
      }
      #ex1{
        display: none;
      }
  }
</style>

<script>
$('.nav-link-tab').on('click', function(){

  $('.tab-pane').removeClass('show active');
  $('.nav-tabs .nav-item .nav-link').removeClass('active');
  $(this).addClass('active');
  var Id = '#' + $(this).attr('aria-controls');
  $(Id).addClass('show active');

})
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

$('.print-btn').on('click', function(){
  window.print();
})
</script>