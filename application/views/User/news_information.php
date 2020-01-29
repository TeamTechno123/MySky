<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-center mt-2">
            <h1> News Information </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-10 offset-md-1">
            <!-- general form elements -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"> Add News Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data" role="form" autocomplete="off">
                <div class="card-body row">
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control form-control-sm" name="news_name" id="news_name" value="<?php if(isset($news_name)){ echo $news_name; } ?>" title="Enter News Information" placeholder="Enter News Information" required>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="col-md-4 offset-md-4">
                    <?php if(isset($update)){ ?>
                      <button type="submit" class="btn btn-primary">Update</button>
                    <?php }else{ ?>
                      <button type="submit" class="btn btn-success">Add</button>
                    <?php } ?>
                    <a href="<?php echo base_url(); ?>/User/dashboard" class="btn btn-default ml-4">Cancel</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->

</body>
</html>
