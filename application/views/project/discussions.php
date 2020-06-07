<style type="text/css">
  .discussion-item{display: none !important;}
  .page-item{cursor: pointer;}
  #discussion_form{display: none;}
</style>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                        <img src="<?php echo base_url(!empty($logo)? '/upload/project_logo/'.$logo : 'assets/images/client1.jpg'); ?>" alt="profile" class="img-lg rounded-circle mb-3"/>
                        
                        <div class="mb-3">
                          <h3><?php echo $project['name'];?></h3>
                          <p class="text-muted mb-0">Customer:&nbsp;<a href="#"><?php echo $project['customer_name'];?></a></p>
                          </div>
                        </div>
                     
                      
                     
                    
                    </div>
                    <div class="col-lg-8">
                      <div class="d-flex justify-content-between">
                        <div>
                         
                          
                          
                        </div>
                      </div>
                      <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav profile-navbar">
                          <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url('customer/profile_info/'.$project['customer_id']);?>">
                              <i class="ti-user"></i>
                              Info
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url('customer/projects/'.$project['customer_id']);?>">
                              <i class="ti-vector"></i>
                              Projects
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url('customer/payments/'.$project['customer_id']);?>">
                              <i class="ti-receipt"></i>
                              Payments
                            </a>
                          </li>
                          
                        </ul>
                      </div>



                      <div class="profile-feed">
                        <div>
                           <div class="py-4">

             

                      </div>
                        </div>
                       
                      </div>
                    </div>
                  </div>    

                  <small>Development&nbsp;in progress:</small>
                   <div class="progress progress-md">
                      <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $project['complete'];?>%" aria-valuenow="<?php echo $project['complete'];?>" aria-valuemin="0" aria-valuemax="100"><?php echo $project['complete'];?>% completed</div>
                    </div><br>

                    <button class="btn btn-primary mr-2" onclick="$('#discussion_form').show()">Compose</button><br><br>


      <?php echo form_open_multipart("project/add_discussion/".$project['id'], array('id' => 'discussion_form')) ?>
          <div class="row grid-margin form-group">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4"><i class="ti-comment-alt"></i> Compose</h4>
                  <div id="summernoteExample">

                  </div><br>

                  <span class="file-upload-browse btn btn-secondary"><i class="ti-clip"></i> Attach</span>
                   <input type="file" multiple="" name="attachments[]" class="file-upload-default">
                     <button onclick="submitDiscussion();" class="btn btn-success mr-2"><i class="mdi mdi-send"></i> Send</button>
                    <span class="btn btn-light" onclick="$('#discussion_form').hide()">Cancel</span>
                </div>
              </div>
            </div>
          </div>
      <?php echo form_close() ?>

       

           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="profile-feed discussion-items">
                    <?php 
                    $pages = ceil(sizeof($discussions)/5);
                    $index = 1;
                    foreach ($discussions as $row) {
                      $page_no = ceil($index/5);
                      if ($row['creator_type'] == 'employees')
                      {
                        $created_by = $row['emp_name'];
                        $creator_img = base_url(!empty($row['emp_photo'])? '/upload/employee_photo/'.$row['emp_photo'] : 'assets/images/client1.jpg');
                      }
                      else
                      {
                        $created_by = $row['cust_name'];
                        $creator_img = base_url(!empty($row['cust_photo'])? '/upload/customer_photo/'.$row['cust_photo'] : 'assets/images/client1.jpg');                        
                      }
                    ?>


                        <div class="page_no_<?php echo $page_no;?> d-flex align-items-start profile-feed-item discussion-item" >
                          <img src="<?php echo $creator_img;?>" alt="profile" class="img-sm rounded-circle"/>
                          <div class="ml-4">
                            <h6>
                              <?php echo $created_by;?>
                              <small class="ml-4 text-muted">
                                <i class="ti-time mr-1"></i><?php echo $row['created_at'];?> &nbsp;&nbsp;&nbsp;
                                 <a href="<?php echo base_url('project/edit_discussion/'.$row['id']);?>" class="text-primary"><i class="mdi mdi-pencil"></i> Edit</a>&nbsp;&nbsp;&nbsp;
                                 <a onclick="removeDeliveryChallan('<?php echo base_url("project/remove_discussion/".$row['id']);?>')" class="text-danger"><i class="mdi mdi-window-close"></i> Remove</a>
                              </small> 
                            </h6>
                        <div class="discussions">        
                           <?php print_r($row['discussion']); ?>
                        </div>
                            <!-- Start Attachment -->
                                       <div class="email-wrapper wrapper">
                                          <div class="message-body">
                                            <div class="attachments-sections">
                                              <ul>
                                                <?php 
                                                $attachments = $this->discussion_model->attachments($row['id']);
                                                foreach ($attachments as $row) {
                                                  $type = $row['file_type'] == 'application/pdf' ? "ti-file" : "ti-image";

                                                ?>
                                                <li>
                                                  <div class="thumb"><i class="<?php echo $type; ?>"></i></div>
                                                  <div class="details">
                                                    <p class="file-name"><?php echo $row['file_name']; ?></p>
                                                    <div class="buttons">
                                                      <p class="file-size"><?php echo $row['file_size']; ?> Bytes</p>
                                                      <?php if (!empty($row['attachment'])) { ?>
                                                      <a href="<?php echo base_url('/upload/project_disccusion_attachment/'.$row['attachment']); ?>" class="view">View</a>
                                                      <a href="<?php echo base_url('/upload/project_disccusion_attachment/'.$row['attachment']); ?>" download class="download">Download</a>
                                                    <?php } ?>
                                                    </div>
                                                  </div>
                                                </li>
                                              <?php } ?>

                                              </ul>
                                            </div>
                                          </div>
                                       </div>
                                       <!-- End Attachment -->
                           </div>
                        </div>

                      <?php
                      $index += 1;
                       } ?>

                      </div>
                      <div class="pagination-page"></div>
                    </div>
                </div>
              </div>


            <!-- Pagination Start -->
              <div class="col-md-12 col-sm-12 grid-margin stretch-card justify-content-center">
                  <nav>
                    <ul class="pagination flex-wrap pagination-rounded-flat pagination-success">
                      <li class="page-item page-left-nav"><span class="page-link" ><i class="ti-angle-left"></i></span></li>
                      <li id="page-number-1" class="page-item page-number active" number="1"><span class="page-link"  >1</span></li>
                      <?php if ($pages >1)
                      {

                        for ($i=2; $i <= $pages; $i++) { 
                          ?>                                    
                      <li id="page-number-<?php echo $i;?>" class="page-item page-number" number="<?php echo $i;?>"><span class="page-link" ><?php echo $i;?></span></li>
                    <?php } } ?>
                      <li class="page-item page-right-nav" last="<?php echo $pages; ?>"><span class="page-link" ><i class="ti-angle-right"></i></span></li>
                    </ul>
                  </nav>
            </div>
            <!-- Pagination End -->




</div>





        </div>
      </div></div>
    </div>
  </div></div></div>
<script type="text/javascript">
  $('.page_no_1').attr("style", "display: inline !important");
</script>
  

