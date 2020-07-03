
          
          <div class="row">
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Add new Skill</h4>
                  <p class="card-description">
                    Enter the Technical Skill details.
                  </p>
                  <?php echo form_open("settings/skill") ?>
                    <div class="form-group">
                      <label for="skill">Skill</label>
                      <input type="text" class="form-control" id="skill" name="skill" placeholder="Skill">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <span class="btn btn-light clear-input">Cancel</span>
                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->

<div class="card">
            <div class="card-body">
              <h4 class="display-4">Technical Skills</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Skill</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                  <?php
                  $slno = 0;
                  foreach($skills as $row)
                  {
                    ?>


                        <tr id="row_<?php echo $row['id'];?>">
                            <td><?php echo $slno += 1; ?></td>
                            <td><?php echo $row['skill']; ?></td>
                            <td>
                                    <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <span class="dropdown-item" onclick="edit_tax('<?php echo $row['id'];?>')">Edit</span>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="deleteRow('<?php echo base_url('settings/skill/delete/'.$row['id']);?>')"><font color="red">Remove</a>
                                </div>
                              </div>
                            </td>
                        </tr>


                        <!-- Start Follow modal-->
                              <div class="modal fade" id="edit_tax_modal_<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="assign_modal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel-2">Edit Skill</h5>
                                      <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                          
                                    <div class="modal-body">

                                    <div class="col-md-12">
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Designation<font color="red">*</font></label>
                                        <div class="col-sm-9">
                                          <input type="text"  id="skill" value="<?php echo $row['skill']; ?>" class="form-control" placeholder="skill" />
                                        </div>
                                      </div>
                                    </div>

                                      <div class="col-md-12" style="text-align: right;">
                                      <button onclick="updateSkill('<?php echo base_url("/settings/skill/update/");?>', '<?php echo $row['id'];?>')" class="btn btn-success">Save Changes</button>
                                  <button type="button" class="btn btn-light cancel-form" onclick="close_modal()">Cancel</button>
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




