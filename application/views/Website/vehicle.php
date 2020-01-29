<?php include("navbar.php") ?>

<section class="product-page">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1 class="text-center">Vehicle Registration</h1>
    </div>
  </div>
</div>

</section>

<section class="vehicle-middle">
  <div class="container">
    <div class="row">
      <div class="col-md-10 offset-md-1" id="middle">
    <form>
      <div class="form-group">
        <label for="exampleInputEmail1">Sponser id : </label>
        <input type="text" class="form-control"  placeholder="Enter email">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Full Name :  </label>
        <input type="text" class="form-control"  placeholder="Enter Full Name">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Mobile No :  </label>
        <input type="text" class="form-control"  placeholder="Enter Mobile No.">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email :  </label>
        <input type="email" class="form-control"  placeholder="Enter Email">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Address :   </label>
        <input type="text" class="form-control"  placeholder="Enter Address">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">City :   </label>
        <input type="text" class="form-control"  placeholder="Enter City">
      </div>

      <div class="form-group">
        <label for="sel1">Select Country</label>
        <select class="form-control"  >
          <option  value="selected">Country</option>
        </select>
      </div>

        <div class="form-group">
          <label for="sel1">Select State</label>
          <select class="form-control"  >
            <option  value="selected">Maharashtra</option>
          </select>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Amount :   </label>
          <input type="text" class="form-control"  placeholder="Enter Amount">
        </div>

        <div class="form-group">
          <label for="sel1">Select Transaction Type</label>
          <select class="form-control"  >
            <option  value="selected">Cash</option>
          </select>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Transaction No If Online :   </label>
          <input type="text" class="form-control"  placeholder="Enter Transaction No. ">
        </div>

        <div class="form-group">
          <label for="sel1">Select Vehicle</label>
          <select class="form-control"  >
            <option  value="selected">Activa</option>
          </select>
        </div>

          <div class="form-group">
          <div class="custom-file">
          <input type="file" class="custom-file-input" id="customFile">
          <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
      </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
      </div>
    </div>
  </div>
</section>

<?php include("footer.php") ?>
