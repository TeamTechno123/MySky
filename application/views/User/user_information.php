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
            <h1>User Information</h1>
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
                <h3 class="card-title">User Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="form_action" role="form" action="" method="post">
                <div class="card-body row">
                  <div class="form-group col-md-12 select-sm">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select Role Name " name="roll_id" id="roll_id" style="width: 100%;" required>
                      <option selected="selected" value="" >Select Role Name</option>
                      <?php foreach ($roll_list as $list) { ?>
                        <option value="<?php echo $list->roll_id; ?>" <?php if(isset($roll_id) && $roll_id == $list->roll_id){ echo 'selected'; } ?>><?php echo $list->roll_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12 select-sm" id="srm_div" style="display:none;">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select SRM" name="srm_id" id="srm_id">
                      <option selected="selected" value="" >Select SRM</option>
                      <?php foreach ($srm_list as $list) { ?>
                        <option value="<?php echo $list->user_id; ?>" <?php if(isset($srm_id) && $srm_id == $list->user_id){ echo 'selected'; } ?>><?php echo $list->user_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12 select-sm" id="rm_div" style="display:none;">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select RM" name="rm_id" id="rm_id">
                      <option selected="selected" value="" >Select RM</option>
                      <?php foreach ($rm_list as $list) { ?>
                        <option value="<?php echo $list->user_id; ?>" <?php if(isset($srm_id) && $srm_id == $list->user_id){ echo 'selected'; } ?>><?php echo $list->user_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control form-control-sm required title-case text" name="user_name" id="user_name" value="<?php if(isset($user_name)){ echo $user_name; } ?>" placeholder="Enter Name of User" required>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control form-control-sm" name="user_city" id="user_city" value="<?php if(isset($user_city)){ echo $user_city; } ?>" placeholder="Enter City" required>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="number" class="form-control form-control-sm required mobile" name="user_mobile" id="user_mobile" value="<?php if(isset($user_mobile)){ echo $user_mobile; } ?>" placeholder="Enter Mobile No." required>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="email" class="form-control form-control-sm email" name="user_email" id="user_email" value="<?php if(isset($user_email)){ echo $user_email; } ?>" placeholder="Enter Email" required>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="password" class="form-control form-control-sm" name="user_password" id="user_password" value="<?php if(isset($user_password)){ echo $user_password; } ?>" placeholder="Enter Password" required>
                  </div>
                  <div class="form-group col-md-12">
                    <div class="form-check">
                      <input type="checkbox" name="user_status" <?php if(isset($user_status) && $user_status == 'deactivate') { echo 'checked'; } ?> value="deactivate" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label"  for="exampleCheck1">Disable This User</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <?php if(isset($update)){ ?>
                    <button id="btn_update" type="submit" class="btn btn-primary">Update </button>
                  <?php } else{ ?>
                    <button id="btn_save" type="submit" class="btn btn-success px-4">Add</button>
                  <?php } ?>
                  <a href="<?php echo base_url() ?>User/dashboard" class="btn btn-default ml-4">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">
// Check Mobile Duplication...
  var user_mobile1 = $('#mobile').val();
  $('#user_mobile').on('change',function(){
    var user_mobile = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>User/check_duplication',
      type: 'POST',
      data: {"column_name":"user_mobile",
             "column_val":user_mobile,
             "table_name":"user"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#user_mobile').val(user_mobile1);
          toastr.error(user_mobile+' Mobile No Exist.');
        }
      }
    });
  });

  // SRM Select if Roll RM...
  $('#roll_id').on('change',function(){
    var roll_id = $(this).val();
    if(roll_id == 4){
      $('#srm_div').css('display','block');
      $('#srm_id').attr('required',true);
    } else{
      $('#srm_div').css('display','none');
    }

    if(roll_id == 6){
      $('#rm_div').css('display','block');
      $('#rm_id').attr('required',true);
    } else{
      $('#rm_div').css('display','none');
    }
  });

  $(document).ready(function(){
    var roll_id = $('#roll_id').val();
    if(roll_id == 4){
      $('#srm_div').css('display','block');
    }
    if(roll_id == 6){
      $('#rm_div').css('display','block');
    }
    // alert(roll_id);
  });
</script>



</body>
</html>
