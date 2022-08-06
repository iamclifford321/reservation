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
                    <tr>
                        <td>Clifford Ursabia</td>
                        <td>Cottage 1</td>
                        <td>Graduation Celebration</td>
                        <td>June 30, 2022</td>
                        <td>8:00 am</td>
                        <td>5:00 pm</td>
                        <td>200</td>
                        <td>Paid</td>
                    </tr>
                    <tr>
                        <td>Apple Guatno</td>
                        <td>Cottage 3</td>
                        <td>Birthday Party</td>
                        <td>June 30, 2022</td>
                        <td>8:00 am</td>
                        <td>5:00 pm</td>
                        <td>225</td>
                        <td>Pending</td>
                    </tr>
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
            <form action="" method="POST" name="new-user-form">
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
                                <label for="middlename">Facility</label>
                                <input type="text" name="middlename" id="middlename" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="lastname">Event</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="phone">Event Date</label>
                                <input type="number" name="phone" id="phone" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="age">From</label>
                                <input type="number" name="age" id="age" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="gender">To</label>
                                <input type="number" name="age" id="age" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="email">No of Guest</label>
                                <input type="number" name="age" id="age" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="address">Status</label>
                                <input type="number" name="age" id="age" class="form-control">
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
            
        $('[name=new-user-form]').on('submit', function(e){
            //alert();
            let firstname   = $('#firstname').val();
            let lastname    = $('#lastname').val();
            let address     = $('#address').val();
            let username    = $('#username').val();
            let password    = $('#password').val();




          //  e.preventDefault();

            $.ajax({
                method      : 'POST',
                url         : 'adminAction.php',
                dataType    : "JSON",
                data        : {
                        action      : 'create-user',
                        firstname   : firstname,
                        lastname    : lastname,
                        address     : address,
                        username    : username,
                        password    : password
                }, success : function(res){

                    if(res['status'] == 'success'){
                        Toast.fire({
                            icon: 'success',
                            title: 'Successfully created a new record!'
                        });
                        getTheUser();
                        $('#modal-new-user').modal('hide');
                    }

                }
            });
            e.preventDefault();
            
        });


    });

</script>