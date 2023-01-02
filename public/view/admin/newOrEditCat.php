<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">


        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">

        <!-- Main content here -->



        <!-- /.Main content here -->

    </div>
</section>

<!-- Default Modal-->

<div class="modal fade" id="modal-new-customer" style="display:block; opacity: 1; background: rgba(0,0,0,.5);">
    <div class="modal-dialog" style="display:block; margin-top: 150px;">
      <form action="adminAction.php" method="POST">
        <div class="modal-content" style="display:block">

            <div class="modal-header">
              <h4 class="modal-title"><?php echo ucfirst($_GET['action']); ?></h4>
              <a href="?page=categories">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </a>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="">Name</label>
                <input type="hidden" name="id" value="<?php echo (isset($_GET['id'])) ? $_GET['id'] : ''; ?>">
                <input type="hidden" value="<?php echo $_GET['action']; ?>" name="action">
                <input type="text" class="form-control" name="name" value="<?php echo (isset($_GET['name'])) ? $_GET['name'] : ''; ?>" required="true">
              </div>
            </div>
            <div class="modal-footer justify-content-between">
                <a href="?page=categories">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </a>
                <button type="submit" class="btn btn-primary" value="categryActions">Save</button>
            </div>
          </div>
      </form>
      
 


      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.Default Modal -->


<script>

// Some Script Here!

</script>