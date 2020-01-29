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
          <div class="col-sm-12 mt-1">
            <h4>Vehicle Information</h4>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>



    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-list"></i>Vehicle Information</h3>
              <div class="card-tools">
                <a href="<?php echo base_url(); ?>User/vehicle_registration" class="btn btn-sm btn-block btn-primary">Add Vehicle</a>
              </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="sr_no">Sr. No.</th>
                  <th class="sr_no">Sponser id</th>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Vehicle</th>
                  <th class="sr_no">Amount</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                  <?php $i = 0;
                  foreach ($vehicle_list as $list) {
                    $i++; ?>
                    <tr>
                      <td class="sr_no"><?php echo $i; ?></td>
                      <td class="sr_no"><?php echo $list->sponser_id; ?></td>
                      <td><?php echo $list->full_name; ?></td>
                      <td><?php echo $list->mobile_no; ?></td>
                      <td><?php echo $list->vehicle_name; ?></td>
                      <td class="sr_no"><?php echo $list->amount; ?></td>
                      <td>
                        <a href="<?php echo base_url(); ?>User/edit_vehicle/<?php echo $list->vehicle_reg_id; ?>"> <i class="fa fa-edit"></i> </a>
                        <a href="<?php echo base_url(); ?>User/delete_vehicle/<?php echo $list->vehicle_reg_id; ?>" onclick="return confirm('Delete this Vehicle');" class="ml-4"> <i class="fa fa-trash"></i> </a>
                      </td>
                    </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
  <script type="text/javascript">
  <?php if($this->session->flashdata('save_success')){ ?>
    $(document).ready(function(){
      toastr.success('Saved successfully');
    });
  <?php } ?>
  <?php if($this->session->flashdata('update_success')){ ?>
    $(document).ready(function(){
      toastr.info('Updated successfully');
    });
  <?php } ?>
  <?php if($this->session->flashdata('delete_success')){ ?>
    $(document).ready(function(){
      toastr.error('Deleted successfully');
    });
  <?php } ?>
  </script>
</body>
</html>
