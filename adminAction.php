<?php
    session_start();
    if(!isset($_POST['action'])) die('<h1> Opps.. </h1>');
    require_once 'loader.php';
    $controller = new Controller();
    
    if($_POST['action'] == 'create-customer'){
        $rtrn = $controller->insertCustomer();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'get-customer'){
        $rtrn = $controller->getCustomer();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'getSpecificCustomer'){
        $rtrn = $controller->getSpecificCustomer();
        echo json_encode($rtrn);
    }
    if($_POST['action']=='updateCustomer'){
        $rtrn = $controller->updateCustomer();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'create-user'){
        $rtrn = $controller->insertUser();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'get-user'){
        $rtrn = $controller->getUser();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'getSpecificUser'){
        $rtrn = $controller->getSpecificUser();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'update-user'){
        $rtrn = $controller->updateUser();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'delete-user'){
        $rtrn = $controller->deletetUser();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'create-facility'){
        $rtrn = $controller->insertFacility();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'get-facility'){
        $rtrn = $controller->getFacility();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'getSpecificFacility'){
        $rtrn = $controller->getSpecificFacility();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'update-facility'){
        $rtrn = $controller->updateFacility();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'delete-facility'){
        $rtrn = $controller->deletetFacility();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'create-reservation'){
        $rtrn = $controller->insertReservation();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'get-reservation'){
        $rtrn = $controller->getReservation();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'create-payment'){
        $rtrn = $controller->insertPayment();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'get-payment'){
        $rtrn = $controller->getPayment();
        echo json_encode($rtrn);
    }
    if($_POST['action'] == 'login'){
        $rtrn = $controller->login();
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
    if($_POST['action'] == 'makePayment'){

        $rtrn = $controller->makePaymentManual();
        header("Location:" . $_SERVER['HTTP_REFERER'] . "&message=Payment added!");
    }

    if($_POST['action'] == 'makeRefund'){

        $rtrn = $controller->makeRefund();
        header("Location:adminIndex.php?page=reservations&message=Payment added!");
        
    }

    if($_POST['action'] == 'activate-facility'){
        $rtrn = $controller->activateFacility();
        echo json_encode($rtrn);
    }

    