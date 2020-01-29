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
            <h1> Change Password </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8 offset-md-2">
            <!-- general form elements -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"> Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data" role="form" autocomplete="off">
                <div class="card-body row">
                  <div class="form-group col-md-12">
                    <input type="password" class="form-control form-control-sm" name="user_password" id="user_password" value="<?php if(isset($user_password)){ echo $user_password; } ?>" title="Enter News Information" placeholder="Enter News Information" required>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="password" class="form-control form-control-sm" name="user_c_password" id="user_c_password" value="<?php if(isset($user_password)){ echo $user_password; } ?>" title="Enter News Information" placeholder="Enter News Information" required>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="col-md-4 offset-md-4">
                    <button type="submit" class="btn btn-primary">Update</button>
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
