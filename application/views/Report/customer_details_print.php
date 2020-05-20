<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Receipt</title>
  <!-- Tell the browser to be responsive to screen width -->
 <style type="text/css" media="print">
    @page
    {
        size:  auto;   /* auto is the initial value */
        margin: 7mm;  /* this affects the margin in the printer settings */
    }
    </style>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
</div>
<body id="pdf">
<div class="wrapper">
  <!-- Main content -->
  <div class="row">
    <p style="text-align:center; font-size:17px;"> <b>RECEIPT</b>  </p>
  </div>
  <table id="example" class="table table-bordered mb-0 invoice-table" Width="100%">
    <style media="print">
      table{
        border-collapse: collapse;
      }
      .invoice-table td{
        padding-left: 10px;
        border: 1px solid #555!important;
      }
      .invoice-table .small{
        Width:15% !important;
        border: 1px solid #555!important;
      }
      .invoice-table .large{
        Width:85% !important;
        border: 1px solid #555!important;
      }
      .invoice-table{
        margin-bottom:0px;
        border: 1px solid #555!important;
      }
      .invoice-table p{
        line-height: 15px;
        padding-left: 30px;
      }
      .invoice-table .no-right-border{
      border-right: 0px!important;
      }
      .invoice-table .no-left-border{
      border-left: 0px!important;
      }
      .invoice-table .no-top-border{
      border-top: 0px!important;
      }
      .invoice-table .no-bottom-border{
      border-bottom: 0px!important;
      }
      .p_height{
        height: 15px!important;
      }
    </style>
    <style media="screen">
      table{
        border-collapse: collapse;
      }
      .invoice-table td{
        padding-left: 10px;
          border: 1px solid #555!important;
      }
      .invoice-table .small{
        Width:15% !important;
          border: 1px solid #555!important;
      }
      .invoice-table .large{
        Width:85% !important;
          border: 1px solid #555!important;
      }
      .invoice-table{
        margin-bottom:0px;
        border: 1px solid #555!important;
      }
      .invoice-table p{
        line-height: 15px;
        padding-left: 30px;
      }
      .invoice-table .no-right-border{
      border-right: 0px!important;
      }
      .invoice-table .no-left-border{
      border-left: 0px!important;
      }
      .invoice-table .no-top-border{
      border-top: 0px!important;
      }
      .invoice-table .no-bottom-border{
      border-bottom: 0px!important;
      }
      .p_height{
        height: 15px!important;
      }
    </style>
    <tr>
      <td   colspan="4" >
        <img src="<?php echo base_url(); ?>assets/images/header.jpg" width="100%" alt="">
      </td>
    </tr>
    <tr valign="top">
      <td class="no-right-border">
        <p class="p_height"> <b>Sponser Id : </b></p>
        <p class="p_height"> <b>Sponser Name : </b></p>
        <p class="p_height"> <b>Customer Id : </b></p>
        <p class="p_height"> <b>Name : </b></p>
        <p class="p_height"> <b>Mobile No 1.: </b></p>
        <p class="p_height"> <b>Mobile No 2.: </b></p>
        <p class="p_height"> <b>Address: </b></p>
        <p class="p_height"> <b>Adhar No. : </b></p>
        <p class="p_height"> <b>Bank Name : </b></p>
        <p class="p_height"> <b>Branch : </b></p>
        <p class="p_height"> <b>IFSC Code : </b></p>
        <p class="p_height"> <b>Account No.: </b></p>
        <p class="p_height"> <b>User Name : </b></p>
        <p class="p_height"> <b>Password : </b></p>
        <p class="p_height"> <b>Added Date : </b></p>
      </td>
      <td colspan="2" class="no-left-border no-right-border">
        <?php   $user_details = $this->User_Model->get_info_arr('user_id', $user_id, 'user'); ?>
        <p class="p_height"><?php echo $user_id; ?></p>
        <p class="p_height"><?php echo $user_details[0]['user_name']; ?></p>
        <p class="p_height"><?php echo $cust_pre_id; ?></p>
        <p class="p_height"><?php echo $customer_name; ?></p>
        <p class="p_height"><?php echo $customer_mob1; ?></p>
        <p class="p_height"><?php echo $customer_mob2; ?></p>
        <p class="p_height"><?php echo $customer_address; ?></p>
        <p class="p_height"><?php echo $customer_adhar_no; ?></p>
        <p class="p_height"><?php echo $customer_bank; ?></p>
        <p class="p_height"><?php echo $customer_b_branch; ?></p>
        <p class="p_height"><?php echo $customer_b_ifsc; ?></p>
        <p class="p_height"><?php echo $customer_acc_no; ?></p>
        <p class="p_height"><?php echo $customer_mob1; ?></p>
        <p class="p_height"><?php echo $customer_password; ?></p>
        <p class="p_height"><?php echo date("d-m-Y h:ia", strtotime($customer_date)); ?></p>
       </td>
       <td class="no-left-border" style="text-align:right; padding-top:10px; padding-right:10px;">
        <img style="width:100px; height:100px;" src="<?php echo base_url(); ?>assets/images/customer/<?php echo $customer_img; ?>" alt="">
       </td>
    </tr>
  </table>

  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- <script src="<?php echo base_url('files/bower_components/jquery/dist/jquery.min.js'); ?>"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.10/jspdf.plugin.autotable.min.js"></script>

<!-- <script src="<?php echo base_url('files/dist/tableHTMLExport.js'); ?>"></script> -->

<script type="text/javascript">
  <?php if(isset($pdf)) { ?>
  var doc = new jsPDF();
  $('#cmd').click(function () {
      doc.fromHTML($('#content').html(), 15, 15, {
          'width': 170,
              'elementHandlers': specialElementHandlers
      });
      doc.save('sample-file.pdf');
  });
  <?php } else { ?>
   window.print();
 <?php } ?>

</script>
</body>
</html>
