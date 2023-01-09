<?php
    require_once 'Config/Config.php';
	require_once 'Model/Model.php';
	require_once 'Controller/Controller.php';
	$controller = new Controller();
    $cats = $controller->getCategories();
    $categories = $cats['data']->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r($categories);
    // die();
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Categories</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Categories</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">

        <!-- Main content here -->
        
        <div class="card">
        <div class="card-header">
                <a class="btn btn-primary" href="?page=newOrEditCat&action=Create Category">New Category</a>
            </div>
            <table class="table">
                <thead>
                    <th>Id</th>
                    <th>Category Name</th>
                </thead>
                <tbody>
                    <?php foreach ($categories as $key => $categry) {?>
                    <tr>
                        <td><?php echo $categry['categoryId']; ?></td>
                        <td><a href="?page=newOrEditCat&action=Edit Category&name=<?php echo $categry['Name']; ?>&id=<?php echo $categry['categoryId']; ?>"><?php echo $categry['Name'] ?></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


        <!-- /.Main content here -->

    </div>
</section>

<!-- Default Modal-->

<div class="modal fade" id="modal-new-customer">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Default Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>One fine body&hellip;</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.Default Modal -->


<script>

// Some Script Here!

</script>