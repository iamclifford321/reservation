<?php

session_start();
if(isset($_GET['facilityId'])){
    if(isset($_SESSION['Facilities'])){
        array_push($_SESSION['Facilities'], array(
            'facilityId' => $_GET['facilityId'],
            'facilityName' => $_GET['facilityName'],
            'facilityPrice' => $_GET['facilityPrice'],
            'description' => $_GET['facilityDescription'],
            'dateFrom' => $_GET['fromDate'],
            'dateTo' => $_GET['toDate']
        ));
    }else{
        $_SESSION['Facilities'] = [
            array(
                'facilityId' => $_GET['facilityId'],
                'facilityName' => $_GET['facilityName'],
                'facilityPrice' => $_GET['facilityPrice'],
                'description' => $_GET['facilityDescription'],
                'dateFrom' => $_GET['fromDate'],
                'dateTo' => $_GET['toDate']
            )
        ];
    }

}
// session_destroy();

// echo '<pre>';
// print_r($_SESSION['Facilities']);
header('location:index.php#reservation-section');