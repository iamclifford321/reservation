<?php 
    
    require_once 'Config/Config.php';
    require_once 'Model/Model.php'; 
    require_once 'Controller/Controller.php'; 
    $controller = new Controller();
    $facilities = $controller->getTheFicilities();

?>
<section class="content-header">
    <div class="container-fluid">
        <!-- <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Entrance Payment</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Name of the tab</li>
            </ol>
        </div>
        </div> -->
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
                        <th>Amount</th>
                        <th>Number-Of-Adults</th>
                        <th>Number-Of-Childrens</th>
                        <th>Payment Date</th>
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
        <form action="adminAction.php" method="POST" name="payment-form">
            <div class="modal-header">
                <h4 class="modal-title">Payment Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="">Reservation</label>
                            <select name="facilty" id="facilty" class="form-control">
                                <option value="">-- None --</option>
                                <?php foreach( $facilities as $facility ) : ?>
                                    <option value="<?php echo $facility['Reservation_id'] . '-' . $facility['Customer_id']; ?>">
                                        <?php echo $facility['Reservation_id'] . ' (' . $facility['Event'] . ')'; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div> -->
                    <div class="col-sm-12 col-md-12 payment-type-container">
                        <div class="customerName">
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">Firstname</label>
                                        <input type="text" name="firstname" id="firstname" class="form-control">
                                    </div>
                                </div>
    
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="middlename">Middlename</label>
                                        <input type="text" name="middlename" id="middlename" class="form-control">
                                    </div>
                                </div>
    
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="lastname">Lastname</label>
                                        <input type="text" name="lastname" id="lastname" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="countAdult">Number of Adults</label>
                                <input type="number" name="countAdult" id="countAdult" class="form-control" required>
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
                                <label for="countChild">Number of Child</label>
                                <input type="number" name="countChild" id="countChild" class="form-control">
                            </div>
                        </div>
                        <!-- <div class="col-sm-12 col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="include-facility">
                                <label class="form-check-label" for="include-facility">Include Facility?</label>
                            </div>
                        </div> -->
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="total-payment">Total Payment</label>
                                <input type="number" readonly name="total-payment" id="total-payment" class="form-control" required>
                                <input type="hidden" name="totalPayment">
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
                            var m = new Date(element['Payment_date']);
                            var month = m.toLocaleString('default', { month: 'short' });
                            console.log(m);
                            console.log(element);
                            table.row.add([
                                element['FirstName'].charAt(0).toUpperCase() + element['FirstName'].slice(1) + ' ' + element['LastName'].charAt(0).toUpperCase() + element['LastName'].slice(1),
                                element['Amount'],
                                element['numberOfAdults'],
                                element['numberOfChildrens'],
                                month + '. ' + m.getUTCDate() + ', ' + m.getUTCFullYear() 
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


        $('#countChild').on('change', function(){
            var adultPay = parseFloat(($('#countAdult').val() == '' || $('#countAdult').val() == null) ? 0 : $('#countAdult').val()) * 30;
            var childPay = parseFloat(($(this).val() == '' || $(this).val() == null) ? 0 : $(this).val()) * 20;
            var total  = childPay + adultPay;
            $('[name=totalPayment]').val(total);
            $('#total-payment').val(total)
        });


        $('#countAdult').on('change', function(){

            var childPay = parseFloat(($('#countChild').val() == '' || $('#countChild').val() == null) ? 0 : $('#countChild').val()) * 20;

            var adultPay = parseFloat(($(this).val() == '' || $(this).val() == null) ? 0 : $(this).val()) * 30;
            var total  = childPay + adultPay;
            $('[name=totalPayment]').val(total);
            $('#total-payment').val(total);

        });

        $('[name=payment-form]').on('submit', function(e){

            e.preventDefault();
            var firstname = $('#firstname').val();
            var middlename = $('#middlename').val();
            var lastname = $('#lastname').val();

            var NumberofChild = ($('#countChild').val() == '' || $('#countChild').val() == null) ? 0 : $('#countChild').val();
            var NumberofAdults = ($('#countAdult').val() == '' || $('#countAdult').val() == null) ? 0 : $('#countAdult').val();
            var Reservation = ($('#facilty').val() == '' || $('#facilty').val() == null) ? null : $('#facilty').val();
            var TotalPayment = ($('[name=totalPayment]').val() == '' || $('[name=totalPayment]').val() == null) ? 0 : $('[name=totalPayment]').val();
            var reservationId = '';
            var customerId = '';
            var numberOf = parseInt(NumberofChild) + parseInt(NumberofAdults);
            if(Reservation != '' && Reservation != null){
                reservationId = Reservation.split('-')[0];
                customerId = Reservation.split('-')[1];
            }

            $.ajax({
                method: 'POST',
                url: 'adminAction.php',
                dataType: "JSON",
                data: {
                    action: 'save-payment',
                    countChild: NumberofChild,
                    countAdult: NumberofAdults,
                    totalPayment: TotalPayment,
                    Reservation: reservationId,
                    customerId: customerId,
                    numberOf: numberOf,
                    firstname : firstname,
                    middlename : middlename,
                    lastname : lastname
                },
                success: function(res) {
                    if(res['status'] == 'success'){
                        Toast.fire({
                            icon: 'success',
                            title: 'Succesfuly added payment'
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                        
                    }
                }
            });
        });
        $('#facilty').on('change', function(){
            if($(this).val() == '' || $(this).val() == null){
                $('.customerName').show();
                $('#firstname').prop('required', true);
                $('#lastname').prop('required', true);
            }else{
                $('#firstname').prop('required', false);
                $('#lastname').prop('required', false);
                $('.customerName').hide();
            }
        })
    });

</script>