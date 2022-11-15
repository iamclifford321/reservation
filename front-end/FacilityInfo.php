<style>
    div.facility-info-cover{
        position: fixed;
        z-index: 100;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #0000004d;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .facility-info{
        width: 50%;        
    }
    .facility-info-content{
        width: 100%;
        height: auto;
        background: whitesmoke;
        padding: 30px 18px;
    }
    div.facility-info-header{
        text-align: right
    }
</style>
<?php
    $facility = $controller->getFacilityInfo($_GET['facilityId']);
?>
<div class="facility-info-cover">

    <div class="facility-info">
        <div class="facility-info-header">
            <a href="index.php" class="btn btn-danger"> X</a>
        </div>
        <div class="facility-info-content">
            <div class="content">
                <div class="row">
                    <div class="col-sm-5">
                        <img src="../public/uploads/images/<?php echo $facility['Image']; ?>" alt="" style="width: 100%">
                    </div>
                    <div class="col-sm-7">
                        <h3>Description</h3>
                        <p>
                            <?php echo $facility['description']; ?>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>