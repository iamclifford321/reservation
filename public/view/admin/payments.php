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
            <!-- <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-new-payment">Make Payment</button>
            </div> -->
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

<!-- /.Default Modal -->

<style type="text/css">
    .view-receipt{
        cursor: pointer;
    }
</style>
<script>

// Some Script Here!
    $(document).ready(function(){

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

        getPaymentDetails();
        function getPaymentDetails() {

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
                                `<img data-toggle="modal" class="" src="public/uploads/images/${res[index]['Receipt']}" style="height: 35px;"/>`,
                                res[index]['Status']
                            ]).draw();
                            
                        }
                    }

                }
            });

        }

    });

</script>