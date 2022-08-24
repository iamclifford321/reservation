<?php
    session_start();
    if(!isset($_POST['action'])) die('<h1> Opps.. </h1>');
    require_once 'loader.php';
    $controller = new Controller();
    if($_POST['action'] == 'reserve'){
        $rtrn = $controller->frontEndReserve();
        if($rtrn['status'] == 'success'){
            if(isset($_SESSION['user_data'])){
                $rtrn['userId'] = $_SESSION['user_data']['User_id'];
            }
            echo json_encode($rtrn);
        }else{
            echo json_encode(
                array(
                    'status' => 'error',
                    'message' => 'error occured please contact the admin'
                )
            );
        }
    }