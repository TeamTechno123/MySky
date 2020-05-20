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
            <h1>Customer Target Report </h1>
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
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"> Customer Target Report</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data" role="form" autocomplete="off">
                <div class="card-body row">
                  <div class="form-group col-md-3">
                    <input type="text" class="form-control form-control-sm" name="from_date" id="date1" data-target="#date1" data-toggle="datetimepicker" placeholder="From Date" required>
                  </div>
                  <div class="form-group col-md-3">
                    <input type="text" class="form-control form-control-sm" name="to_date" id="date2" data-target="#date2" data-toggle="datetimepicker" placeholder="To Date" required>
                  </div>
                  <div class="form-group col-md-3">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select Customer Type" name="customer_type_id" id="customer_type_id" style="width: 100%;" >
                      <option selected="selected" value="" >Select Customer Type</option>
                      <?php foreach ($type_list as $list) { ?>
                        <option value="<?php echo $list->customer_type_id; ?>" <?php if(isset($customer_type_id) && $customer_type_id == $list->customer_type_id){ echo 'selected'; } ?>><?php echo $list->type_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-sm btn-primary px-4">View Report </button>
                  </div>
                </div>
              </form>

              <?php
              //print_r($customer_list);
              if(isset($customer_list)){ ?>
              <div class="card-body" >
                <section style="width:100%;" class="invoice" id="print_cust">
                    <div class="row">
                      <div class="col-12 table-responsive" id="result_tbl">
                        <table class="table table-botttom" id="exp_tbl"  width="100%">
                          <style media="print">
                          #result_tbl table {
                            border-collapse: collapse!important;
                            Width:100%!important;
                          }
                          #result_tbl table, #result_tbl tr, #result_tbl td, #result_tbl th{
                            border: 1px solid #000;
                            margin-left: auto;
                            margin-right: auto;
                            padding: 5px;
                          }

                        </style>
                        <style media="screen">
                          #result_tbl table {
                            border-collapse: collapse!important;
                            Width:100%!important;
                            margin-bottom: 0px!important;
                          }
                          #result_tbl .table thead th{
                              border: 1px solid #000;
                          }
                          #result_tbl table, #result_tbl tr, #result_tbl td, #result_tbl th{
                            border: 1px solid #000;
                            margin-left: auto;
                            margin-right: auto;
                            padding: 5px;
                            text-align: center;
                          }
                        </style>
                        <thead>
                          <th class="sr_no">Sr. No.</th>
                          <th class="sr_no">Customer Id</th>
                          <th><p style="text-align:center">Customer Name</p></th>
                          <th><p style="text-align:center">Customer City</p></th>
                          <th><p style="text-align:center">Customer Mobile No.</p></th>
                          <th><p style="text-align:center">Customer Added On</p></th>
                          <th><p style="text-align:center">Total Members</p></th>
                          <th><p style="text-align:center">Status</p></th>
                        </thead>
                        <tbody>
                          <?php $i=0;
                          foreach($customer_list as $list){
                            $this_user_id = $list->this_user_id;
                            $customer_ref_list = $this->User_Model->cust_list_by_ref($this_user_id);
                            $j = 0;
                            foreach ($customer_ref_list as $ref_list) {
                              $j++;
                            }
                            $i++;
                            if($j >= $list->no_of_members){
                          ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $list->customer_id; ?></td>
                            <td><?php echo $list->customer_name; ?></td>
                            <td><?php echo $list->customer_city; ?></td>
                            <td><?php echo $list->customer_mob1; ?></td>
                            <td><?php echo date("d-m-Y h:ia", strtotime($list->customer_date)); ?></td>
                            <td><?php echo $j; ?></td>
                            <td><?php echo $list->customer_status; ?></td>
                          </tr>
                        <?php } } ?>
                        </tbody>
                      </table>
                        <!-- /.row -->
                      <br><br>
                      <!-- this row will not appear when printing -->
                  </div>
              <!-- /.card-body -->
                </div>
              </section>
              <div class="row no-print">
                <div class="col-12">
                  <br><br>
                  <a onclick='printDiv();' class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <input type="button" name="export" id="export_excel" onclick="Export()" class="btn btn-primary" value="Export to Excel">
                </div>
              </div>
            </div>
          <?php } ?>

            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->
  <script src="<?php echo base_url(); ?>assets/js/table2excel.js"></script>
  <script type="text/javascript">
  // SRM Select if Roll RM...
  $('#roll_id').on('change',function(){
    var roll_id = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Report/get_user_by_roll',
      type:'POST',
      data:{'roll_id':roll_id},
      context:this,
      success: function(result){
        $('#user_id').html(result);
      }
    });
  });


    function printDiv(){
      var divToPrint=document.getElementById('print_cust');
      var newWin=window.open('','Print-Window');
      newWin.document.open();
      newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
      newWin.document.close();
      setTimeout(function(){newWin.close();},10);
    }

    function Export() {
      var today = new Date();
      var time =  today.getTime();
      $("#exp_tbl").table2excel({
        filename: "Customer_Report_"+time+".xls"
      });
    }
  </script>
</body>
</html>
