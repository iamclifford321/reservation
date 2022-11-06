
<section class="content-header">
</section>

<section class="content">
    <div class="container-fluid">

        <!-- Main content here -->
        <input type="hidden" id="userId" value="<?php echo $_SESSION['user_data']['User_id']; ?>">
        <div class="modal-dialog">
            <form action="" method="POST" name="saveBasic">
                <div class="modal-content" style="box-shadow: none">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Basic Info</h4>
                    </div>
                    <div class="modal-body">
                      
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="">Firstname</label>
                                  <input type="text" required name="firstname" class="form-control" value="<?php echo $_SESSION['user_data']['FirstName']; ?>">
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="">Lastname</label>
                                  <input type="text" required name="lastname" class="form-control" value="<?php echo $_SESSION['user_data']['LastName']; ?>">
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for="">Username</label>
                                  <input type="text" required name="username" class="form-control" value="<?php echo $_SESSION['user_data']['Username']; ?>">
                              </div>
                          </div>
                      </div>
      
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="submit" id="saveBasic" class="btn btn-primary">Save</button>
                    </div>
                  </div>
            </form>

            <!-- /.modal-content -->
          </div>


          <div class="modal-dialog">

            <form action="" name="savePass" method="Post">

            
                <div class="modal-content" style="box-shadow: none">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Password</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Old Password</label>
                                <input type="password" name="oldPass" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">New Password</label>
                                <input type="password" name="newPass" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Retype Password</label>
                                <input type="password" name="reTypePass" class="form-control" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" id="savePass" class="btn btn-primary">Save</button>
                </div>
                </div>
            </form>
            <!-- /.modal-content -->
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


<script>

// Some Script Here!
$(document).ready(function(){
    var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
    });

    $('[name=saveBasic]').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            method : 'POST',
            url         : 'adminAction.php',
            dataType    : "JSON",
            data: {
                action : 'updateUserProfile',
                userId : $('#userId').val(),
                firstname : $('[name=firstname]').val(),
                lastname : $('[name=lastname]').val(),
                username : $('[name=username]').val()
            },
            success : function(res){
                if(res['status'] == 'success'){
                    Toast.fire({
                        icon: 'success',
                        title: 'User has been info updated',
                    });
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }else{
                    Toast.fire({
                        icon: 'error',
                        title: 'Error updating',
                    });
                }
            }
        })
    })
    $('[name=savePass]').on('submit', function(e){
        e.preventDefault()
        $.ajax({
            method : 'POST',
            url         : 'adminAction.php',
            dataType    : "JSON",
            data: {
                action : 'getThepassUser',
                userId : $('#userId').val(),
                oldPass : $('[name=oldPass]').val()
            }, success : function(res){
                if(res['status'] == 'error'){
                    Toast.fire({
                            icon: 'error',
                            title: 'error occured'
                        });
                }else{
                    if(res){

                        if($('[name=newPass]').val() == $('[name=reTypePass]').val()){


                            $.ajax({
                                method : 'POST',
                                url         : 'adminAction.php',
                                dataType    : "JSON",
                                data : {
                                    action : 'updateThePass',
                                    userId : $('#userId').val(),
                                    newPass : $('[name=newPass]').val()
                                }, success : function(res){
                                    if(res['status'] == 'success'){
                                        Toast.fire({
                                            icon: 'success',
                                            title: 'Password has been updated',
                                        });
                                        setTimeout(() => {
                                            window.location.reload();
                                        }, 2000);
                                    }

                                }
                            })
                        }else{
                            Toast.fire({
                            icon: 'error',
                            title: 'Please make sure you retyoe your password correctly'
                        });
                        }
                    }else{
                        Toast.fire({
                            icon: 'error',
                            title: 'Old password is Invalid'
                        });
                    }
                    
                }
            }
        })
    })
})
</script>