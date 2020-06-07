           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body"> 

                
                  <div class="card">
            <div class="card-body">
              <h4 class="display-4"><?php echo $role['designation'];?> (Role name)</h4><h6 class="display-9">Access Permissions</h6>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive"><br><br>
                        <?php
                        foreach ($pages as $key => $value) {
                          ?>
                          <h4 class="card-title"><?php echo $key;?></h4>
                          <div class="form-group">
                          <?php
                          foreach ($value as $row) {
                            $flag = array_search($row->id,$permissions) > -1 ? 1 : 0 ;
                            ?>
                              <div class="form-check form-check-primary">
                                <label class="form-check-label">
                                  <input type="checkbox" data-id="<?php echo $row->id; ?>" class="form-check-input pages" <?php if ($flag){ echo "checked";} ?>>
                                  <?php echo $row->name;?>
                                </label>
                              </div>                            
                            <?php
                            }
                          ?>
                          </div><br>
                          <?php
                        }
                        ?>
                        <button data-id="<?php echo $role['id'];?>" class="update_permissions btn btn-primary mr-2">Apply Settings</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

                </div>



              </div>





        </div>
      </div>
