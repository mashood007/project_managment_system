
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">Create a task</h4>
                  <?php echo form_open("task_manager/index") ?>
                    <p class="card-description">
                      Task details
                    </p>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">To</label>
                          <div class="col-sm-9">
                            <select name="employee_id" class="js-example-basic-single w-100">
                              <option  value="">-</option>
                               <?php
                              foreach($tasks_to as $row)
                              {
                              ?>
                                <option value="<?php echo $row['task_to']; ?>"><?php echo $row['nick_name']; ?></option>
                              <?php }?>
                           </select>
                          </div>
                        </div>
                      </div>
                    </div>

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Alert Date</label>
                          <div class="col-sm-9">
                            <div id="datepicker-popup" class="input-group date datepicker">
                              <input name="alert_date" type="text" class="form-control">
                              <span class="input-group-addon input-group-append border-left">
                              <span class="ti-calendar input-group-text"></span>
                             </span>
                           </div>
                          </div>
                        </div>
                      </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Alert Time</label>
                          <div class="col-sm-9">
                      <div class="input-group date" id="timepicker-example" data-target-input="nearest">
                        <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
                          <input type="text" name="alert_time" class="form-control datetimepicker-input" data-target="#timepicker-example"/>
                          <div class="input-group-addon input-group-append"><i class="ti-time input-group-text"></i></div>
                        </div>
                      </div>
                        </div>
                        </div>
                      </div>
                    
                  </div>

                    
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Task Name</label>
                          <div class="col-sm-12">
                            <input name="name" type="text" class="form-control" placeholder="request Subject" />
                          </div>
                        </div>
                      </div>
                    </div>


                     <div class="form-group">
                      <label for="exampleTextarea1">Description</label>
                      <textarea name="description" class="form-control" id="exampleTextarea1" rows="4" placeholder="Write your request details.."></textarea>
                    </div>



                     <button type="submit" class="btn btn-primary btn-block mb-2">Create Task</button>
                     <?php echo form_close() ?>

                    <button class="btn btn-light">Cancel</button>
                </div>
              </div>
            </div>

       






            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body" style="background-color:#fff2f2;">
                  <h4 class="display-4"><i class="ti-arrow-up"></i> Pending Tasks</h4>
                  <p class="card-description">Your <code id="code_count">2</code> task is pending!</p>
                  <div class="mt-4">
                    <div class="accordion accordion-bordered" id="accordion-6" role="tablist" >
                      
                    <?php
                     $count = 0;  
                   foreach($tasks as $row)
                    {
                        if ($row['status'] == 1)
                        {
                        continue;
                        }
                        $photo = $row['image'];  
                         $count = $count+1;  
                    ?>
<!---***********--->
                      <div class="card">
                        <div class="card-header" role="tab" id="heading-<?php echo $row['id']; ?>">
                          <h6 class="mb-0">
                            <a data-toggle="collapse" href="#collapse-<?php echo $row['id']; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $row['id']; ?>" >
                             <font color="red">
                              <?php echo $row['name']; ?>
                             </font>
                            </a>
                          </h6>
                        </div>
                        <div id="collapse-<?php echo $row['id']; ?>" class="collapse" role="tabpanel" aria-labelledby="heading-<?php echo $row['id']; ?>" data-parent="#accordion-6">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-3">
                                <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" class="mw-100" alt="image"/>                    
                              </div>
                              <div class="col-9">
                                <p class="mb-0"><?php echo $row['description']; ?></p>
                                <font color="grey" size="0.2"><strong><font color="red">To</font></strong> <?php echo $row['nick_name']; ?></font><br><br>
                                <a href="<?php echo base_url('task_manager/delete/'.$row['id']);?>" class="btn btn-danger btn-rounded btn-fw">Cancel</a>        
                                <a href="<?php echo base_url('task_manager/edit/'.$row['id']);?>" class="btn btn-warning btn-rounded btn-fw">Edit</a>      
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>

<!---***********--->

                      
                    </div>
                  </div>
                </div>
              </div>
            </div>


<script type="text/javascript">
  $("#code_count").html('<?php echo $count; ?>')

</script>


        <!-- content-wrapper ends -->

<div class="card">
            <div class="card-body">
              <h4 class="display-4">Your Task History</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                             <th>#</th>
                            <th>To</th>
                            <th>Reply</th>
                            <th>Task Name</th>
                            <th>Description</th>
                            <th>Added on</th>
                            <th>Completed on</th>
                        </tr>
                      </thead>
                      <tbody>
              
                    <?php
                   foreach($tasks as $row)
                    {
                        if ($row['status'] == 0)
                        {
                        continue;
                        }
                        $photo = $row['image'];  
                    ?>

                        <tr>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" alt="profile"/></div></td>
                            <td><?php echo $row['nick_name']; ?></td>
                            <td><?php echo $row['replay']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td><?php echo $row['completed_on']; ?></td>
                        </tr>

                      <?php } ?>  
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
