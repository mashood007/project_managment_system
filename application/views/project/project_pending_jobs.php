                    <?php foreach($project_pending_jobs as $project_job)
                    {
                      $photo = $project_job['photo'];
                      ?>

                        <div id="row_1_<?php echo $project_job['id']; ?>" class="d-flex align-items-start profile-feed-item pending_job_<?php echo $project_job['id'];?>">
                          <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>"  class="img-sm rounded-circle"/>
                          <div class="ml-4">
                            <h6>
                              <?php echo $project_job['job'];?>
                              <br><small class="ml-4 text-muted">
                                <span class="text-warning">Pending Job</span>&nbsp;&nbsp;&nbsp;
                                <i class="ti-time mr-1"></i><?php echo $project_job['created_at'];?> &nbsp;&nbsp;&nbsp;
                                ₹<?php echo $project_job['revenue'];?>&nbsp;&nbsp;&nbsp;
                                <i class="ti-user mr-1"></i><?php echo $project_job['employee_name'];?>&nbsp;&nbsp;&nbsp;
                                 <a onclick="window.location.href = 'new-job.html';" class="text-primary"><i class="mdi mdi-pencil"></i> Edit</a>&nbsp;&nbsp;&nbsp;
                                 <a onclick="deleteRow('<?php echo base_url('project/delete_job/'.$project_job['id']);?>')" class="text-danger">
                                  <i class="mdi mdi-window-close"></i> Remove</a>
                              </small> 
                            </h6>
                            <p>
                              <?php echo $project_job['description'];?>
                            </p>
                              <button onclick="finish_job('<?php echo $project_job['project_id'];?>', '<?php echo $project_job['id'];?>')" type="button" class="btn btn-success btn-sm finish_project"><i class="ti-flag mr-1"></i> Finish</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.location.href = '<?php echo base_url('project/job_conversations/'.$project_job['id']);?>';">
                              <i class="ti-comment mr-1"></i> Conversations</button>
                         </div>
                      </div>



                      <?php 
                      }
                      ?>
