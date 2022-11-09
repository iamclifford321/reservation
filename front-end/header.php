<header class="header_area">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="index.php">G-EM'S POOL PARK</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li> 
                    <li class="nav-item"><a class="nav-link" href="about.php">About us</a></li>
                    <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li> -->

                    <?php if(isset($_SESSION['Facilities']) && count($_SESSION['Facilities']) > 0) : ?>
                        <li class="nav-item"><a class="nav-link" href="bookfacilities.php">Facilities <span class="badge badge-danger"><?php echo count($_SESSION['Facilities']); ?></span></a></li>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['user_data']['customer_id'])) : ?>
                    <li class="nav-item"><a class="nav-link" href="reserved.php">Reserved</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Config/logout.php">Sign out</a></li>
                    <?php else : ?>
                    <li class="nav-item"><a class="nav-link" href="login.php" >Sign In</a></li>
                    <?php endif;?>
                </ul>
            </div> 
        </nav>
    </div>
</header>
<style type="text/css">

</style>

