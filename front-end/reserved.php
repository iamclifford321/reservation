
<!doctype html>
<html lang="en">
    
    <?php include 'head.php'; ?>
    <?php if(!isset($_SESSION['user_data'])) header('Location:login.php'); ?>
    <body>
        <!--================Header Area =================-->
        <?php include 'header.php'; ?>
        <!--================Header Area =================-->
        
        <!--================Breadcrumb Area =================-->
        <section class="breadcrumb_area">
            <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" style="background:none"></div>
            <div class="container">
                <div class="page-cover text-center">
                    <h2 class="page-cover-tittle">Reserved</h2>
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Reserved</li>
                    </ol>
                </div>
            </div>
        </section>
        <!--================Breadcrumb Area =================-->
        
        <!--================Contact Area =================-->
        <section class="contact_area section_gap">
            <div class="container">
                <table class="table res-table">
                    <thead>
                        <th>Reserved Date</th>
                        <th>Customer</th>
                        <th>Number of Guest</th>
                        <th>Facility</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </section>
        <!--================Contact Area =================-->
        
        <!--================ start footer Area  =================-->	
        <?php include 'footer.php'; ?>
        
    </body>

    <script>
        $(document).ready(function(){
            // alert();
            getTheReserved();
            function getTheReserved(){
                $.ajax({
                url: "../customerAction.php",
                method : "POST",
                dataType : "JSON",
                data: {
                    action : 'getReservationFrontEnd'
                },
                success: function(res){
                    var table = $('.res-table').DataTable();
                    table.clear().draw();

                    for (let index = 0; index < res.length; index++) {
                            const element = res[index];
                            table.row.add([
                                element['Date_in'] + ' to ' + element['Date_in'],
                                element['FirstName'] + ' ' + element['LastName'],
                                element['Number_of_guest'],
                                element['Facility_name'],
                                element['Reservation_status'],
                                300,
                                'asd'
                            ]).draw();
                        }
                }
            });
            }

        })
    </script>
</html>