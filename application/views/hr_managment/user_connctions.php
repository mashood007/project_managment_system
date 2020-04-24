<input type="hidden" id="base_url" value="<?php echo base_url("/hrmanagement/apply_user_connection_settings");?>">
           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                    <?php $photo = $profile_info['photo'];?>
                        <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/lockscreen-bg.jpg'); ?>" alt="profile" class="img-lg rounded-circle mb-3"/>                    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                      <h6 class="mb-0"><?php echo $profile_info['full_name']; ?></h6>
                      <p class="text-muted mb-1"><?php echo $profile_info['designation']; ?></p>
                   
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
                            <a class="nav-link" href="user-profile-info.html">
                              <i class="ti-user"></i>
                              Info
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link " href="user-profile-jobs.html">
                              <i class="ti-vector"></i>
                              Jobs
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="user-profile-payroll.html">
                              <i class="ti-receipt"></i>
                              Payroll
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="user-profile-sale.html">
                              <i class="ti-briefcase"></i>
                              Sales
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

                


                  <div class="card">
            <div class="card-body">
              <h4 class="display-4">Connections</h4>
              <div class="row">
                  

                  <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Messaging</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-multiple w-100" name="messaging" id="messaging_to" multiple="multiple">
                            <?php
                            foreach($deployments as $row) 
                              { 
                            if (in_array($row['id'], $messaging_to_user))
                              {?>
                              <option selected value="<?php echo $row['id']; ?>"><?php echo $row['nick_name']; ?></option>
                            <?php }
                            else
                              {?>
                              <option value="<?php echo $row['id']; ?>"><?php echo $row['nick_name']; ?></option>
                            <?php }
                            }
                            ?>
                            </select>
                          </div>
                        </div>
                </div><br><br>


                <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Requesting</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-multiple w-100" name="requesting" id="requests_to" multiple="multiple">
                            <?php
                            foreach($deployments as $row) 
                              { 
                            if (in_array($row['id'], $requests_to_user))
                              {?>
                              <option selected value="<?php echo $row['id']; ?>"><?php echo $row['nick_name']; ?></option>
                            <?php }
                            else
                              {?>
                              <option value="<?php echo $row['id']; ?>"><?php echo $row['nick_name']; ?></option>
                            <?php }
                            }
                            ?>
                    </select>
                          </div>
                        </div>
                </div><br><br>



                <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Task to</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-multiple w-100" name="task" id="task_to" multiple="multiple">
                            <?php
                            foreach($deployments as $row) 
                              { 
                            if (in_array($row['id'], $tasks_to))
                              {?>
                              <option selected value="<?php echo $row['id']; ?>"><?php echo $row['nick_name']; ?></option>
                            <?php }
                            else
                              {?>
                              <option value="<?php echo $row['id']; ?>"><?php echo $row['nick_name']; ?></option>
                            <?php }
                            }
                            ?>
                    </select>
                          </div>
                        </div>
                </div>

</div>    

<button type="submit" class="btn btn-success" id="make_user_connections" data-user=<?php echo $user_id;?>>Apply Settings</button>
            </div>
          </div>
        </div>

                </div>



              </div>





        </div>
      </div>
