<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Customers</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Customers</li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-new-customer">New Customer</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone number</th>
                        <th>Address</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Email</th>
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

<!-- /.card -->

<div class="modal fade" id="modal-new-customer">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="POST" name="customer-form">
            <div class="modal-header">
                <h4 class="modal-title">New Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
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
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" id="phone" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" name="age" id="age" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class="form-control"></textarea>
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
  <!-- /.modal -->



  <div class="modal fade" id="modal-existing-customer">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="POST" name="exsting-customer-form">
            <div class="modal-header">
                <h4 class="modal-title">Existing Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="exsting-firstname">Firstname</label>
                            <input type="text" name="exsting-firstname" id="exsting-firstname" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="exsting-middlename">Middlename</label>
                            <input type="text" name="exsting-middlename" id="exsting-middlename" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="exsting-lastname">Lastname</label>
                            <input type="text" name="exsting-lastname" id="exsting-lastname" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="exsting-phone">Phone</label>
                            <input type="number" name="exsting-phone" id="exsting-phone" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="exsting-age">Age</label>
                            <input type="number" name="exsting-age" id="exsting-age" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="exsting-gender">Gender</label>
                            <select name="exsting-gender" id="exsting-gender" class="form-control" required>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="exsting-email">Email</label>
                            <input type="email" name="exsting-email" id="exsting-email" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="exsting-address">Address</label>
                            <textarea name="exsting-address" id="exsting-address" class="form-control"></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="customerID">


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
  <!-- /.modal -->


<script>
$(document).ready(function(){


    var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
    });

    let table = $("#example1").DataTable({
                    "responsive"    : true, 
                    // "lengthChange"  : false, 
                    "autoWidth"     : false,
                    "buttons"       : [
                                        // "csv", 
                                        // "excel", 
                                        // "pdf", 
                                        // "print"
                                    ]
                });
    
    getTheCustomers();
    function getTheCustomers(){
        $.ajax({
            method      : 'POST',
            url         : 'adminAction.php',
            dataType    : "JSON",
            data        : {
                action      : 'get-customer',
            }, success: function(res){
                if(res.length > 0){
                    table.clear().draw();
                    for (let index = 0; index < res.length; index++) {
                        const element = res[index];
                        let age = 'N/A';
                        let address = 'N/A';
                        let email = 'N/A';
                        if(res[index]['Age'] != '') age = res[index]['Age'];
                        if(res[index]['Address'] != '') address = res[index]['Address'];
                        if(res[index]['Email'] != '') email = res[index]['Email'];
                        table.row.add([
                            `<a href="#" class="customerName" data-target="#modal-existing-customer" data-toggle="modal" customer_Id="${res[index]['customer_id']}">${res[index]['FirstName'] + ' ' + res[index]['MiddleName'] + ' ' + res[index]['LastName']}</a>`,
                            res[index]['PhoneNumber'],
                            address,
                            age,
                            res[index]['Gender'],
                            email
                        ]).draw();
                    }
                }
            }
        });

        table.buttons()
        .container()
        .appendTo('#example1_wrapper .col-md-6:eq(0)');
    }

    $(document).on('click', '.customerName', function(){
        
        getCustomer($(this).attr('customer_Id'));
    });
    function getCustomer(customer_Id){
        $.ajax({
            method      : 'POST',
            url         : 'adminAction.php',
            dataType    : "JSON",
            data        : {
                action      : 'getSpecificCustomer',
                customerId  : customer_Id
            }, success : function(res){
                $('#exsting-firstname').val(res['FirstName']);
                $('#exsting-middlename').val(res['MiddleName']);
                $('#exsting-lastname').val(res['LastName']);
                $('#exsting-phone').val(res['PhoneNumber']);
                $('#exsting-age').val(res['Age']);
                $('#customerID').val(customer_Id);
                
                $('#exsting-email').val(res['Email']);
                $('#exsting-address').val(res['Address']);
                let gender = ['Male', 'Female'];
                $('#exsting-gender').html("");
                for (let index = 0; index < gender.length; index++) {
                    const element = gender[index];
                    $slctd = '';
                    if(element == res['Gender']){
                        $slctd='Selected';
                    }
                    console.log($slctd);
                    $('#exsting-gender').append(
                        `<option value="${element}" ${$slctd}>${element}</option>`
                    )
                    
                }
            }
        })
    }

    $('[name=customer-form]').on('submit', function(e){

        let firstname   = $('#firstname').val();
        let middlename  = $('#middlename').val();
        let lastname    = $('#lastname').val();
        let phone       = $('#phone').val();
        let age         = $('#age').val();
        let gender      = $('#gender').val();
        let email       = $('#email').val();
        let address     = $('#address').val();
        
        console.log($(this));
        $.ajax({
            method      : 'POST',
            url         : 'adminAction.php',
            dataType    : "JSON",
            data        : {
                action      : 'create-customer',
                firstname   : firstname,
                middlename  : middlename,
                lastname    : lastname,
                phone       : phone,
                age         : age,
                gender      : gender,
                email       : email,
                address     : address,
                
            },success: function(responce){
                if(responce['status'] == 'success'){
                    Toast.fire({
                        icon: 'success',
                        title: 'Succesfully created a new record!'
                    });
                    getTheCustomers();
                    $('#modal-new-customer').modal('hide');
                }
            }
        })
        e.preventDefault();
        
    });

    $('[name=exsting-customer-form]').on('submit', function(e){
        let firstname   = $('#exsting-firstname').val();
        let middlename  = $('#exsting-middlename').val();
        let lastname    = $('#exsting-lastname').val();
        let phone       = $('#exsting-phone').val();
        let age         = $('#exsting-age').val();
        let gender      = $('#exsting-gender').val();
        let email       = $('#exsting-email').val();
        let address     = $('#exsting-address').val();
        let customerID  = $('#customerID').val();
        $.ajax({
            method      : 'POST',
            url         : 'adminAction.php',
            dataType    : "JSON",
            data        : {
                    action      : 'updateCustomer',
                    firstname   : firstname,
                    middlename  : middlename,
                    lastname    : lastname,
                    phone       : phone,
                    age         : age,
                    gender      : gender,
                    email       : email,
                    address     : address,
                    customerID  : customerID
            },success : function(res){
                if(res['status'] == 'success'){
                    Toast.fire({
                        icon: 'success',
                        title: 'Succesfully created a new record!'
                    });
                    getTheCustomers();
                    $('#modal-existing-customer').modal('hide');
                }

            }
        });
        e.preventDefault();
        
    })
})


</script>