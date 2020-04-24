
         <div class="col-lg-12 grid-margin stretch-card">
              <div class="card" style="background-color:#f4fff0;">
                <div class="card-body">
                  <h4 class="display-4"><i class="ti-arrow-down"></i> To Complete</h4>
                  <p class="card-description">You have <code id="code_count">2</code> Task to complete!</p>
                  <div class="mt-4">
                    <div class="accordion accordion-solid-content" id="accordion-6" role="tablist">
                      
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
                      <div class="card">
                        <div class="card-header" role="tab" id="heading-<?php echo $row['id']; ?>">
                          <h6 class="mb-0">
                            <a data-toggle="collapse" href="#collapse-<?php echo $row['id']; ?>"  aria-expanded="false" aria-controls="collapse-<?php echo $row['id']; ?>">
                            <i class="ti-alarm-clock"></i><font> Hameed assigned to the task:</font>  <font color="#74be2b"> <?php echo $row['name']; ?></font>
                            </a>
                          </h6>
                        </div>
                        <div id="collapse-<?php echo $row['id']; ?>" class="collapse" role="tabpanel" aria-labelledby="heading-<?php echo $row['id']; ?>"data-parent="#accordion-6">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-3">
                                <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" class="mw-100" alt="image"/>                    
                              </div>

                              <?php echo form_open("task_manager/finish_task") ?>
                              <div class="col-9">
                                <p class="mb-0"><?php echo $row['description']; ?></p> <br>
                                     <div class="form-group row">
                                      <div class="col-sm-12">
                                       <input type="text" name="replay" class="form-control" placeholder=" Your Reply.." />
                                       <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                      </div>
                                     </div>
                                <button type="submit" class="btn btn-primary btn-block mb-2">Finish Task</button>           
                              </div>
                              <?php echo form_close() ?>

                            </div>
                          </div>
                        </div>
                      </div>
                      <?php } ?>

                      
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
              <h4 class="display-4">Completed Tasks</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                             <th>#</th>
                            <th>Assigned by</th>
                            <th>Reply</th>
                            <th>Task Name</th>
                            <th>Description</th>
                            <th>Assigned on</th>
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
                            <td><?php echo $row['replay'];?></td>
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

