<?php
$logo = $project['logo'];
// $user_id =  $this->session->userdata['logged_in']['user_id'];
?>
           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="border-bottom text-center pb-4">
                        <img src="<?php echo base_url(!empty($logo)? '/upload/project_logo/'.$logo : 'assets/images/client1.jpg'); ?>" alt="profile" class="img-lg rounded-circle mb-3"/>
                        <div class="mb-3">
                          <h3><?php echo $project['name'];?></h3>
                          <p class="text-muted mb-0">Customer:&nbsp;<a href="#"><?php echo $project['customer_name'];?></a></p>
                          </div>
                        </div>
                        

                           <div class="border-bottom col-sm-12">
                            <label class="col-12 col-lg-12 col-form-label">Edit Progress:<font color="grey"> for customer information purpose</font></label>
                            <span class="btn btn-link" id="project_complete_button" data-toggle="collapse" data-target="#project_completed"><?php echo $project['complete'];?>% completed</span>
                          </div>
                          <div class="alert alert-info collapse" id="project_completed">
                            <?php echo form_open("project/complete/".$project['id'], array('id' => 'project_complete' )) ?>
                              <input type="number" value="<?php echo $project['complete'];?>" name="complete" required min="0" max="100" class="form-control">
                            <br>
                            <div class="text-center">
                            <button type="submit" class="btn btn-outline-primary btn-icon-text">
                                <i class="ti-file btn-icon-prepend"></i>Update                                                   
                            </button>
                            <span data-toggle="collapse" data-target="#project_completed" type="button" class="btn btn-outline-warning btn-icon-text">
                                <i class="ti-reload btn-icon-prepend"></i>
                                Close
                            </span>
                           </div>
                            <?php echo form_close() ?>
                          </div>

                          <?php foreach ($statuses as $row) { 
                            $flag = "btn-outline-success";
                            $status = "0";
                            foreach ($project_status as $key => $value) {
                              if ($row['id'] == $value)
                              {
                                $flag = "btn-success";
                                $status = "1";
                              }
                            }

                            ?>
                            

                          <label class="col-12 col-lg-12 col-form-label">
              <button data-flag="<?php echo $status;?>" data-id="<?php echo $row['id'];?>" type="button" class="btn <?php echo $flag;?> btn-sm" onclick="finishStatus('<?php echo $project['id'];?>',$(this))">
                            <i class="ti-flag mr-1"></i> Finish
                          </button>&nbsp;&nbsp;&nbsp; <?php echo $row['status'];?></label>

                        <?php } ?>

                                    
                    </div>
                 
                  </div>
                </div>

              </div>
           




        </div>
      </div></div>
