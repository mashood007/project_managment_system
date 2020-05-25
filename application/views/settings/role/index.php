
          
          <div class="row">
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Add new</h4>
                  <p class="card-description">
                    Enter the Technical Designation details.
                  </p>
                  <?php echo form_open("settings/role") ?>
                    <div class="form-group">
                      <label for="role">Role</label>
                      <input type="text" class="form-control" id="role" name="designation" placeholder="Designation">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" >Save</button>
                    <button class="btn btn-light">Cancel</button>
                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
          </div>


<div class="card">
            <div class="card-body">
              <h4 class="display-4">Roles</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Employees</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>

                  <?php
                  $slno = 1;
                  foreach($roles as $row)
                  {
                    ?>
                        <tr id="row_<?php echo $row['id'];?>">
                            <td><?php echo $slno;?></td>
                            <td><?php echo $row['designation']?></td>
                            <td>3</td>
                            
                            <td>
                                    <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <?php if ($row['id'] > 1) {?>
                                  <a class="dropdown-item" href="<?php echo base_url('settings/role/permissions/'.$row['id']);?>">Permission</a>
                                <?php } ?>
                                  <span class="dropdown-item" onclick="edit_tax('<?php echo $row['id'];?>')">Edit</span>
                                  <?php if ($row['id'] > 1) {?>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="deleteRow('<?php echo base_url('settings/role/delete/'.$row['id']);?>')"><font color="red">Remove</a>
                                    <?php } ?>
                                </div>
                              </div>
                            </td>
                        </tr>                    






                        <!-- Start Follow modal-->
                              <div class="modal fade" id="edit_tax_modal_<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="assign_modal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel-2">Edit Role</h5>
                                      <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                          
                                    <div class="modal-body">

                                    <div class="col-md-12">
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Designation<font color="red">*</font></label>
                                        <div class="col-sm-9">
                                          <input type="text"  id="designation" value="<?php echo $row['designation']; ?>" class="form-control" placeholder="eg: GST@18%" />
                                        </div>
                                      </div>
                                    </div>

                                      <div class="col-md-12" style="text-align: right;">
                                      <button onclick="updateRole('<?php echo base_url("/settings/role/update/");?>', '<?php echo $row['id'];?>')" class="btn btn-success">Save Changes</button>
                                  <button type="button" class="btn btn-light cancel-form" onclick="close_modal()">Cancel</button>
                                    </div>

                                    </div> 
                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->





                    
                    <?php
                    $slno = $slno +1;
                  }
                  ?>

                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
