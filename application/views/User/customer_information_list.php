<!DOCTYPE html>
<html>
<?php
  $sky_user_id = $this->session->userdata('sky_user_id');
  $sky_company_id = $this->session->userdata('sky_company_id');
  $sky_roll_id = $this->session->userdata('sky_roll_id');
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 mt-1">
            <h4>View All Customer Information</h4>
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
              <h3 class="card-title"><i class="fa fa-list"></i> List Customer Information</h3>
              <div class="card-tools">
                <?php if($sky_roll_id == 1 || $sky_roll_id == 2){ ?>
                  <a href="<?php echo base_url(); ?>User/customer_information" class="btn btn-sm btn-block btn-primary">Add Customer</a>
                <?php } ?>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="sr_no">Sr. No.</th>
                  <th class="sr_no">Customer Id</th>
                  <th>Customer Name</th>
                  <th>Mobile No.</th>
                  <th>Address</th>
                  <th>Customer Count</th>
                  <th>Created Date</th>
                  <?php if($sky_roll_id == 1 || $sky_roll_id == 2){ ?>
                  <th style="width:80px !important;">Action</th>
                  <?php } ?>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                  foreach ($customer_list as $list) {
                    $i++;
                    $cust_mob = $list->customer_mob1;
                    $user_info = $this->User_Model->get_info_arr('user_mobile', $cust_mob, 'user');

                    $this_user_id = $user_info[0]['user_id'];
                    $customer_ref_list = $this->User_Model->cust_list_by_ref($this_user_id);
                    $j = 0;
                    foreach ($customer_ref_list as $ref_list) {
                      $j++;
                    }
                    ?>
                    <tr>
                      <td class="sr_no"><?php echo $i; ?></td>
                      <td class="sr_no"><?php echo $list->cust_pre_id; ?></td>
                      <td><?php echo $list->customer_name; ?></td>
                      <td><?php echo $list->customer_mob1; ?></td>
                      <td><?php echo $list->customer_address; ?></td>
                      <td><a href="<?php echo base_url(); ?>User/customer_list2/<?php echo $this_user_id; ?>"><?php echo $j; ?><a></td>
                      <td><?php echo date("d-m-Y h:ia", strtotime($list->customer_date)); ?></td>
                      <?php if($sky_roll_id == 1 || $sky_roll_id == 2){ ?>
                        <td style="width:80px !important;">
                          <a target="_blank" href="<?php echo base_url(); ?>Report/customer_details_print/<?php echo $list->customer_id; ?>"> <i class="fa fa-print"></i> </a>
                          <a class="ml-2" href="<?php echo base_url(); ?>User/edit_customer/<?php echo $list->customer_id; ?>"> <i class="fa fa-edit"></i> </a>
                          <a class="ml-2" href="<?php echo base_url(); ?>User/delete_customer/<?php echo $list->customer_id; ?>" onclick="return confirm('Delete this Customer');"> <i class="fa fa-trash"></i> </a>
                        </td>
                      <?php } ?>
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
