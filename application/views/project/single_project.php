<?php
$logo = $project['logo'];

?>
<script>

function finish_job(project_id, job_id)
{
   var finish_project_url = "<?php echo base_url("project/finish_job/");?>"
        $.ajax({
           url: finish_project_url,
           type: 'POST',
           data: {id: job_id}
        });

        render_completed_jobs(project_id)
        render_pending_jobs(project_id) 
}

function undo_finished_job(project_id, job_id)
{
    var finish_project_url = "<?php echo base_url("project/undo_finished_job/");?>"
        $.ajax({
           url: finish_project_url,
           type: 'POST',
           data: {id: job_id}
        });

        render_completed_jobs(project_id)
        render_pending_jobs(project_id)
}


function render_pending_jobs(project_id)
{
  $.ajax({
    url: "<?php echo base_url("project/pending_jobs/");?>",
      type: 'POST',
        data: {project_id: project_id},
        success: function(data) {
          $(".project_pending_jobs").html(data);
        }

  }); 
}

function render_completed_jobs(project_id)
{
  $.ajax({
    url: "<?php echo base_url("project/completed_jobs/");?>",
    type: 'POST',
    data: {project_id: project_id},
    success: function(data) {
      $(".project_completed_jobs").html(data);
    }

  });  
}

</script>
           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="border-bottom text-center pb-4">
                        <img src="<?php echo base_url(!empty($logo)? '/upload/project_logo/'.$logo : 'assets/images/client1.jpg'); ?>" alt="profile" class="img-lg rounded-circle mb-3"/>
                        
                        <div class="mb-3">
                          <h3><?php echo $project['name'];?></h3>
                          <p class="text-muted mb-0">Customer:&nbsp;<a href="#"><?php echo $project['customer_name'];?></a></p>
                          </div>
                        </div>
                        
                           <div class="col-sm-8">
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

                     
                      
                      <div class="border-bottom py-4">
                        <p><font color="grey">Includes</font></p>
                        <div>
                          <label class="badge badge-outline-dark">Project 1</label>
                          <label class="badge badge-outline-dark">Project 2</label>
                          <label class="badge badge-outline-dark">Project 3</label>
       
                        </div><br>    
                        <p><font color="grey">About Project:</font></p> 
                        <p><?php echo $project['about'];?> </p><br>

                         <p><font color="grey">Price:&nbsp;</font>₹<?php echo $project['price'];?></p><br>
                         <p><font color="grey">Managed by:&nbsp;</font>Employee1</p>
                         <p><font color="grey">Estimated Time:&nbsp;</font>34 Business Days</p>
                         <p><font color="grey">Started on:&nbsp;</font><?php echo $project['created_at'];?></p>
                         <p><font color="grey">Must end on:&nbsp;</font><font color="red"><?php echo $project['end_date'];?></font></p>
                      </div><br>
                      
                   
                    </div>
                    <div class="col-lg-8">
                      <div class="d-flex justify-content-between">

                        <div class="col-sm-6">
                          <button class="btn btn-outline-primary btn-block mb-2" type="button" data-toggle="modal" data-target="#exampleModal-2" >
                          <i class="mdi mdi-calendar-clock btn-icon-prepend"></i> Add Shedule </button>
                        </div>
                           <div class="col-sm-6">
                          <button class="btn btn-outline-success btn-block mb-2" onclick="window.location.href = '<?php echo base_url("project/new_job/".$project['id']); ?>';">
                          <i class="mdi mdi-plus btn-icon-prepend"></i> Create Job</button>      
                        </div> 

                        <!-- Start Shedule modal-->
                         <div class="modal fade" id="exampleModal-2" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2">Shedule</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body form-group row">
                          
                             <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date</label>
                                <div class="col-sm-9">
                                  <div id="datepicker-popup" class="input-group date datepicker">
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon input-group-append border-left">
                                    <span class="ti-calendar input-group-text"></span>
                                   </span>
                                 </div>
                                </div>
                              </div>
                            </div>
                          
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Time</label>
                                <div class="col-sm-9">
                                 <div class="input-group date" id="timepicker-example1" data-target-input="nearest">
                                   <div class="input-group" data-target="#timepicker-example1" data-toggle="datetimepicker">
                                   <input type="text" class="form-control datetimepicker-input" data-target="#timepicker-example1"/>
                                   <div class="input-group-addon input-group-append"><i class="ti-time input-group-text"></i></div>
                                 </div>
                               </div>
                              </div>
                              </div>
                            </div>
                                      <div class="col-md-12">
                                       <div class="form-group">
                                          <textarea class="form-control" id="exampleTextarea1" rows="4" placeholder="Note"></textarea>
                                        </div>
                                      </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary">Shedule</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                        <!-- End Shedule modal-->


                      </div>
                      <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav profile-navbar">

                          <div class="col-sm-12">
                          <li class="nav-item">
                              <font size=".5" color="grey"><i class="mdi mdi-calendar-clock btn-icon-prepend"></i> Sheduled on: 24/March/2019 10:00am &nbsp;:&nbsp;&apos; Note............................................. &apos;</font>
                          </li>
                          </div>

                          <div class="col-sm-12">
                          <li class="nav-item">
                              <font size=".5" color="grey"><i class="mdi mdi-calendar-clock btn-icon-prepend"></i> Sheduled on: 24/March/2019 10:00am &nbsp;:&nbsp;&apos; Note.............................................. &apos;</font>
                          </li>
                          </div>



                        </ul>
                      </div>

                      <div class="profile-feed">
                      <div class="project_pending_jobs">
                    <?php foreach($project_pending_jobs as $project_job)
                    {
                      $photo = $project_job['photo'];
                      ?>


                        <div class="d-flex align-items-start profile-feed-item pending_job_<?php echo $project_job['id'];?>">
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
                                 <a onclick="showSwal('warning-message-and-cancel')" class="text-danger"><i class="mdi mdi-window-close"></i> Remove</a>
                              </small> 
                            </h6>
                            <p>
                              <?php echo $project_job['description'];?>
                            </p>
                              <button onclick="finish_job('<?php echo $project_job['project_id'];?>', '<?php echo $project_job['id'];?>')" type="button" class="btn btn-success btn-sm finish_project"><i class="ti-flag mr-1"></i> Finish</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.location.href = 'job-post.html';"><i class="ti-comment mr-1"></i> Post</button>
                         </div>
                      </div>

                      <?php 
                      }
                      ?>
                    </div>
                      <br>
                      <!-- ttttttttttt -->
                      <div class="project_completed_jobs">
                                              
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
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.location.href = 'job-post.html';"><i class="ti-comment mr-1"></i> Post</button>
                            <small class="text-success">Finished on&nbsp;12 Aug 2019 12:30am </small>
                         </div>
                        </div>
                      </div>
                    </div>   

                    <?php 
                  }
                    ?>
                  </div>


                      </div>
                    </div>
                  </div>
                </div>

              </div>
           
        </div>
      </div></div>




