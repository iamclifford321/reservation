<?php
session_start();
if(isset($_GET['facilityId'])){
    if(isset($_SESSION['Facilities'])){
        array_push($_SESSION['Facilities'], array(
            'facilityId' => $_GET['facilityId'],
            'facilityName' => $_GET['facilityName'],
            'facilityPrice' => $_GET['facilityPrice']
        ));
    }else{
        $_SESSION['Facilities'] = [
            array(
                'facilityId' => $_GET['facilityId'],
                'facilityName' => $_GET['facilityName'],
                'facilityPrice' => $_GET['facilityPrice']
            )
        ];
    }

}
echo '<pre>';
print_r($_SESSION['Facilities']);
die();