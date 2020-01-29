<!DOCTYPE html>
<html>
<?php
  $page = "customer_information";
?>
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
          <div class="col-sm-12 text-center mt-2">
            <h1>Customer Information</h1>
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
                <h3 class="card-title">Customer Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php //echo $sky_roll_id; ?>
                <form action="" method="post" enctype="multipart/form-data" role="form">
                <div class="card-body row">
                  <div class="form-group col-md-12 select-sm">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select Reference User" name="user_id" id="user_id"  style="width: 100%;" required>
                      <?php if($sky_roll_id == 1 || $sky_roll_id == 2){ ?>
                      <option selected="selected" value="" >Select Reference User</option>
                      <?php foreach ($user_list as $list) { ?>
                        <option value="<?php echo $list->user_id; ?>" <?php if(isset($user_id) && $user_id == $list->user_id){ echo 'selected'; } ?>><?php echo $list->user_name; ?></option>
                      <?php } ?>
                    <?php } else{
                      $user_info = $this->User_Model->get_info_arr('user_id', $sky_user_id, 'user');
                    ?>
                    <option selected="selected" value="<?php echo $user_info[0]['user_id']; ?>" ><?php echo $user_info[0]['user_name']; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12 select-sm">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select Type Of Customer " name="customer_type_id" id="customer_type_id" style="width: 100%;" required>
                        <option selected="selected" value="" >Select Type Of Customer</option>
                        <?php foreach ($type_list as $list) { ?>
                          <option value="<?php echo $list->customer_type_id; ?>" <?php if(isset($customer_type_id) && $customer_type_id == $list->customer_type_id){ echo 'selected'; } ?>><?php echo $list->type_name; ?></option>
                        <?php } ?>
                      </select>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control form-control-sm" name="customer_name" id="customer_name" value="<?php if(isset($customer_name)){ echo $customer_name; } ?>" placeholder="Enter Customer Name" required>
                  </div>
                  <div class="form-group col-md-12">
                    <textarea class="form-control form-control-sm" rows="3" name="customer_address" id="customer_address" placeholder="Enter Customer Address" required><?php if(isset($customer_address)){ echo $customer_address; } ?></textarea>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control form-control-sm" name="customer_mob1" id="customer_mob1" value="<?php if(isset($customer_mob1)){ echo $customer_mob1; } ?>" placeholder="Mobile No. 1" required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control form-control-sm" name="customer_mob2" id="customer_mob2" value="<?php if(isset($customer_mob2)){ echo $customer_mob2; } ?>" placeholder="Mobile No. 2">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" name="customer_city" id="customer_city" value="<?php if(isset($customer_city)){ echo $customer_city; } ?>" placeholder="City">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" name="customer_state" id="customer_state" value="<?php if(isset($customer_state)){ echo $customer_state; } ?>" placeholder="State">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" name="customer_adhar_no" id="customer_adhar_no" value="<?php if(isset($customer_adhar_no)){ echo $customer_adhar_no; } ?>" placeholder="Adhar  No.">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" name="customer_pan_no" id="customer_pan_no" value="<?php if(isset($customer_pan_no)){ echo $customer_pan_no; } ?>" placeholder="Pan No.">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" name="customer_bank" id="customer_bank" value="<?php if(isset($customer_bank)){ echo $customer_bank; } ?>" placeholder="Bank Name">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" name="customer_b_branch" id="customer_b_branch" value="<?php if(isset($customer_b_branch)){ echo $customer_b_branch; } ?>" placeholder="Branch Name">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" name="customer_acc_no" id="customer_acc_no" value="<?php if(isset($customer_acc_no)){ echo $customer_acc_no; } ?>" placeholder="Account No. ">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" name="customer_b_ifsc" id="customer_b_ifsc" value="<?php if(isset($customer_b_ifsc)){ echo $customer_b_ifsc; } ?>" placeholder="IFSC Code">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="password" class="form-control form-control-sm" name="customer_password" id="customer_password" value="<?php if(isset($customer_password)){ echo $customer_password; } ?>" placeholder="Password" required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="file" class="form-control form-control-sm" name="customer_img" id="customer_img"  placeholder="Customer Image">
                  </div>
                  <div class="form-group col-md-12">
                    <div class="form-check">
                      <input type="checkbox" name="customer_status" <?php if(isset($customer_status)&& $customer_status == 'deactivate') { echo 'checked'; } ?> value="deactivate" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label"  for="exampleCheck1">Disable This Customer Acount</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <?php if(isset($update)){ ?>
                    <input type="hidden" name="old_cust_img" value="<?php if(isset($customer_img)){ echo $customer_img; } ?>">
                    <button type="submit" class="btn btn-primary">Update Customer </button>
                  <?php }else{ ?>
                    <button type="submit" class="btn btn-success">Create Customer </button>
                  <?php } ?>
                  <a href="<?php echo base_url(); ?>/User/customer_information_list" class="btn btn-default ml-4">Cancel</a>
                </div>
              </form>
            </div>
          </div>

        </div>

      </div><!-- /.container-fluid -->
    </section>
  </div>
  <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
  <script type="text/javascript">
    var customer_mob = $('#mobile').val();
    $('#customer_mob1').on('change',function(){
      var customer_mob1 = $(this).val();
      $.ajax({
        url:'<?php echo base_url(); ?>User/check_duplication',
        type: 'POST',
        data: {"column_name":"user_mobile",
               "column_val":customer_mob1,
               "table_name":"user"},
        context: this,
        success: function(result){
          if(result > 0){
            $('#customer_mob1').val(customer_mob);
            toastr.error(customer_mob1+' Mobile No Exist.');
          }
        }
      });
    });
  </script>
</body>
</html>
