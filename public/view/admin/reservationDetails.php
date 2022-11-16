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
                <?php foreach ($resDetails['facilities'] as $key => $value) : ?>

                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-content-divider">
                                    <div class="card-image">
                                        <img class="card-img-top d-block" src="public/uploads/images/<?php echo $value['img']; ?>" alt="Card image cap">
                                    </div>
                                    <div class="card-content pl-3 pt-3">
                                        <h5 class="card-title"><?php echo $value['faclityName']; ?></h5>
                                        <p class="card-text"><?php echo $value['facilityDate'] ?></p>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <!-- <li><?php echo $value['faclityName'] ?> <b>(<?php echo $value['facilityDate'] ?>)</b></li> -->
                <?php endforeach; ?>
            </div>
            <div class="col-lg-6">
                <div>
                    <div class="reservation-title">
                        <h4 class="card-title">Reservation No. <?php echo $resDetails['reservationId']; ?></h4>
                        <p>Customer: <?php echo $resDetails['customer']; ?></p>
                    </div>
                    <div class="attendies">
                        <h5 class="card-title">Number of Guests</h5>
                        <div> 
                            
                            <p>Adult: <span><?php echo $resDetails['number_of_adults']; ?></span></p>
                            <p>Kids: <span><?php echo $resDetails['number_of_children']; ?></span></p>
                        </div>
                    </div>
                    <div class="event">
                        <h5 class="card-title">Event</h5>
                        <p><?php echo $resDetails['Event']; ?></p>
                    </div>
                    <div class="status">
                        <h5 class="card-title">Status</h5>
                        <p><?php echo $resDetails['status']; ?></p>
                    </div>
                </div>


            </div>
        </div>

    </div>
</section>

<style type="text/css">
        .custom-card {
            border: 1px solid #dbdbdb;
            padding: 10px 20px;
            max-width: 50em;
            margin: auto;
            border-radius: 5px;
            align-items: center;
            background-color: white;
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