        
          <h4 class="display-4">Company Employees</h4>
                  <div class="form-group">
                    <label>Filter Employees Grid by Role</label>
                    <select class="js-example-basic-single w-100" id="roles_list">
                      <?php
                      foreach($roles as $row)
                      {?>
                      <option value="<?php echo $row['id']; ?>"><?php echo $row['designation']; ?></option>
                      <?php }?>
                    </select>
                  </div>
          
         
         <div class="row">

                        <?php
                        $slno = 1;
                        foreach($deployments as $row)
                        {
                          $role = $this->role_model->getRoleDetails($row['role']);
                          ?>

            <div class="col-md-4 grid-margin stretch-card role_<?php echo $row['role'];?> role_card">
              <div class="card">
                <div class="card-body">
                  <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                   <a href="user-profile-info.html"> <img src="<?php echo base_url('assets/images/logo-mini.svg');?>" class="img-lg rounded" alt="employee photo"/></a>
                    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                      <h6 class="mb-0"><?php echo $row['nick_name'];?></h6>
                      <p class="text-muted mb-1"><?php echo $row['user_name'];?></p>
                      <p class="mb-0 text-success font-weight-bold"><?php echo $role['designation'];?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php }?>
          </div>



</div>
<style type="text/css">
  .select2-selection__rendered{margin-top: -5px;}
  .select2-container .select2-selection--single{height: 45px;}

</style>