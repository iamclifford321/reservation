<?php 
        require_once 'Config/Config.php';
        require_once 'Model/Model.php';
        require_once 'Controller/Controller.php';

        $controller = new Controller();
        $resDetails = $controller->getSpecificReservationWith($_GET['reservationId']);
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

        </div> 
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">

        <div class="row custom-card">
            <div class="col-lg-6">
                <img src="../../uploads/images/76Untitled.png">
            </div>
            <div class="col-lg-6">
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
        </div>

    </div>
</section>

<style type="text/css">
        .custom-card {
            border: 1px solid #04091E;
            padding: 10px 20px;
            max-width: 75%;
            margin: auto;
            border-radius: 5px;
            box-shadow: -3px -2px #2778fe;
        }
        p {
            margin-bottom: 0;
            width: 100%;
            font-size: 16px;
        }
        .card-title {
            margin-bottom: 0;
            width: 100%;
            font-weight: 600;
            font-size: 18px;
        }
        .reservation-title,
        .aminities,
        .attendies,
        .event,
        .status {
            margin-bottom: 10px;
        }
    </style>