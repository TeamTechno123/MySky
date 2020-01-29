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
            <h1> Vehicle Registration </h1>
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
                <h3 class="card-title"> Add Vehicle Registration</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data" role="form" autocomplete="off">
                <div class="card-body row">
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control form-control-sm" name="sponser_id" id="sponser_id" value="<?php if(isset($sponser_id)){ echo $sponser_id;} ?>" placeholder="Enter Sponser id" title="Sponser id" required>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control form-control-sm" name="full_name" id="full_name" value="<?php if(isset($full_name)){ echo $full_name;} ?>" placeholder="Enter Full Name" title="Full Name" required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control form-control-sm" name="mobile_no" id="mobile_no" value="<?php if(isset($mobile_no)){ echo $mobile_no;} ?>" placeholder="Enter Mobile No." title="Mobile No" required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="email" class="form-control form-control-sm" name="email" id="email" value="<?php if(isset($email)){ echo $email;} ?>" placeholder="Enter Email" title="Email">
                  </div>
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control form-control-sm" name="address" id="address" value="<?php if(isset($address)){ echo $address;} ?>" placeholder="Enter Address" title="Address" required>
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control form-control-sm" name="city" id="city" value="<?php if(isset($city)){ echo $city;} ?>" placeholder="Enter City" title="City">
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control form-control-sm" name="state" id="state" value="<?php if(isset($state)){ echo $state;} ?>" placeholder="Enter State" title="State">
                  </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control form-control-sm" name="country" id="country" value="<?php if(isset($country)){ echo $country;} ?>" placeholder="Enter Country" title="Country">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="number" class="form-control form-control-sm" name="amount" id="amount" value="<?php if(isset($amount)){ echo $amount;} ?>" placeholder="Enter Amount" title="Amount">
                    </div>
                    <div class="form-group col-md-4">
                      <select class="form-control select2 form-control-sm" data-placeholder="Select Payment Type" name="payment_type" id="payment_type" title="Transaction Type">
                        <option selected value="">Select Payment Type</option>
                        <option <?php if(isset($payment_type) && $payment_type == 'Cash'){ echo 'selected'; } ?>>Cash</option>
                        <option <?php if(isset($payment_type) && $payment_type == 'Cheque'){ echo 'selected'; } ?>>Cheque</option>
                        <option <?php if(isset($payment_type) && $payment_type == 'Online Transfer'){ echo 'selected'; } ?>>Online Transfer</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control form-control-sm" name="transaction_no" id="transaction_no" value="<?php if(isset($transaction_no)){ echo $transaction_no;} ?>" placeholder="Enter Transaction No. If Online" title="Transaction No">
                    </div>
                    <div class="form-group col-md-6">
                      <select class="form-control select2 form-control-sm" data-placeholder="Select Vehicle" name="vehicle_name" id="vehicle_name" value="<?php if(isset($vehicle_name)){ echo $vehicle_name;} ?>"  title="Vehicle" required>
                        <option selected value="">Select Vehicle</option>
                        <option <?php if(isset($vehicle_name) && $vehicle_name == 'Activa'){ echo 'selected'; } ?>>Activa</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <input type="file" class="form-control form-control-sm" name="vehicle_image" id="vehicle_image" title="Vehicle Image">
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
