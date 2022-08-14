 <?php
    if(isset($_GET['isAdmin'])){
        header('location:adminIndex.php?page=dashboard');
    }else{
        header('location:front-end');
    }

    # Nothing to see Here!
    #
    #