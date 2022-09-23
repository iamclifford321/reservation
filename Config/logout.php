<?php
session_start();
session_destroy();
$location = 'LOCATION:../front-end/index.php';
if(isset($_GET['isAdmin'])) $location = 'LOCATION:../login.php';
header($location);