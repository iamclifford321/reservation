
<!doctype html>
<html lang="en">
    
    <?php include 'head.php'; ?>
    <body>
        <!--================Header Area =================-->
        <?php include 'header.php'; ?>
        <!--================Header Area =================-->
        
        <!--================Breadcrumb Area =================-->
        <!-- <section class="breadcrumb_area">
            <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" style="background:none"></div>
            <div class="container">
                <div class="page-cover text-center">
                    <h2 class="page-cover-tittle">Facilities</h2>
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Facilities</li>
                    </ol>
                </div>
            </div>
        </section> -->
        <!--================Breadcrumb Area =================-->
        
        <!--================Contact Area =================-->
        <style>
            .card-content-divider{
                display: flex;
                align-content: center;
                align-items: center;
            }
            .card-content-divider .card-image{
                width: 120px;
            }

            .card-content-divider .card-content a, .card-content-divider .card-content label{
                font-size: 16px;
            }
        </style>
        
        <section class="contact_area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                    <?php 
                        
                        $total = 0;
                        if(count($_SESSION['Facilities']) > 0){
                            foreach ($_SESSION['Facilities'] as $key => $facility) {
                                $total += $facility['facilityPrice'];
                                ?>
                                    <div class="mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-content-divider">
                                                    <div class="card-image">
                                                        <img class="card-img-top d-block" src="image/gallery/02.jpg" alt="Card image cap">
                                                    </div>
                                                    <div class="card-content pl-3">
                                                        <h5 class="card-title"><?php echo $facility['facilityName']; ?></h5>
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                        <label for="" class="mr-2">₱<?php echo $facility['facilityPrice']; ?> </label> | <a href="removeFacility.php?key=<?php echo $key; ?>" class="text-secondary ml-2"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                <?php
                            }
                        }else{
                            ?>
                                <p>No record found, add reservation <a href="index.php#reservation-section">Here</a></p>
                            <?php
                        }
                    ?>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <label>Booking info</label>
                            </div>
                            <div class="card-body">
                                <form action="">
                                    <div class="form-group">
                                        <label for="">Total</label>
                                        <input type="text" class="form-control" readonly value="₱<?php echo number_format($total, 2); ?>">
                                        <input type="hidden" name="total" value="₱<?php echo $total; ?>">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Contact Area =================-->
        
        <!--================ start footer Area  =================-->	
        <?php // include 'footer.php'; ?>
        
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