
<!doctype html>
<html lang="en">
    <?php
        if(!isset($_GET['reservationId'])) die('error');
        require_once '../Config/Config.php'; 
        require_once '../Model/Model.php'; 
        require_once '../Controller/Controller.php'; 
        $controller = new Controller(); 
        $resrvations = $controller->getSpecificReservation($_GET['reservationId']);
        // echo '<pre>';
        // print_r($resrvation);
        // die();
    ?>
    <?php include 'head.php'; ?>
    <?php if(!isset($_SESSION['user_data'])) header('Location:login.php'); ?>
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
                width: 120px; flex: 1;
            }
            .card-content-divider .card-content{
                flex: 3;
            }
            .card-content-divider .card-content a, .card-content-divider .card-content label{
                font-size: 16px;
            }
        </style>
        
        <section class="contact_area section_gap">
            <div class="container">
                <div class="row" style="justify-content:center;">
                    <div class="col-sm-12 col-md-8">

                        <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">How does this work?</h4>
                            <ul>
                                <li>
                                    After the cancelation, the resort personel will manually send back the paid money, deducted with the 20% of the paid amount as agreed.
                                </li>
                            </ul>
                        </div>

                        <div class="card">
                            <form action="../customerAction.php" method="POST" name="booking-form" enctype="multipart/form-data">
                                <div class="card-header">
                                    <h4 class="modal-title">Reservation Details</h4>
                                  </div>
                                  <div class="card-body">
                                      <div class="customer-details">
                                          <div class="row">
                                           
                                            <div class="col-sm-12 col-md-12 margin bottom">
                                                <table class="table">
                                                    <thead>
                                                        <th>Facility</th>
                                                        <th>Date reserved</th>
                                                        <th>Calc(Price × N days)</th>
                                                        <th>Total Price</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php $dateScheds = array(); $facilityIds = []; $total = 0; foreach( $resrvations as $resrvation) : ?>
                                                        <?php
                                                            $total += $resrvation['totalAmout']; 

                                                            $dateScheds[$resrvation['facilityId']] = array(
                                                                'dateIn' => $resrvation['dateIn'],
                                                                'dateOut' => $resrvation['dateOut']
                                                            );
                                                            array_push($facilityIds, $resrvation['facilityId']);
                                                            $dateIn = strtotime($resrvation['dateIn']);
                                                            $dateOut = strtotime($resrvation['dateOut']);
                                                            $dateDiff = $dateOut - $dateIn;
                                                            $daysDiff = round($dateDiff / (60 * 60 * 24)) + 1;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $resrvation['Facility_name'] ?></td>
                                                            <td><?php echo $resrvation['dateIn'] ?> to <?php echo $resrvation['dateOut'] ?></td>
                                                            <td><?php echo number_format($resrvation['Price'], 2) . ' × ' . $daysDiff ?></td>
                                                            <td>₱<?php echo number_format($resrvation['totalAmout'], 2) ?></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                        <tr>
                                                            <td colspan="3" class="text-bold"><b>Total</b></td>
                                                            <td colspan="">₱<?php echo number_format($total, 2) ?></td>
                                                        </tr>
                                                        <input type="hidden" name="reservationId" value="<?php echo $_GET['reservationId']; ?>">
                                                        <?php $serialized = serialize($dateScheds); //echo $serialized; ?>
                                                        <?php // echo serialize($facilityIds); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                      </div>
                                  </div>
                                  <input type="hidden" id="sunmitButtonIndicator" value="customer-details">
                                  <div class="card-footer justify-content-between">
                                    <button type="submit" class="btn btn-secondary" name="action" value="cancelReservation" id="submitBook">Continue Cancelation</button>
                                  </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--================Contact Area =================-->
        
        <!--================ start footer Area  =================-->	
        <?php include 'footer-links.php'; ?>
        
    </body>

    <script>
        $(document).ready(function(){
        })
    </script>
</html>