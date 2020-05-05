            <div class="col-lg-12">
              <div class="card px-3">
                <div class="card-body">

                  <div class="float-sm-right"><font size="1">Shared with </font> <b>&nbsp;
                    <span id="emp_name"><?php echo $todo['nick_name'];?></span>
                      
                    </b>&nbsp;&nbsp;
                    <button type="button" onclick="assign_todo_modal()" class="btn btn-dark btn-sm">Assign</button>
                  </div>

 
                        <!-- Start Follow modal-->
                              <div class="modal fade assign_todo" tabindex="-1" role="dialog" aria-labelledby="assign_modal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel-2">Assign</h5>
                                      <button type="button"  onclick="close_modal()" class="close close_modal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                          
                                    <div class="modal-body">


                                    <div class="col-md-12">
                                      <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Employees<font color="red">*</font></label>
                                        <div class="col-sm-8">
                                          <select class="form-control" id="deployment">
                                            <option value="0">---</option>
                                      <?php foreach ($deployments as $row) {?>
                                              <option value="<?php echo $row['id']; ?>" <?php if($todo['assign'] == $row['id']){ echo "selected";}?> >
                                                <?php echo $row['nick_name']; ?>
                                              </option>
                                              <?php
                                       } ?>
                                          </select>
                                        </div>
                                      </div>
                                    </div>


                                      <div class="col-md-12" style="text-align: right;">
                           <button onclick="assignTodo('<?php echo $todo['id']; ?>')" class="btn btn-success">Assign</button>
                                  <button type="button" class="btn btn-light cancel-form" onclick="close_modal()">Cancel</button>
                                    </div>

                                    </div> 
                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->


                  <h4 class="display-4"><?php echo $todo['name'];?></h4><br>

                  <div class="add-items d-flex">
                    <input type="text" class="form-control todo-list-input"  placeholder="Add new task">
                    <button data-url="<?php echo base_url('project/add_todo_task/'.$todo['id']); ?>" class="add btn btn-icon text-primary todo-list-add-task-btn bg-transparent"><i class="ti-location-arrow"></i></button>
                  </div>

                  <div class="list-wrapper">
                    <ul class="d-flex flex-column-reverse todo-list">
                      <?php foreach ($todo_tasks as $row) {
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
              </div>
            </div>
           </div>
  