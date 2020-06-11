
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">Create a task</h4>
                  <?php echo form_open("task_manager/edit/".$task['id']) ?>
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
                                if ($row['task_to'] == $task['employee_id'])
                                {
                                  echo "<option selected  value='".$row['task_to']."'>".$row['nick_name']."</option>";
                                }
                                else
                                {
                                  echo "<option  value='".$row['task_to']."'>".$row['nick_name']."</option>";
                                }
                             }?>
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
                              <input value="<?php echo $task['alert_date'];?>" name="alert_date" type="text" class="form-control">
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
                          <input value="<?php echo $task['alert_time'];?>" type="text" name="alert_time" class="form-control datetimepicker-input" data-target="#timepicker-example"/>
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
                            <input name="name" value="<?php echo $task['name'];?>" type="text" class="form-control" placeholder="request Subject" />
                          </div>
                        </div>
                      </div>
                    </div>


                     <div class="form-group">
                      <label for="exampleTextarea1">Description</label>
                      <textarea name="description" class="form-control" id="exampleTextarea1" rows="4" placeholder="Write your request details.."><?php echo $task['description'];?></textarea>
                    </div>



                     <button type="submit" class="btn btn-primary btn-block mb-2">Create Task</button>
                     <?php echo form_close() ?>

                    <button class="btn btn-light">Cancel</button>
                </div>
              </div>
            </div>

       