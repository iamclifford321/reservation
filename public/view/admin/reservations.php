<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Reservations</h1> 
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Reservations</li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-new-reservation">New Reservation</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="reservation-data" class="table table-striped">
                <thead>
                    <tr>

                        <th>Reservation Date</th>
                        <th>Customer</th>
                        <th>Number of Guest</th>
                        <th>Facility</th>
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

<div class="modal fade" id="modal-new-reservation">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" name="new-reservation-form">
                <div class="modal-header">
                  <h4 class="modal-title">Reservation</h4>
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
                                    <option value="">-- Select --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="eventDate">Event Date</label>
                                <input type="text" name="eventDate" id="eventDate" class="form-control" required>
                                <small class="text-danger d-none alert-reserve">There has already been a reservation on the selected date.</small>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="event">Event</label>
                                <input type="text" name="event" id="event" class="form-control" required>
                            </div>
                        </div>

                        <input type="hidden" name="fromDate">
                        <input type="hidden" name="toDate">
                        <input type="hidden" name="numberOfDays">
                        <input type="hidden" name="price">

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="guest">No of Guest</label>
                                <input type="number" name="guest" id="guest" class="form-control">
                            </div>
                        </div>

                        <!-- <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="event-from">From</label>
                                <input type="text" name="event-from" id="event-from" class="form-control datepicker" required>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="event-to">To</label>
                                <input type="text" name="event-to" id="event-to" class="form-control datepicker" required>
                            </div>
                        </div> -->

                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="saveReservation" disabled="true">Save</button>
                </div>
            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.Default Modal -->

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
                                <label for="payment-customer">Customer</label>
                                <input type="text" name="customer-payment" id="payment-customer" class="form-control" disabled>
                                <input type="hidden" id="payment-customer-id">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="payment-facility">Facility</label>
                                <input type="text" name="customer-facility" id="payment-facility" class="form-control" disabled>
                                <input type="hidden" id="payment-facility-id">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="payment-reservation">Reservation</label>
                                <input type="text" name="customer-reservation" id="payment-reservation" class="form-control" disabled>
                                <input type="hidden" id="payment-reservation-id">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 margin bottom">
                            <div class="form-group">
                                <label for="payment-amount">Amount</label>
                                <input type="number" name="payment-amount" id="payment-amount" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 margin-20px">
                            <div class="form-group custom-file">
                                <label class="custom-file-label" for="payment-receipt">Choose file</label>
                                <input type="file" name="payment-receipt" id="payment-receipt" class="custom-file-input form-control" >
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

<div class="modal fade" id="approved-payment">
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
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cancel-reservation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cancel Reciept</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12 col-md-12 margin-20px">
                    <div class="form-group custom-file">
                        <h5>Do you like to cancel this reservation?</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Proceed</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="refund-payment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cancel Reciept</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12 col-md-12 margin-20px">
                    <div class="form-group custom-file">
                        <label class="custom-file-label" for="refund">Choose file</label>
                        <input type="file" name="refund" id="refund" class="custom-file-input form-control"
                            required>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Proceed</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .bottom {
        margin-bottom: 15px;
    }
    .margin-20px {
        margin-bottom: 20px;
    }
    .make-payment:disabled {
        cursor: not-allowed;
        pointer-events: all;
    }
</style>

<script>

