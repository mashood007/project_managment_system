<?php
$business = $this->business_model->business();
$icon = $business['icon'] == "" ? 'assets/images/logo-mini.svg' : base_url('/upload/business/icon/'.$business['icon']);
$favicon = $business['favicon'] == "" ? 'assets/images/favicon.ico' : base_url('/upload/business/favicon/'.$business['favicon']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/ti-icons/css/themify-icons.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/css/vendor.bundle.base.css');?>">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/vertical-layout-light/style.css');?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo $favicon;?>" />
  <style type="text/css">
    body
    {
      background-image: url("<?php echo base_url('assets/images/lockscreen-bg.jpg');?>");
       background-repeat: no-repeat;
        background-size: cover;
    }
  </style>
</head>

<body class="sidebar-dark">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth lock-full-bg">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">       
            <div class="auth-form-transparent text-left p-5 text-center">
              <?php if (isset($message_display)) { ?>
              <div>
                <div class="alert alert-fill-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo $message_display; ?>
                </div>                
              </div> 
            <?php }?>
              <img src="<?php echo $icon;?>" style="width:90px;height:90px;">
              <?php echo form_open("home/login") ?>

                <div class="form-group">
                  <label for="examplePassword1">Enter your credential.</label>
                <input type="username" name = "user_name"class="form-control text-center" id="user_name" placeholder="Username" required style="color: white"><br>
                <input type="password" name="user_password" class="form-control text-center" id="user_password" placeholder="Password" required style="color: white">
                </div>
                <div class="mt-5">
                  <input class="btn btn-block btn-success btn-lg font-weight-medium" type="submit" value="Login">
                </div>
                <div class="mt-3 text-center">
                  <a href="<?php echo base_url('home/forgot_password');?>" class="auth-link text-white">Forgot password</a>
                </div>
             <?php echo form_close(); ?> 
              </div>       
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?php echo base_url('assets/vendors/js/vendor.bundle.base.js');?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?php echo base_url('assets/js/off-canvas.js');?>"></script>
  <script src="<?php echo base_url('assets/js/hoverable-collapse.js');?>"></script>
  <script src="<?php echo base_url('assets/js/template.js');?>"></script>
  <script src="<?php echo base_url('assets/js/settings.js');?>"></script>
  <script src="<?php echo base_url('assets/js/todolist.js');?>"></script>
  <!-- endinject -->
</body>

</html>