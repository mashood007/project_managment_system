<!DOCTYPE html>
<html lang="en">

<head>


  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Forgot Password</title>
  <!-- plugins:css -->

  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/ti-icons/css/themify-icons.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/css/vendor.bundle.base.css');?>">

  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/codemirror/codemirror.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/codemirror/ambiance.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/pwstabs/jquery.pwstabs.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/vertical-layout-light/style.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/css/vendor.bundle.base.css');?>">

  <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico');?>" />

</head>
<body class="sidebar-dark">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="<?php echo base_url('assets/images/logo.svg');?>" alt="logo">
              </div>
              <h4 class="display-4">Forgot Password?</h4>
              <h6 class="font-weight-light">Let us help you!</h6>
                    <?php if ($this->session->flashdata('message') != null) {  ?>
                    <div class="alert alert-fill-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('message'); ?>

                    </div> 
                    <?php } ?>
                    
                    <?php if ($this->session->flashdata('exception') != null) {  ?>
                    <div class="alert alert-fill-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('exception'); ?>
                    </div>
                    <?php } ?>                
              <?php echo form_open("home/forgot_password") ?>
                <div class="form-group">
                  <label for="exampleInputEmail">Authorised Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-email text-primary"></i>
                      </span>
                    </div>
                    <input type="email" required name="email" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="Email">
                  </div>
                </div>
                
                <div class="my-2 d-flex justify-content-between align-items-center">
                  
                 
                </div>
                <div class="my-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Recover my Password</button>
                </div>
                
                <div class="text-center mt-4 font-weight-light">
                  Do you have an old password? First <a href="<?php echo base_url('home/login');?>" class="text-primary">Login</a> to your account. Then take Change  Password option.
                </div>
                    <?php echo form_close()?>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Developed by <a href="https://xeobrain.com"><b>Xeobrain</b><a> in Inda</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
 
  <!-- endinject -->

<script src="<?php echo base_url('assets/vendors/js/vendor.bundle.base.js');?>"></script>
<script src="<?php echo base_url('assets/js/off-canvas.js');?>"></script>
<script src="<?php echo base_url('assets/js/hoverable-collapse.js');?>"></script>
<script src="<?php echo base_url('assets/js/template.js');?>"></script>
<script src="<?php echo base_url('assets/js/settings.js');?>"></script>
<script src="<?php echo base_url('assets/js/todolist.js');?>"></script>
<script type="text/javascript">
      $('.alert').delay(3000).hide(0);
</script>
</body>

</html>