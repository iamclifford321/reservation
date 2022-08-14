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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-new-reservation">New Reservation</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="reservation-data" class="table table-striped">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Facility</th>
                        <th>Event</th>
                        <th>Event Date</th>
                        <th>Event Start</th>
                        <th>Event End</th>
                        <th>Guest Count</th>
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

<div class="modal fade" id="modal-new-reservation">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" name="new-reservation-form">
                <div class="modal-header">
                  <h4 class="modal-title">Default Modal</h4>
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
                                <label for="event">Event</label>
                                <input type="text" name="event" id="event" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="event-date">Event Date</label>
                                <input type="text" name="event-date" id="event-date" class="form-control datepicker" required>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
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
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="guest">No of Guest</label>
                                <input type="number" name="guest" id="guest" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="paid">Paid</option>
                                    <option value="pending">Pending</option>
                                </select>
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


<script>

// Some Script Here!
    $(document).ready(function(){

        $('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' });

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

        getReservationDetails();
        function getReservationDetails(){
            $.ajax({
                method      : 'POST',
                url         : 'adminAction.php',
                dataType    : "JSON",
                data        : {
                    action      : 'get-reservation',
                }, success: function(res){
                    console.log('res===> ', res);
                    if(res.length > 0){
                        table.clear().draw();
                        for (let index = 0; index < res.length; index++) {
                            const element = res[index];
                            table.row.add([
                                res[index]['Customer_id'],
                                res[index]['Facility_id'],
                                res[index]['Event'],
                                res[index]['Reservation_date'],
                                res[index]['Date_in'],
                                res[index]['Date_out'],
                                res[index]['Number_of_guest'],
                                `<a href="#" class="reservationStatus" data-target="#modal-update-status" data-toggle="modal" Reservation_id="${res[index]['Reservation_id']}">${res[index]['Reservation_status']}</a>`
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
                        for (let index = 0; index < res.length; index++) {
                            $('#facility').append(
                                `<option value="${res[index]['Facility_id']}">${res[index]['Facility_name']}</option>`
                            )
                        }
                    }

                }
            });
            
        }
            
        $('[name=new-reservation-form]').on('submit', function(e){
            //alert();
            let customer     = $('#customer').val();
            let facility     = $('#facility').val();
            let event        = $('#event').val();
            let eventdate    = $('#event-date').val();
            let eventfrom    = $('#event-from').val();
            let eventto      = $('#event-to').val();
            let guest        = $('#guest').val();
            let status       = $('#status').val();




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
                        eventdate    : eventdate,
                        eventfrom    : eventfrom,
                        eventto      : eventto,
                        guest        : guest,
                        status       : status
                }, success : function(res){

                    if(res['status'] == 'success'){
                        Toast.fire({
                            icon: 'success',
                            title: 'Successfully created a new record!'
                        });
                        getTheUser();
                        $('#modal-new-reservation').modal('hide');
                    }

                }
            });
            e.preventDefault();
            
        });


    });

</script>