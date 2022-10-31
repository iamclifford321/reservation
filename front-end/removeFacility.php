<?php
if(!isset($_GET['key'])) header('Location:index.php');
session_start();
unset($_SESSION['Facilities'][$_GET['key']]);
header('location:bookfacilities.php');