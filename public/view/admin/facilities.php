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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-new-facility">New Facility</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="facility-data" class="table table-striped">
                <thead>
                    <tr>
                        <th>Facility Type</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cottage 1</td>
                        <td>1000</td>
                        <td><button type="submit" class="btn btn-danger deletefacility">Delete</button></td>
                    </tr>
                    <tr>
                        <td>Cottage 2</td>
                        <td>1500</td>
                        <td><button type="submit" class="btn btn-danger deletefacility">Delete</button></td>
                    </tr>
                    <tr>
                        <td>Cottage 3</td>
                        <td>2000</td>
                        <td><button type="submit" class="btn btn-danger deletefacility">Delete</button></td>
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

<div class="modal fade" id="modal-new-facility">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Default Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="row">

                <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="firstname">Facility Name</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" required>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="middlename">Price</label>
                        <input type="text" name="middlename" id="middlename" class="form-control">
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 margin-20px">
                    <div class="form-group custom-file">
                        <label class="custom-file-label" for="image">Choose file</label>
                        <input type="file" name="image" id="image" class="custom-file-input form-control">
                    </div>
                </div>

            </div>

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

<style>
    .margin-20px {
        margin: 20px 0;
    }
</style>
<script>

// Some Script Here!
    $(document).ready(function(){

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
        });

        let table = $("#facility-data").DataTable({
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


    });

</script>