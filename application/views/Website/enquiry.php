<?php include("navbar.php") ?>

<section class="product-page">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1 class="text-center">Enquiry</h1>
    </div>
  </div>

</div>
</section>

<section class="enquiry-page">

  <section class="vehicle-middle">
    <div class="container">
      <div class="row">
        <div class="col-md-10 offset-md-1" id="middle">
      <form action="<?php echo base_url();?>Website/send_mail" method="post" class="contactForm" >
        <div class="form-group">
          <label for="exampleInputEmail1">Enter Name :  </label>
          <input type="text" name="name" class="form-control"  placeholder="Enter Name">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Mobile No :  </label>
          <input type="text" name="mobile" class="form-control"  placeholder="Enter Mobile No.">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email :  </label>
          <input type="email" name="email" class="form-control"  placeholder="Enter Email">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">What you would like to know ?  :   </label> <br>
          <textarea class="form-control"  name="message" rows="6" cols="115"></textarea>
        </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
        </div>
      </div>
    </div>
  </section>
</section>

<?php include("footer.php") ?>
