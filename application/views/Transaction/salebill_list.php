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
            <h4>VIEW ALL SALE BILL INFORMATION</h4>
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
              <h3 class="card-title"><i class="fa fa-list"></i> List Sale Bill Information</h3>
              <div class="card-tools">
                <a href="<?php echo base_url(); ?>Transaction/salebill" class="btn btn-sm btn-block btn-primary">Add Bill</a>
              </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="sr_no">Sr. No.</th>
                  <th>Sale Bill No.</th>
                  <th>Date</th>
                  <th>Customer</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                  <?php $i = 0;
                  foreach ($salebill_list as $list) {
                    $customer_id = $list->customer_id;
                    $cust_info = $this->User_Model->get_info_arr('customer_id', $customer_id, 'customer');
                    $i++; ?>
                    <tr>
                      <td class="sr_no"><?php echo $i; ?></td>
                      <td><?php echo $list->sale_no; ?></td>
                      <td><?php echo $list->sale_date; ?></td>
                      <td><?php echo $cust_info[0]['customer_name']; ?></td>
                      <td>&#8377; <?php echo $list->total_amount; ?></td>
                      <td>
                        <a target="_blank" href="<?php echo base_url(); ?>Report/invoice_report/<?php echo $list->sale_id; ?>"> <i class="fa fa-print"></i> </a>
                        <a class="ml-2" href="<?php echo base_url(); ?>Transaction/edit_salebill/<?php echo $list->sale_id; ?>"> <i class="fa fa-edit"></i> </a>
                        <a class="ml-2" href="<?php echo base_url(); ?>Transaction/delete_salebill/<?php echo $list->sale_id; ?>" onclick="return confirm('Delete this Sale');"> <i class="fa fa-trash"></i> </a>
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
