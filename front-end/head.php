<?php
        session_start();
        // echo "<pre>";
        // print_r( $_SESSION['user_data'] );
        // die();
?>
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="session" content="<?php echo (isset($_SESSION['user_data']['customer_id'])) ? $_SESSION['user_data']['customer_id']: ''; ?>">
        <link rel="icon" href="image/favicon.png" type="image/png">
        <title>G-EM'S POOL PARK</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <!-- main css -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
        <!-- Datepicker -->
         <link rel="stylesheet" href="../public/assets/plugins/datepicker/jquery-ui.css">
         <!-- SweetAlert2 -->
         <!-- SweetAlert2 -->
         
        <link rel="stylesheet" href="../public/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <script src="../public/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="../public/assets/plugins/daterangepicker/daterangepicker.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="../public/assets/plugins/fontawesome-free/css/all.min.css">

        <!-- Full calendar -->
        <link rel="stylesheet" href="../public/assets/plugins/fullcalendar/main.css">
        <script src="../public/assets/plugins/fullcalendar/main.js"></script>
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
</head>