
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

            .card-content-divider .card-content a{
                font-size: 15px;
            }
        </style>
        <section class="contact_area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-9">
                    <?php 
                        foreach ($_SESSION['Facilities'] as $facility) {
                            ?>
                            <div class="mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-content-divider">
                                            <div class="card-image">
                                                <img class="card-img-top d-block" src="image/gallery/02.jpg" alt="Card image cap">
                                            </div>
                                            <div class="card-content pl-3">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                <label for="">$100 | </label><a href="#" class="text-danger"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                                <!-- <div class="card" style="width: 18rem;">
                                    <img class="card-img-top d-block" src="image/gallery/02.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div> -->
                            <?php
                        }
                    ?>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        here
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