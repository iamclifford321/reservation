<?php 
        require_once '../Config/Config.php';
        require_once '../Model/Model.php';
        require_once '../Controller/Controller.php';
        $controller = new Controller(); 
        $reservations = $controller->getSpecificReservation( $_GET['reservationId'] );
?>

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
                        <li><a href="reserved.php">Reserved</a></li>
                        <li class="active">Details</li>
                    </ol>
                </div>
            </div>
        </section>
        <!--================Breadcrumb Area =================-->
        
        <!--================Contact Area =================-->
        <section class="contact_area section_gap">
            <div class="container table-container">

                <div class="row custom-card">
                    <div class="col-lg-6 col-xl-6 card-col">
                        <img src="../public/uploads/images/113064videoke 15x4 super jumbo.jpg">
                    </div>
                    <?php foreach($reservations as $reserve) : ?>
                    <div class="col-lg-6 col-xl-3 mb-4">.
                        <div class="reservation-title">
                            <h4 class="card-title">Reservation Title</h4>
                            <p>Customer Name</p>
                        </div>
                        <div class="aminities">
                            <h5 class="card-title">Aminities</h5>
                            <ul>
                                <li>Aminity 1</li>
                                <li>Aminity 2</li>
                                <li>Aminity 2</li>
                            </ul>  
                        </div>
                        <div class="attendies">
                            <h5 class="card-title">Number of Guests</h5>
                            <div>
                                <p>Adult: <span>200</span></p>
                                <p>Kids: <span>50</span></p>
                            </div>
                        </div>
                        <div class="event">
                            <h5 class="card-title">Event</h5>
                            <p>Birthday Party</p>
                        </div>
                        <div class="status">
                            <h5 class="card-title">Status</h5>
                            <p>Pending</p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </section>
        <!--================Contact Area =================-->
        
        <!--================ start footer Area  =================-->	
        <?php include 'footer-links.php'; ?>
        <?php // include 'footer.php'; ?>
        
    </body>
    <style type="text/css">
        .custom-card {
            border: 1px solid #04091E; 
            padding: 10px 20px;
            max-width: 75%;
            margin: auto;
            border-radius: 5px;
            box-shadow: -3px -2px #2778fe;
        }
        p, .card-title {
            margin-bottom: 0;
        }
        .reservation-title,
        .aminities,
        .attendies,
        .event,
        .status {
            margin-bottom: 10px;
        }
    </style>
    
</html>