// Some Script Here!
    $(document).ready(function(){

        const days = (date_1, date_2) =>{
            let difference = date_1.getTime() - date_2.getTime();
            let TotalDays = Math.ceil(difference / (1000 * 3600 * 24));
            return TotalDays;
        }

        $('#facility').on('change', function(){
            
            var facility_id = $(this).val();           
            getFacilityReservation(facility_id);
            $('[name=price]').val($(this).find(":selected").attr('price'));
            if(facility_id == '' || facility_id == null){
                $('[name=saveReservation]').prop('disabled', true);
                $('[name=price]').val(null)
            }
            
        })
        function getFacilityReservation(facility_id){

            $.ajax({
                url : "customerAction.php",
                method : "POST",
                dataType: 'JSON',
                data : {
                    action : 'getFacilityReservation',
                    faciltyId : facility_id
                },
                success: function(res){
                    console.log('res', res);
                    let disabledDates = [];
                    for (const elmnt of res) {
                        disabledDates.push(moment(elmnt).format('YY-MM-DD'));
                    }
                    $('#eventDate').daterangepicker({
                                                        locale : {
                                                            format : 'YYYY/MM/DD'
                                                        },
                                                        isInvalidDate: function(ele) {
                                                            var currDate = moment(ele._d).format('YY-MM-DD');
                                                            return disabledDates.indexOf(currDate) != -1;
                                                        },
                                                        autoUpdateInput: false,
                                                    },function(start, end, label){
                                                        var strtDate = start.format('Y-MM-DD');
                                                        var endDate = end.format('Y-MM-DD');
                                                        // console.log(endDate);
                                                        var isValid = true;
                                                        for (const elmnt of res) {
                                                            if(isDateBetween(strtDate, endDate, elmnt)){
                                                                isValid = false;
                                                            }
                                                        }
                                                        if(!isValid){
                                                            $('.alert-reserve').removeClass('d-none');
                                                            $('[name=saveReservation]').prop('disabled', true);
                                                            $('#eventDate').val(strtDate + ' to ' + endDate);
                                                            return;
                                                        }
                                                        $('.alert-reserve').addClass('d-none');
                                                        
                                                        $('[name=saveReservation]').prop('disabled', false);
                                                        $('[name=fromDate]').val(strtDate);
                                                        $('[name=toDate]').val(endDate);
                                                        $('#eventDate').val(strtDate + ' to ' + endDate);
                                                        var numDays = days(new Date(endDate), new Date(strtDate));
                                                        $('[name=numberOfDays]').val( numDays + 1);
                                                    });


                }
            });

        }

        function isDateBetween(dateFrom, dateTo, dateCheck){
            
            console.log('dateFrom', dateFrom);
            var from = new Date(dateFrom);  // -1 because months are from 0 to 11
            var to   = new Date(dateTo);
            var check = new Date(dateCheck);

            return check >= from && check <= to;

        }


            

        $("#payment-receipt").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
        });

        let table = $("#reservation-data").DataTable({
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

        $(document).on('click', '.approved-payment', function() {
            console.log('clicked');
            var src = $(this).attr('receipt-value');
            $('.view-receipt-image').empty().append('<img id="theImg" src="'+ src +'" />');
        });

        getReservationDetails();

        function getReservationDetails(){
            // TEST HAHA
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            
            $.ajax({
                method      : 'POST',
                url         : 'adminAction.php',
                dataType    : "JSON",
                data        : {
                    action      : 'get-reservation',
                    filterBy    : urlParams.get('filterBy')
                }, success: function(res){
                    console.log('res===> ', res);
                    if(res.length > 0){
                        table.clear().draw();


                        for (let index = 0; index < res.length; index++) {
                            const element = res[index];
                            var status      = '';
                            var dataTarget  = '';
                            var approve = ``;
                            if(res[index]['status'] == 'Pending Cancel'){
                                approve = `<a href="?page=approveCancelation&reservationId=${element.reservationId}&customerId=${element.customerId}" class="dropdown-item cancel-payment">Approve Cancellation</a>`;
                            }
                            var cancel = `<a href="?page=approveCancelation&reservationId=${element.reservationId}&customerId=${element.customerId}" class="dropdown-item cancel-payment">Cancel</a>`;
                            if(res[index]['status'] == 'Pending Cancel' || res[index]['status'] == 'Cencelled'){
                                cancel = ``;
                            }
                            // <a href="?page=payment&reservationId=${element.reservationId}&customerId=${element.customerId}&totalAmountFac=${element.totalAmountFac}" class="dropdown-item make-payment">Pay</a>
                            var facilities = ``;
                            element.facilities.forEach(iterator => {
                                facilities += `<li>
                                                    <a href="#"><small>${iterator.faclityName} (${iterator.facilityDate})</small></a>
                                                </li>`;
                            });
                            table.row.add([
                                res[index]['date'],
                                res[index]['customer'],
                                res[index]['numberOfCustomer'],
                                //res[index]['Reservation_date'],
                                `<ul>${facilities}</ul>`,
                                res[index]['status'],
                                `<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a href="?page=paymentHistory&reservationId=${element.reservationId}&customerId=${element.customerId}&totalAmountFac=${element.totalAmountFac}&status=${res[index]['status']}" class="dropdown-item make-payment">Payment history</a>
                                            ${cancel}
                                            ${approve}
                                        </div>
                                    </div>
                                </div>`
                            ]).draw();




                        }
                    }
                }
            });
            
        }

        getCustomersDetails();
        function getCustomersDetails(){

            $('#customer').html("");
            console.log('test');
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
            console.log('test');
            $.ajax({
                method      : 'POST',
                url         : 'adminAction.php',
                dataType    : "JSON",
                data        : {
                    action      : 'get-facility',
                }, success: function(res){
                    if(res.length > 0){
                        $('#facility').append(`<option value="">-- Select --</option>`);
                        for (let index = 0; index < res.length; index++) {
                            if(res[index]['status'] == 'Activate'){
                                $('#facility').append(
                                    `<option value="${res[index]['Facility_id']}" price="${res[index]['Price']}">${res[index]['Facility_name']}(₱${res[index]['Price']}/day)</option>`
                                )
                            }
                        }
                    }
                }
            });
            
        }
            
        $('[name=new-reservation-form]').on('submit', function(e){
            //alert();
            let customer     = $('#customer').val();
            let event        = $('#event').val();
            //let eventdate    = $('#event-date').val();
            let facility     = $('#facility').val();
            let eventfrom    = $('[name=fromDate]').val();
            let eventto      = $('[name=toDate]').val();
            let guest        = $('#guest').val();
            //let status       = $('#status').val();




          //  e.preventDefault();

            $.ajax({
                method      : 'POST',
                url         : 'adminAction.php',
                dataType    : "JSON",
                data        : {
                        action       : 'create-reservation',
                        customer     : customer,
                        facility     : facility,
                        event        : event,
                        //eventdate    : eventdate,
                        eventfrom    : eventfrom,
                        eventto      : eventto,
                        guest        : guest,
                        numberOfDays    : $('[name=numberOfDays]').val(),
                        price   : $('[name=price]').val()

                }, success : function(res){

                    if(res['status'] == 'success'){
                        Toast.fire({
                            icon: 'success',
                            title: 'Successfully created a new record!'
                        });
                        getReservationDetails();
                        $('#modal-new-reservation').modal('hide');
                    }

                }
            });
            e.preventDefault();
            
        });

        $(document).on('click', '#make-payment', function() {

            console.log('1==> ', $(this).attr('payment-customer-id'));
            console.log('2==> ', $(this).attr('payment-facility-id'));
            console.log('3==> ', $(this).attr('payment-reservation-id'));

            $('#payment-customer').val($(this).attr('payment-customer'));
            $('#payment-facility').val($(this).attr('payment-facility'));
            $('#payment-reservation').val($(this).attr('payment-reservation'));
            $('#payment-customer-id').val($(this).attr('payment-customer-id'));
            $('#payment-facility-id').val($(this).attr('payment-facility-id'));
            $('#payment-reservation-id').val($(this).attr('payment-reservation-id'));

        });

        $('[name=new-payment-form]').on('submit', function(e) {
            //alert();
            $('[type=submit]').attr('disabled', 'true');
            let customer    =          $('#payment-customer-id').val();
            let facility    =          $('#payment-facility-id').val();
            let reservation =          $('#payment-reservation-id').val();
            let amount      =          $('#payment-amount').val();
            var file_data   =          $('#payment-receipt').prop('files')[0];

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