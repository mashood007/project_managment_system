          <div class="row">
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Add Unit</h4>
                  <p class="card-description">
                    Enter the unit details.
                  </p>
                  <?php echo form_open("settings/unit") ?>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Full Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" name="full_name" class="form-control" placeholder="eg: Kilograme" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Short Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" name="short_name" class="form-control" placeholder="eg: KG " />
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <button class="btn btn-light">Cancel</button>
                    
                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->

<div class="card">
            <div class="card-body">
              <h4 class="display-4"> Units</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Unit Full Name</th>
                            <th>Short Name</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                  <?php
                  $slno = 1;
                  foreach($units as $row)
                  {
                    ?>
                        <tr id="row_<?php echo $row['id']; ?>">
                            <td>1</td>
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['short_name']; ?></td>
                            <td>
                                    <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <span class="dropdown-item" onclick="edit_tax('<?php echo $row['id'];?>')">Edit</span>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="deleteRow('<?php echo base_url('settings/unit/delete/'.$row['id']);?>')"><font color="red">Remove</a>
                                </div>
                              </div>
                            </td>
                        </tr>



                        <!-- Start Follow modal-->
                              <div class="modal fade" id="edit_tax_modal_<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="assign_modal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel-2">Edit Account</h5>
                                      <button type="button" onclick="close_modal()" class="close close_modal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                          
                                    <div class="modal-body">

                                    <div class="col-md-12">
                                    <?php echo form_open("settings/unit/update/".$row['id'],array('id' => 'edit_form_'.$row['id'] )) ?>                                      
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Full Name<font color="red">*</font></label>
                                        <div class="col-sm-9">
                                          <input type="text" value="<?php echo $row['full_name'];?>" name="full_name" class="form-control" placeholder="eg: Kilograme" />
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Short Name<font color="red">*</font></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="short_name" value="<?php echo $row['short_name'];?>" class="form-control" placeholder="eg: KG " />
                                        </div>
                                      </div>

                                    <?php echo form_close() ?>  

                                    </div>

                                      <div class="col-md-12" style="text-align: right;">
                                      <button onclick="$('#edit_form_<?php echo $row['id'];?>').submit()" class="btn btn-success">Save Changes</button>
                                  <span type="button" class="btn btn-light cancel-form" onclick="close_modal()">Cancel</span>
                                    </div>

                                    </div> 
                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->

                    <?php }?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

