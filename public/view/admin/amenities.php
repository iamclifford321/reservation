<?php
    	require_once 'Config/Config.php';
        require_once 'Model/Model.php';
        require_once 'Controller/Controller.php';
        $controller = new Controller(); 
        $aminities = $controller->getAminities();
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Amenities</h1>
        </div>
        <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Name of the tab</li>
            </ol>
        </div> -->
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">

        <!-- Main content here -->

        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-new-aminity">New</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="reservation-data" class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($aminities as $aminity) {
                            ?>
                                <tr>
                                    <td><?php echo $aminity['Name']; ?></td>
                                    <td><?php echo number_format($aminity['price'], 2);?></td>
                                    <td>
                                        <button class="btn btn-primary editAmin" data-toggle="modal" aminitiesId="<?php echo $aminity['aminitiesId']?>" data-target="#modal-edit-aminity" aminName="<?php echo $aminity['Name']; ?>" price="<?php echo $aminity['price']; ?>">Edit</button>
                                        <button class="btn btn-danger aminityDelete" aminitiesId="<?php echo $aminity['aminitiesId']?>">Delete</button>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>

        <!-- /.Main content here -->

    </div>
</section>

<!-- Default Modal-->

<div class="modal fade" id="modal-new-aminity">
    <div class="modal-dialog">
        <form action="adminAction.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">New Aminity</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" required>
                  </div>
                  <div class="form-group">
                    <label for="">Price</label>
                    <input type="number" class="form-control" name="price" required>
                  </div>

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" name="action" value="saveaminity" class="btn btn-primary">Save</button>
                </div>
              </div>
        </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- Default Modal-->

<div class="modal fade" id="modal-edit-aminity">
    <div class="modal-dialog">
        <form action="adminAction.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Aminity</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="edit_name" required>
                  </div>
                  <div class="form-group">
                    <label for="">Price</label>
                    <input type="number" class="form-control" name="edit_price" required>
                  </div>
                  <input type="hidden" name="aminitiesId">
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" name="action" value="editaminity" class="btn btn-primary">Save</button>
                </div>
              </div>
        </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.Default Modal -->


<script>
$(document).ready(function(){
    var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
        });

    $(document).on('click', '.editAmin',function(){
        var aminName = $(this).attr('aminName');
        var price = $(this).attr('price');
        var aminitiesId = $(this).attr('aminitiesId');
        $('[name=edit_name]').val(aminName);
        $('[name=edit_price]').val(price);
        $('[name=aminitiesId]').val(aminitiesId);
    });

    $(document).on('click', '.aminityDelete', function(){
        var aminitiesId = $(this).attr('aminitiesId');
        $.ajax({
            url : "adminAction.php",
            method : "POST",
            dataType: 'JSON',
            data : {
                action : 'deleteAmin',
                aminitiesId
            },success: function(res){
                console.log(res);
                if(res['status'] == 'success'){
                    Toast.fire({
                            icon: 'success',
                            title: 'Successfully deleted a record!'
                    });
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
            }
        })
    })
})
// Some Script Here!

</script>   