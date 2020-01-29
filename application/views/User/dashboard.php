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
          <div class="col-sm-12 text-center mt-2">
            <h1>Company Information</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <hr>
        <h4 class="mb-3">Master Summary</h4>
        <div class="row">
          <!-- left column -->
          <?php if($sky_roll_id == 1 || $sky_roll_id == 2){ ?>
          <div class="col-md-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $user_cnt; ?></h3>
                <p>User Information</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="user_information_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <div class="col-md-3 col-6">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $cust_cnt; ?></h3>
                <p>Customer Information</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="customer_information_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <?php if($sky_roll_id == 1 || $sky_roll_id == 2){ ?>
          <div class="col-md-3 col-6">
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php echo $sale_cnt; ?></h3>
                <p>Sale Bill Information</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo base_url(); ?>Transaction/salebill_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo $news_cnt; ?></h3>
                <p>News Information</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="news_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php } ?>
        </div>
        <hr>

      </div><!-- /.container-fluid -->
    </section>
  </div>

</body>
</html>
