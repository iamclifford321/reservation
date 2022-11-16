
<!doctype html>
<?php

    require_once '../Config/Config.php'; 
    require_once '../Model/Model.php'; 
    require_once '../Controller/Controller.php'; 
    $controller = new Controller(); 
    $getTheFacilities = $controller->getTheFicilities();

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
                        <th style="min-width:200px">Facility</th>
                        <th>Status</th>
                        <th></th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </section>
        <!--================Contact Area =================-->
        
        <!--================ start footer Area  =================-->	
        <?php include 'footer-links.php'; ?>
        <?php // include 'footer.php'; ?>
        
    </body>
    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'Cancelled') : ?>
        <script>
            $(document).ready(function(){

                    Swal.fire(
                        'Reservation updated',
                        'Please wait for the admin to approve your request. If the request has been granted, please make sure that you are refunded with the right amount.',
                        'success'
                    );
                
            });
        </script>
    <?php endif; ?>
    <script>
        $(document).ready(function(){
            // alert();
            // $('#bookingModal').modal('show');
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
                    console.log('res', res);
                    var table = $('.res-table').DataTable();
                    table.clear().draw();

                    for (let index = 0; index < res.length; index++) {
                        const element = res[index];
                        var elmnt = `<ul>`;
                        for (const iterator of element.facilities) {
                            elmnt += `<li>
                                        <a href="facilityInfo.php?id=${iterator.facilityId}"><small>${iterator.faclityName} (${iterator.facilityDate})</small></a>
                                     </li>`;
                        }

                        elmnt += `</ul>`;
                        var action = `<a href="makepayment.php?reservationId=${element.reservationId}&customerId=${element.customerID}" class="dropdown-item make-payment">Make Payment</a>`;
                        
                        if(element['status'] == 'Reserved'){
                            action = `<a href="updatePayment.php?reservationId=${element.reservationId}&customerId=${element.customerID}" class="dropdown-item make-payment">Update Payment</a>`;
                        }

                        table.row.add([
                            element['date'],
                            element['customer'],
                            element['numberOfCustomer'],
                            elmnt,
                            element['status'],
                            // `<a href="paymentHistory.php?reservationId=${element.reservationId}&customerId=${element.customerID}" class="btn btn-link">Payment history</a>`
                            
                            `<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a href="paymentHistory.php?reservationId=${element.reservationId}&customerId=${element.customerID}&totalAmountFac=${element.totalAmountFac}" class="dropdown-item make-payment">Payment history</a>
                                        <a href="cancelReservation.php?reservationId=${element.reservationId}&customerId=${element.customerID}" class="dropdown-item cancel-payment">Cancel</a>
                                    </div>
                                </div>
                            </div>`
                        ]).draw();

                    }
                }
            });
            }

        })
    </script>
</html>