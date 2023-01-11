<?php
    require_once 'vendor/autoload.php';
    use Twilio\Rest\Client;
    session_start();
    if(!isset($_POST['action'])) die('<h1> Opps.. </h1>');
    require_once 'loader.php';
    $controller = new Controller();
    if($_POST['action'] == 'registerCustomer'){
        $rtrn = $controller->customerReg();
        if($rtrn['status'] == 'success'){
            
            $locationHeader = 'location:front-end/index.php';
            if(isset($_SESSION['user_data']['resrvId']) ){
                $locationHeader = 'location:front-end/makePayment.php?reservationId=' . $_SESSION['user_data']['resrvId'] . '&customerId=' . $_SESSION['user_data']['customer_id'] . '';
            }
            header($locationHeader);
        }else{
            echo json_encode(
                array(
                    'status' => 'error',
                    'message' => 'error occured please contact the admin'
                )
            );
        }
    }
    if($_POST['action'] == 'login'){
        $rtrn = $controller->loginCustomer();
        if($rtrn){

            $_SESSION['user_data'] = $rtrn;
            echo json_encode($_SESSION['user_data']);

        }else{
            echo json_encode(array(
                'status' => 'invalid',
                'msg' => 'Invalid credentials',

            ));
        }
        
    }
    if($_POST['action'] == 'create-user'){
        $rtrn = $controller->updateFromCUstomer();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'getReservationFrontEnd'){
        $rtrn = $controller->getReservationSpecific($_SESSION['user_data']['customer_id']);
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'submitBookLoggedIn'){
        $rtrn = $controller->submitBookLoggedIn();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'getFacilityReservation'){
        $rtrn = $controller->getFacilityReservation();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'submitReservation'){
        $rtrn = $controller->submitReservation();
        echo json_encode($rtrn);
    }

    if($_POST['action'] == 'makePayment'){
        $rtrn = $controller->makePayment();

        $sid = "ACb6b586f5528e9ec1ff5249412c9f18b5";
        $token = "849e1d62d4a037a1534422beda596c42";
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
                        ->create("+639708712705", // to
                                ["body" => "A reservation payment worth PHP" . number_Format($_POST['payment-amount'], 2) . " for reservation number " . $_POST['resId'] . " has been paid.", "from" => "+12535288255"]
                        );

        header('Location:front-end/reserved.php');
    }
    if($_POST['action'] == 'getTheResInDate'){
        $rtrn = $controller->getTheResInDate();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'cancelReservation'){
        $rtrn = $controller->cancelReservation();
        $sid = "ACb6b586f5528e9ec1ff5249412c9f18b5";
        $token = "849e1d62d4a037a1534422beda596c42";
        $twilio = new Client($sid, $token);
        
        $message = $twilio->messages
                        ->create("+639708712705", // to
                                ["body" => "The reservation number " . $_POST['reservationId'] . " has been cancelled", "from" => "+12535288255"]
                        );

        echo json_encode($rtrn);
        header('location:front-end/reserved.php?msg=Cancelled');
    }