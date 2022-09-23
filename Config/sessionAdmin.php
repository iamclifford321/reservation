<?php
     session_start();
     if(!isset($_SESSION['user_data']['User_id'])) header('Location:login.php');