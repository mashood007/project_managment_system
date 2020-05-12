                      
                    <?php foreach($project_completed_jobs as $project_job)
                    {
                      $photo = $project_job['photo'];
                      ?>  
                      <div class="card-inverse-secondary mb-5">
                        <div class="card-body">
                         <div class="d-flex align-items-start profile-feed-item">
                          <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>"  class="img-sm rounded-circle"/>
                          <div class="ml-4">
                            <h6>
                              <?php echo $project_job['job'];?>
                              <br><small class="ml-4 text-muted">
                                <span class="text-success">Completed Job</span>&nbsp;&nbsp;&nbsp;
                                <i class="ti-time mr-1"></i><?php echo $project_job['created_at'];?>m &nbsp;&nbsp;&nbsp;
                                ₹<?php echo $project_job['revenue'];?>&nbsp;&nbsp;&nbsp;
                                <i class="ti-user mr-1"></i><?php echo $project_job['employee_name'];?>&nbsp;&nbsp;&nbsp;
                              </small> 
                            </h6>
                            <p>
                              <?php echo $project_job['description'];?>
                            </p>
                           <button onclick="undo_finished_job('<?php echo $project_job['project_id'];?>', '<?php echo $project_job['id'];?>')"  type="button" class="btn btn-warning btn-sm undo_finished_job">
                              <i class="ti-back-right mr-1" ></i> Undo</button>
                             <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.location.href = '<?php echo base_url('project/job_conversations/'.$project_job['id']);?>';"><i class="ti-comment mr-1"></i> Conversations</button>
                            <small class="text-success">Finished on&nbsp;12 Aug 2019 12:30am </small>
                         </div>
                        </div>
                      </div>
                    </div>    

                    <?php 
                  }
                    ?>