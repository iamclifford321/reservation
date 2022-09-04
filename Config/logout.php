<?php
session_start();
session_destroy();
header('LOCATION:../front-end/index.php');