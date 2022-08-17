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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-new-payment">Add Payment</button>
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
                        <th></th>
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
            <form action="" method="POST" name="new-payment-form">
                <div class="modal-header">
                  <h4 class="modal-title">Payment Process</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="customer">Customer</label>
                                <select name="customer" id="customer" class="form-control" required>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="facility">Facility</label>
                                <select name="facility" id="facility" class="form-control" required>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="reservation">Reservation</label>
                                <select name="reservation" id="reservation" class="form-control" required>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" name="amount" id="amount" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 margin-20px">
                            <div class="form-group custom-file">
                                <label class="custom-file-label" for="receipt">Choose file</label>
                                <input type="file" name="receipt" id="receipt" class="custom-file-input form-control" >
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

<div class="modal fade" id="view-receipt">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Payment Receipt</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body view-receipt-image">
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .view-receipt{
        cursor: pointer;
    }
</style>
<script>

// Some Script Here!
    $(document).ready(function(){

        $("#receipt").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

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

        getCustomersDetails();
        function getCustomersDetails(){

            $('#customer').html("");
            $.ajax({
                method      : 'POST',
                url         : 'adminAction.php',
                dataType    : "JSON",
                data        : {
                    action      : 'get-customer',
                }, success: function(res){

                    if(res.length > 0){
                        for (let index = 0; index < res.length; index++) {
                            $('#customer').append(
                                `<option value="${res[index]['customer_id']}">${res[index]['FirstName'] + ' ' + res[index]['MiddleName'] + ' ' + res[index]['LastName']}</option>`
                            )
                        }
                    }

                }
            });
            
        }

        getFacilityDetails();
        function getFacilityDetails(){

            $('#facility').html("");
            $.ajax({
                method      : 'POST',
                url         : 'adminAction.php',
                dataType    : "JSON",
                data        : {
                    action      : 'get-facility',
                }, success: function(res){

                    if(res.length > 0){
                        for (let index = 0; index < res.length; index++) {
                            $('#facility').append(
                                `<option value="${res[index]['Facility_id']}">${res[index]['Facility_name']}</option>`
                            )
                        }
                    }

                }
            });
            
        }

        getReservationDetails();
        function getReservationDetails(){

            $('#facility').html("");
            $.ajax({
                method      : 'POST',
                url         : 'adminAction.php',
                dataType    : "JSON",
                data        : {
                    action      : 'get-reservation',
                }, success: function(res){

                    if(res.length > 0){
                        for (let index = 0; index < res.length; index++) {
                            $('#reservation').append(
                                `<option value="${res[index]['Reservation_id']}">${res[index]['FirstName']+ ' ' +res[index]['LastName']+ ' - ' +res[index]['Event'] }</option>`
                            )
                        }
                    }

                }
            });
            
        }

        getFacilityDetails();
        function getFacilityDetails() {

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
                                `<img data-toggle="modal" class="view-receipt" data-target="#view-receipt" src="public/uploads/images/${res[index]['Receipt']}" style="height: 35px;"/>`,
                                res[index]['Status'],
                                `<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Update Status
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="#">Approved</a>
                                            <a class="dropdown-item" href="#">Cancel</a>
                                        </div>
                                    </div>
                                </div>`
                            ]).draw();
                        }
                    }

                }
            });

        }

        $(document).on('click', '.view-receipt', function() {
            var src = $(this).attr('src');
            $('.view-receipt-image').empty().append('<img id="theImg" src="'+ src +'" />');
        });

        $('[name=new-payment-form]').on('submit', function(e) {
            //alert();
            $('[type=submit]').attr('disabled', 'true');
            let customer    =          $('#customer').val();
            let facility    =          $('#facility').val();
            let reservation =          $('#reservation').val();
            let amount      =          $('#amount').val();
            var file_data   =          $('#receipt').prop('files')[0];

            var form_data   = new FormData();
            form_data.append('customer', customer);
            form_data.append('facility', facility);
            form_data.append('reservation', reservation);
            form_data.append('amount', amount);
            form_data.append('file', file_data);
            form_data.append('action', 'create-payment');
            
            try {
                $.ajax({
                    method: 'POST',
                    url: 'adminAction.php',
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(res) {

                        if (res['status'] == 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: res['message']
                            });
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);

                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: res['message']
                            });
                        }

                    }
                });
            } catch (error) {
                console.log(error);
            }

            e.preventDefault();

        });

    });

</script>