<?php
if (isset($this->session->userdata['logged_in'])) {
$user_name = ($this->session->userdata['logged_in']['user_name']);
$user_id = ($this->session->userdata['logged_in']['user_id']);
$unick_name = ($this->session->userdata['logged_in']['nick_name']);
} else {
redirect('home/login', 'refresh');
}
$total = $this->requests_model->RequestsToMe($user_id);
$total_task =$this->task_model->myTasks($user_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php
    echo empty($title) ? "XE" : $title;
   ?></title>
  <script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js');?>"></script>
  <script src="<?php echo base_url('assets/js/hr_managment.js');?>"></script>
  <script src="<?php echo base_url('assets/js/delete_rows.js');?>"></script>
  <script src="<?php echo base_url('assets/js/marketing.js');?>"></script>
  <script src="<?php echo base_url('assets/js/product.js');?>"></script>
  <script src="<?php echo base_url('assets/js/meterial_delivery.js');?>"></script>
  <script src="<?php echo base_url('assets/js/meterial_usage.js');?>"></script>
  <script src="<?php echo base_url('assets/js/account_book.js');?>"></script>
  <script src="<?php echo base_url('assets/js/delivery_challan.js');?>"></script>
  <script src="<?php echo base_url('assets/js/project.js');?>"></script>
  <script src="<?php echo base_url('assets/js/sales.js');?>"></script>
  <script src="<?php echo base_url('assets/js/purchase.js');?>"></script>
  <script src="<?php echo base_url('assets/js/setting.js');?>"></script>
  <script src="<?php echo base_url('assets/js/customers.js');?>"></script>

  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/ti-icons/css/themify-icons.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/css/vendor.bundle.base.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/select2/select2.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css');?>">  

  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.css');?>">
  <!-- endinject -->

   <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-bar-rating/css-stars.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/mdi/css/materialdesignicons.min.css');?>">



  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/summernote/dist/summernote-bs4.css');?>">
   <link rel="stylesheet" href="<?php echo base_url('assets/vendors/quill/quill.snow.css');?>">
   <link rel="stylesheet" href="<?php echo base_url('assets/vendors/simplemde/simplemde.min.css');?>">

  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/x-editable/bootstrap-editable.css');?>">

  <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico');?>" />
  <!-- Required meta tags -->
  <!-- endinject -->
    

  <link rel="stylesheet" href="<?php echo base_url('assets/css/client.css');?>">  
      
  <!-- Plugin css for this page -->
   <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css');?>">
  <!-- End plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css');?>">
  <!-- endinject -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css');?>">

<link rel="stylesheet" href="<?php echo base_url('assets/vendors/dropify/dropify.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-file-upload/uploadfile.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-tags-input/jquery.tagsinput.min.css');?>">

<link rel="stylesheet" href="<?php echo base_url('assets/vendors/dropzone/dropzone.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-bar-rating/bars-1to10.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-bar-rating/bars-horizontal.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-bar-rating/bars-movie.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-bar-rating/bars-pill.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-bar-rating/bars-reversed.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-bar-rating/bars-square.css');?>">  
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-bar-rating/bootstrap-stars.css');?>">  
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-bar-rating/examples.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-bar-rating/fontawesome-stars-o.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-bar-rating/fontawesome-stars.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-asColorPicker/css/asColorPicker.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/vertical-layout-light/style.css');?>">


</head>

<body class="sidebar-dark">
  <input type="hidden" name="current_user" id="current_user" value="<?php echo $user_id; ?>">
  <input type="hidden" id="base_url" value="<?php echo base_url('');?>">
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" ><img src="<?php echo base_url('assets/images/logo.svg" class="mr-2" alt="logo');?>"/></a>
        <a class="navbar-brand brand-logo-mini">
          <img src="<?php echo base_url('assets/images/logo-mini.svg');?>" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-layout-grid2"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="ti-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown mr-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
              <i class="ti-email mx-0"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="../../images/client-DP/client1.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="../../images/client-DP/client1.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    New product launch
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="../../images/client-DP/client1.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="ti-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../../images/client-DP/client1.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="<?php echo base_url("home/logout") ?>">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="ti-more"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-layout-grid2"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options selected" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles light"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>

        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button data-url="<?php echo base_url('home/add_todo_task/'); ?>" type="submit" class="add btn btn-primary my-todos-add-btn " id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list1">
                    <?php 
                       $todo_tasks =  $this->my_todo_model->all($user_id);
                       foreach ($todo_tasks as $row) {
                        ?>
                      <li class="<?php if ($row['status'] == '1'){echo 'completed';}?>">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="task-checkbox" <?php if ($row['status'] == '1'){echo "checked='checked'";}?> type="checkbox" value="<?php echo $row['id'];?>">
                            <?php echo $row['name'];?>
                          </label>
                        </div>
                        <i class="remove ti-close" data-id="<?php echo $row['id'];?>"></i>
                      </li>
                    <?php } ?>
              </ul>
            </div>

          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../../index.html">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

               <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-marketing" aria-expanded="false" aria-controls="ui-marketing">
              <i class="ti-headphone-alt menu-icon"></i>
              <span class="menu-title">Marketing</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-marketing">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("marketing/new_lead"); ?>">New Lead</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("marketing/advanced_inbox"); ?>">Master Lead Controller</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("marketing/inbox"); ?>">Leads</a></li>
                
              </ul>
            </div>
          </li>

           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-client" aria-expanded="false" aria-controls="ui-client">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">CRM</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-client">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("Customer/add_customer"); ?>">Add Customer</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("Customer"); ?>">Customers</a></li>
              </ul>
            </div>
          </li>



          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-project" aria-expanded="false" aria-controls="ui-project">
              <i class="ti-vector menu-icon"></i>
              <span class="menu-title">Projects</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-project">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("project/install_project"); ?>">Install</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("project/master_list"); ?>">Master Controller</a></li>                
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("project"); ?>">Projects</a></li>
              </ul>
            </div>
          </li>


<!--           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-delivery_challan" aria-expanded="false" aria-controls="ui-delivery_challan">
              <i class="ti-vector menu-icon"></i>
              <span class="menu-title">Delivery Challan</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-delivery_challan">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("delivery_challan/"); ?>">Create</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url("delivery_challan/report"); ?>">Report</a></li>
              </ul>
            </div>
          </li>
 -->
<!-- 
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-products" aria-expanded="false" aria-controls="ui-products">
              <i class="ti-vector menu-icon"></i>
              <span class="menu-title">Products/Services</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-products">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("product/new_product"); ?>">Add Items</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("product"); ?>">Products</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("settings/service/list_view"); ?>">Services</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("product/list_view"); ?>">Stock Report</a></li>
              </ul>
            </div>
          </li> -->

            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-event" aria-expanded="false" aria-controls="ui-event">
              <i class="ti-microphone-alt menu-icon"></i>
              <span class="menu-title">Events</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-event">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="new-event.html">New Event</a></li>
                <li class="nav-item"> <a class="nav-link" href="event-list.html">Events</a></li>
                <li class="nav-item"> <a class="nav-link" href="reservation.html">Reservation</a></li>
              </ul>
            </div>
          </li>


           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-invoice" aria-expanded="false" aria-controls="ui-invoice">
              <i class="ti-shopping-cart menu-icon"></i>
              <span class="menu-title">Sale</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-invoice">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("invoice/estimate"); ?>">Estimate/Order</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("invoice/sales"); ?>">New Sale</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("invoice/report/estimate"); ?>">Estimate Report</a></li>                
                 <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("invoice/report"); ?>">Sale Report</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("invoice/report/sales_return"); ?>">Sale Returns</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("invoice/report/cancelled_sales"); ?>">Cancelled Sales</a></li>                     
              </ul>
            </div>
          </li> 


           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-purchase" aria-expanded="false" aria-controls="ui-purchase">
              <i class="ti-truck menu-icon"></i>
              <span class="menu-title">Purchase</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-purchase">
              <ul class="nav flex-column sub-menu">
                 <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("invoice/purchase_order/create"); ?>">New Order</a></li>    
                 <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("invoice/purchase"); ?>">New Purchase</a></li> 
                 <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("invoice/purchase_report/debit_notes"); ?>">Purchase Orders</a></li> 

                 <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("invoice/purchase_report"); ?>">Purchase Report</a></li> 

                 <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("invoice/purchase_report/debit_notes"); ?>">Purchase Returns</a></li> 

                 <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("invoice/purchase_report/cancelled_purchases"); ?>">Cancelled Purchases</a></li>
              </ul>
            </div>
          </li> 


             <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-accounts" aria-expanded="false" aria-controls="ui-accounts">
              <i class="ti-bar-chart menu-icon"></i>
              <span class="menu-title">Accounts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-accounts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("account_book/cash_payment") ?>">Cash Payment</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("account_book/cash_reciept") ?>">Cash Reciept</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("account_book/payroll") ?>">Payroll</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("account_book/journal_transaction") ?>">Account Transaction</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("account_book/self_transfer") ?>">Self Transfer</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("account_book/cash_flow_statement") ?>">Cash Flow Statement</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("account_book/journal_report") ?>">Accounts Report</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("settings/tax/report") ?>">Tax Report</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("yearly_report") ?>">Yearly Report</a></li>
              </ul>
            </div>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-hr" aria-expanded="false" aria-controls="ui-hr">
              <i class="ti-id-badge menu-icon"></i>
              <span class="menu-title">HR Management</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-hr">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("hrmanagement") ?>">Deployment</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("hrmanagement/master") ?>">Master Controller</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("hrmanagement/employees") ?>">Employees</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url("announcement/new") ?>">
              <i class="ti-announcement menu-icon"></i>
              <span class="menu-title">Announcements</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#req" aria-expanded="false" aria-controls="req">
              <i class="ti-comment-alt menu-icon"></i>
              <span class="menu-title">Request</span><div class="badge badge-pill badge-warning"><?php echo $total;?></div>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="req">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("Request/") ?>">Make Request</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("Request/inbox") ?>">Inbox</a></li>
              </ul>
            </div>
          </li>

           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#task" aria-expanded="false" aria-controls="task">
              <i class="ti-calendar menu-icon"></i>
              <span class="menu-title">Task Manager</span><div class="badge badge-pill badge-danger"><?php echo $total_task;?></div>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="task">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("task_manager/") ?>">Make Task</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("task_manager/my_tasks") ?>">My Tasks</a></li>
              </ul>
            </div>
          </li>



     <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-settings" aria-expanded="false" aria-controls="ui-settings">
              <i class="ti-settings menu-icon"></i>
              <span class="menu-title">Settings</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-settings">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("settings/business") ?>">Business Settings</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("settings/skill") ?>">Skill Settings</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("settings/role") ?>">Role Settings</a></li>
                <!-- <li class="nav-item"> <a class="nav-link" href="<?php // echo base_url("settings/service") ?>">Service Settings</a></li> -->
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("settings/job") ?>">Job Settings</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("settings/account") ?>">
                Account Settings</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("settings/unit") ?>">
                Unit Settings</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("settings/tax") ?>">
                Tax Settings</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("settings/cess") ?>">
                Cess Settings</a></li> 
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url("settings/status") ?>">
                Status Settings</a></li>                
              </ul>
            </div>
          </li>
          
        </ul>
      </nav>

  <div class="main-panel">    
<!-- Main content -->
      <!-- partial -->

        <div class="content-wrapper">
                <div class="content col-12"> 

                    <!-- alert message -->
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
                    
                    <?php if ($this->session->flashdata('db_error') != null) {  ?>
                    <div class="alert alert-fill-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('db_error'); ?>
                    </div>
                    <?php } ?> 
                         
                    <?php if (validation_errors()) {  ?>
                    <div class="alert alert-fill-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo validation_errors(); ?>
                    </div>
                    <?php } ?>
                    

                    <!-- content -->
                    <?php echo (!empty($content)?$content:null) ?>

                </div> <!-- /.content -->
         <script type="text/javascript">
      $('.alert').delay(3000).hide(0);
    </script>