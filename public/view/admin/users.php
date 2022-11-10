<input type="hidden" id="user_id" value="<?php echo $_SESSION['user_data']['User_id'] ?>">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Users</h1>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-new-user">New User</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="user-data" class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>User Name</th>
                        <th>Action</th>
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

<div class="modal fade" id="modal-new-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" name="new-user-form">
                <div class="modal-header">
                  <h4 class="modal-title">New User</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="lastname">Lastname</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="phone">Address</label>
                                <input type="text" name="address" id="address" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="age">Username</label>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="middlename">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
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
<div class="modal fade" id="modal-update-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" name="modal-update-user">
                <div class="modal-header">
                  <h4 class="modal-title">Edit user</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input type="text" name="existing-firstname" id="existing-firstname" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="lastname">Lastname</label>
                                <input type="text" name="existing-lastname" id="existing-lastname" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="phone">Address</label>
                                <input type="text" name="existing-address" id="existing-address" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="age">Username</label>
                                <input type="text" name="existing-username" id="existing-username" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" id="userId">

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

<script>

// Some Script Here!
    $(document).ready(function(){

        var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
        });

        let table = $("#user-data").DataTable({
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
    
        getTheUser();
        function getTheUser(){
            $.ajax({
                method      : 'POST',
                url         : 'adminAction.php',
                dataType    : "JSON",
                data        : {
                    action      : 'get-user',
                }, success: function(res){
                    console.log('res===> ', res);
                    if(res.length > 0){
                        table.clear().draw();
                        for (let index = 0; index < res.length; index++) {
                            const element = res[index];
                            if($('#user_id').val() != element.User_id){
                                table.row.add([
                                    `<a href="#" class="userName" data-target="#modal-update-user" data-toggle="modal" User_id="${res[index]['User_id']}">${res[index]['FirstName'] + ' ' + res[index]['LastName']}</a>`,
                                    res[index]['Address'],
                                    res[index]['Username'],
                                    `<button type="submit" class="btn btn-danger deleteRecord" User_id="${res[index]['User_id']}">Delete</button>`
                                ]).draw();
                            }

                        }
                    }
                }
            });

            table.buttons()
            .container()
            .appendTo('#example1_wrapper .col-md-6:eq(0)');
        }

        $(document).on('click', '.userName', function(){

            console.log('test');
            getUser($(this).attr('User_id'));

        });

        function getUser(User_id){
            $.ajax({
                method      : 'POST',
                url         : 'adminAction.php',
                dataType    : "JSON",
                data        : {
                    action      : 'getSpecificUser',
                    userId      : User_id
                }, success : function(res){
                    $('#existing-firstname').val(res['FirstName']);
                    $('#existing-lastname').val(res['LastName']);
                    $('#existing-address').val(res['Address']);
                    $('#existing-username').val(res['Username']);
                    $('#userId').val(User_id);
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

        $('[name=modal-update-user]').on('submit', function(e){
            let firstname   = $('#existing-firstname').val();
            let lastname    = $('#existing-lastname').val();
            let address     = $('#existing-address').val();
            let username    = $('#existing-username').val();
            let userId      = $('#userId').val();
            console.log('userId===> ', userId);
            $.ajax({
                method      : 'POST',
                url         : 'adminAction.php',
                dataType    : "JSON",
                data        : {
                        action      : 'update-user',
                        firstname   : firstname,
                        lastname    : lastname,
                        address     : address,
                        username    : username,
                        userId      : userId
                },success : function(res){
                    if(res['status'] == 'success'){
                        Toast.fire({
                            icon: 'success',
                            title: 'Succesfully updated the record!'
                        });
                        getTheUser();
                        $('#modal-update-user').modal('hide');
                    }

                }
            });
            e.preventDefault();
        
        });

        $(document).on('click', '.deleteRecord', function(e){

            var Id = $(this).attr('User_id');
            $('#userId').val(Id);
            $.ajax({
                method      : 'POST',
                url         : 'adminAction.php',
                dataType    : "JSON",
                data        : {
                        action      : 'delete-user',
                        userId      : Id
                }, success : function(res){
                    console.log( res );
                    if(res['status'] == 'success'){
                        Toast.fire({
                            icon: 'success',
                            title: 'Successfully deleted the record!'
                        });
                        getTheUser();
                    }

                }
            });
            e.preventDefault();

        });

    });

</script>