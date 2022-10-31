<?php

session_start();
if(isset($_GET['facilityId'])){
    $dateIn = strtotime($_GET['fromDate']);
    $dateOut = strtotime($_GET['toDate']);
    $dateDiff = $dateOut - $dateIn;
    
    $daysDiff = round($dateDiff / (60 * 60 * 24)) + 1;
    $totalAmount = $daysDiff * $_GET['facilityPrice'];
    
    if(isset($_SESSION['Facilities'])){
        array_push($_SESSION['Facilities'], array(
            'facilityId' => $_GET['facilityId'],
            'facilityName' => $_GET['facilityName'],
            'facilityPrice' => $_GET['facilityPrice'],
            'description' => $_GET['facilityDescription'],
            'faclityImg' => $_GET['faclityImg'],
            'dateFrom' => $_GET['fromDate'],
            'dateTo' => $_GET['toDate'],
            'totalAmount' => $totalAmount
        ));
    }else{
        $_SESSION['Facilities'] = [
            array(
                'facilityId' => $_GET['facilityId'],
                'facilityName' => $_GET['facilityName'],
                'facilityPrice' => $_GET['facilityPrice'],
                'description' => $_GET['facilityDescription'],
                'faclityImg' => $_GET['faclityImg'],
                'dateFrom' => $_GET['fromDate'],
                'dateTo' => $_GET['toDate'],
                'totalAmount' => $totalAmount
            )
        ];
    }

}
// session_destroy();

// echo '<pre>';
// print_r($_SESSION['Facilities']);
header('location:index.php#reservation-section');