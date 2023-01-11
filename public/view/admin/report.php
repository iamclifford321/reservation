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
            <!-- /.card-header -->
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                    </div>
                    <div class="col-sm-6 col-md-6" style="text-align: right;">
                        <div class="form-group">
                            <label for="customer">Date</label>
                            <input type="text" id="min" name="min">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="customerTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Reservation</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Customer Name</td>
                            <td>Reservation</td>
                            <td>Start Date</td>
                            <td>End Date</td>
                            <td>Status</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.Main content here -->

    </div>
</section>
<script>
    $(document).ready(function() {
        // Create date inputs
        $('#min').datepicker({
            format: 'MMMM Do YYYY'
        });
    });
</script>

<!-- /.card -->