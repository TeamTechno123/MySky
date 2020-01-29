<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Invoice</title>
 <style type="text/css" media="print">
    @page
    {
        size:  auto;   /* auto is the initial value */
        margin: 7mm;  /* this affects the margin in the printer settings */
    }
    </style>
  <!-- Google Font -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
</head>
</div>
<body id="pdf">
<div class="wrapper">
  <!-- Main content -->
  <div class="row">
    <p style="text-align:center; font-size:17px;"> <b>Invoice</b>  </p>
  </div>
  <table id="example" class="table table-bordered mb-0 invoice-table" Width="100%">
    <style media="print">
      table{
        border-collapse: collapse;
      }
      .invoice-table td{
          border: 1px solid #555!important;
      }
      .invoice-table .small{
          border: 1px solid #555!important;
      }
      .invoice-table .large{
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
    </style>
    <style media="screen">
      table{
        border-collapse: collapse;
      }
      .invoice-table td{
        border: 1px solid #555!important;
      }
      .invoice-table .small{
          border: 1px solid #555!important;
      }
      .invoice-table .large{
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
    </style>
    <tr>
      <td   colspan="4" >
        <img src="<?php echo base_url(); ?>assets/images/header.jpg" width="100%" alt="">
      </td>
    </tr>
    <tr>
      <td colspan="3" style="text-align:left; padding-left:50px;"><p>
        <b style="padding-right:8px;">Party Name  </b> : <?php echo $customer_name; ?>  </p>
        <p> <b style="padding-right:34px;">Address   </b> : <?php echo $customer_address; ?> </p>
        <p><b style="padding-right:15px;">Mobile No.  </b> : <?php echo $customer_mob1; ?> </p>
        <p><b style="padding-right:6px;">MY SKY ID </b> : SS267254 </p>
       </td>
    </tr>
    <tr>
      <td Width="10%" style="text-align:center; padding-left:5px; font-weight:bold;" > <p style="padding-left:0px;">Sr. No.</p> </td>
      <td style="text-align:center; padding-left:5px; font-weight:bold;"><p style="padding-left:0px;">Description</p>  </td>
      <td style="text-align:center; padding-left:5px; font-weight:bold;"><p style="padding-left:0px;">Amount</p>  </td>
    </tr>
    <?php $i = 0;
    foreach ($sale_descr_list as $details) {
      $i++; ?>
    <tr>
    <td><p><?php echo $i; ?></p> </td>
    <td> <p><?php echo $details->sale_description; ?></p> </td>
    <td> <p><?php echo $details->sale_descr_amt; ?></p> </td>
    </tr>
    <?php } ?>
    <?php if($i <= 6){
      for ($j=$i+1; $j <= 6; $j++) { ?>
        <tr>
        <td><p><?php echo $j; ?></p> </td>
        <td> <p></p> </td>
        <td> <p></p> </td>
        </tr>
    <?php } } ?>
    <tr>
      <td colspan="2"> <p style="text-align:center;">Total</p> </td>
      <td><p> &#8377;<?php echo $total_amount; ?></p> </td>
    </tr>
    <tr>
      <td colspan="3"><p> <b>Amount In Words</b>  :  <?php echo $this->numbertowords->convert_number($total_amount); ?> Only</p>  </td>
    </tr>
  </table>
<br><br><br>
<p style="font-size:18px; font-weight: bold; text-align:right; padding-right:30px;"> For <?php echo $company_name; ?> </p>

 <img style="float:right; padding-right:20px;" src="<?php echo base_url(); ?>assets/images/sign.jpg" width="100" alt="">

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
