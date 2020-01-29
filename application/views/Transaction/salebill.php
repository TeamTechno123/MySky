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
            <h1> Add Sale Bill Entry </h1>
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
                <h3 class="card-title"> Add Sale Bill Entry</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data" role="form" autocomplete="off">
                <div class="card-body row">
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" name="sale_no" id="sale_no" value="<?php if(isset($sale_no)){ echo $sale_no; } ?>" title="Enter Bill No." placeholder="Enter Bill No." readonly required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" name="sale_date" value="<?php if(isset($sale_date)){ echo $sale_date; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" title="Enter Bill Date" placeholder="Enter Bill Date" required>
                  </div>
                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select Customer" name="customer_id" id="customer_id" style="width: 100%;" required>
                      <option selected="selected" value="" >Select Customer</option>
                      <?php foreach ($customer_list as $list) { ?>
                        <option value="<?php echo $list->customer_id; ?>" <?php if(isset($customer_id) && $customer_id == $list->customer_id){ echo 'selected'; } ?>><?php echo $list->customer_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12"> <hr> </div>
                  <div class="form-group col-md-10">
                    <label for="checkbox"></label>
                  </div>
                  <div class="form-group col-md-2">
                      <button type="button"  id="add_row" class="btn btn-sm btn-primary px-4">Add More </button>
                  </div>
                  <table id="myTable" class="table table-bordered mb-4 tbl_cust1">
                    <?php if(isset($sale_descr_list)){
                      $i = 0;
                      $j = 0;
                      foreach ($sale_descr_list as $details) {
                        $j++;
                      ?>
                      <input type="hidden" name="input[<?php echo $i; ?>][sale_descr_id]" value="<?php echo $details->sale_descr_id; ?>">
                      <tr>
                        <td><?php echo $j; ?></td>
                        <td>
                          <input type="text" class="form-control form-control-sm" name="input[<?php echo $i; ?>][sale_description]" value="<?php echo $details->sale_description; ?>" title="Discription" placeholder="Discription">
                        </td>
                        <td>
                          <input type="number" class="form-control form-control-sm sale_descr_amt" name="input[<?php echo $i; ?>][sale_descr_amt]" value="<?php echo $details->sale_descr_amt; ?>" title="Enter Amount" placeholder="Enter Amount">
                        </td>
                        <td><?php if($j > 1){ ?> <a><i class="fa fa-trash text-danger"></i></a> <?php } ?></td>
                      </tr>
                    <?php $i++; }  } else{ ?>

                    <tr>
                      <td>1</td>
                      <td>
                        <input type="text" class="form-control form-control-sm" name="input[0][sale_description]" title="Discription" placeholder="Discription">
                      </td>
                      <td>
                        <input type="number" class="form-control form-control-sm sale_descr_amt" name="input[0][sale_descr_amt]" title="Enter Amount" placeholder="Enter Amount">
                      </td>
                      <td></td>
                    </tr>
                  <?php } ?>

                  </table>
                  <div class="form-group col-md-4 offset-md-8">
                    <input type="text" class="form-control form-control-sm" name="total_amount" id="total_amount" value="<?php if(isset($total_amount)){ echo $total_amount; } ?>" title="Total Amount" placeholder="Total Amount" readonly>
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
  <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
  <script type="text/javascript">



  <?php if(isset($update)){ ?>
  var i = <?php echo $i-1; ?>;
  var j = <?php echo $i; ?>;
<?php } else { ?>
  var i = 0;
  var j = 1;
<?php } ?>

  $('#add_row').click(function(){
    i++;
    j++;
    var row = '<tr>'+
                '<td>'+j+'</td>'+
              '<td>'+
                '<input type="text" class="form-control form-control-sm" name="input['+i+'][sale_description]" value=""  title="Discription" placeholder="Discription">'+
              '</td>'+
              '<td>'+
                '<input type="number" class="form-control form-control-sm sale_descr_amt" name="input['+i+'][sale_descr_amt]"  title="Enter Amount" placeholder="Enter Amount">'+
              '</td>'+
              '<td><a><i class="fa fa-trash text-danger"></i></a></td>'+
            '</tr>';
    $('#myTable').append(row);
    });

    $('#myTable').on('click', 'a', function () {
      $(this).closest('tr').remove();
    });

    $('#myTable').on('change', 'input.sale_descr_amt', function () {
      var sale_descr_amt =   $(this).val();
     if(sale_descr_amt == ''){ sale_descr_amt = 0; }
     var sale_descr_amt = parseInt(sale_descr_amt);

     var total_amount = 0;
     $(".sale_descr_amt").each(function() {
         var sale_descr_amt = $(this).val();
         if(!isNaN(sale_descr_amt) && sale_descr_amt.length != 0) {
             total_amount += parseFloat(sale_descr_amt);
         }
     });
     $('#total_amount').val(total_amount.toFixed(0));
    });
  </script>
</body>
</html>
