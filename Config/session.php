<?php
     session_start();
     if(!isset($_SESSION['user_data']['customer_id'])) header('Location:login.php');