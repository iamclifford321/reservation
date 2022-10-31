<?php 
    
    require_once 'Config/Config.php';
    require_once 'Model/Model.php'; 
    require_once 'Controller/Controller.php'; 
    $controller = new Controller();
    $facilities = $controller->getTheFicilities();

?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Name of the tab</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Name of the tab</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">

        <!-- Main content here -->

        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" id="make-payment" data-toggle="modal" data-target="#modal-new-payment">Make Payment</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="payment-data" class="table table-striped">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Facility</th>
                        <th>Event</th>
                        <th>Payment Date</th>
                        <th>Amount</th>
                        <th>Receipt</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>

        <!-- /.Main content here -->

    </div>
</section>

<!-- Default Modal-->

<div class="modal fade" id="modal-new-payment">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="POST" name="payment-form">
            <div class="modal-header">
                <h4 class="modal-title">Payment Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row ">

                    <div class="col-sm-12 col-md-12 payment-type-container">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="middlename">Middlename</label>
                                    <input type="text" name="middlename" id="middlename" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="count">Number of Person</label>
                                    <input type="number" name="count" id="count" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="include-child">
                                <label class="form-check-label" for="include-child">Include Child?</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 payment-type-container child-form-container">
                            <div class="form-group">
                                <label for="count">Number of Child</label>
                                <input type="number" name="count" id="count" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="include-facility">
                                <label class="form-check-label" for="include-facility">Include Facility?</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 payment-type-container facility-form-container">
                            <div class="row">

                                <?php foreach( $facilities as $facility ) : ?>
                                
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?php echo $facility['Facility_id']; ?>" id="<?php echo $facility['Facility_id']; ?>">
                                            <label class="form-check-label" for="<?php echo $facility['Facility_id']; ?>"><?php echo $facility['Facility_name']; ?></label>
                                        </div>
                                    </div>
                                
                                <?php endforeach; ?>

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="total-payment">Total Payment</label>
                                <input type="number" name="total-payment" id="total-payment" class="form-control" required>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.Default Modal -->

<style type="text/css">
    .view-receipt,
    .form-check-label {
        cursor: pointer;
    }
    .payment-type-container {
        margin-bottom: 20px;
    }
    .child-form-container,
    .facility-form-container {
        display: none;
    }
</style>
<script>

// Some Script Here!
    $(document).ready(function(){

        var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
        });

        let table = $("#payment-data").DataTable({
            "responsive"    : true, 
            // "lengthChange"  : false, 
            "autoWidth"     : false,
            "buttons"       : [
                                "csv", 
                                "excel", 
                                "pdf", 
                                "print"
                            ]
        });

        getPaymentDetails();
        function getPaymentDetails() {

            //$('#customer').html("");
            $.ajax({
                method: 'POST',
                url: 'adminAction.php',
                dataType: "JSON",
                data: {
                    action: 'get-payment',
                },
                success: function(res) {

                    if (res.length > 0) {
                        table.clear().draw();
                        for (let index = 0; index < res.length; index++) {

                            const element = res[index];
                            table.row.add([
                                res[index]['FirstName'].charAt(0).toUpperCase() + res[index]['FirstName'].slice(1) + ' ' + res[index]['LastName'].charAt(0).toUpperCase() + res[index]['LastName'].slice(1),
                                res[index]['Facility_name'],
                                res[index]['Event'] ,
                                res[index]['Payment_date'],
                                res[index]['Amount'],
                                `<img data-toggle="modal" class="" src="public/uploads/images/${res[index]['Receipt']}" style="height: 35px;"/>`,
                                res[index]['Status']
                            ]).draw();
                            
                        }
                    }

                }
            });

        }
        $('#include-child').change(function() {
            if ( this.checked ) {
                $(".child-form-container").css("display", "block");
            } else {
                $(".child-form-container").css("display", "none");
            }
        });
        $('#include-facility').change(function() {
            if ( this.checked ) {
                $(".facility-form-container").css("display", "block");
            } else {
                $(".facility-form-container").css("display", "none");
            }
        });

    });

</script>