<?php 
    	require_once 'Config/Config.php';
        require_once 'Model/Model.php';
        require_once 'Controller/Controller.php';
        $controller = new Controller(); 
        $approve = $controller->approveReservation($_GET['reservationId']);

?>
<script>
    window.location.href = 'adminIndex.php?page=reservations'
</script>