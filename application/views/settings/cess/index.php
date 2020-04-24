
          
          <div class="row">
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Add new Cess</h4>

                  <?php echo form_open("settings/cess") ?>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Cess Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" required name="name" class="form-control" placeholder="eg: Cess@1%" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Cess Rate<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="number" step="0.01" required name="cess" class="form-control" placeholder="%" />
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
              <h4 class="display-4">Cess</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                         <tr>
                            <th>#</th>
                            <th>Cess Name</th>
                            <th>Cess Rate</th>
                            <th>Edit</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                  <?php
                  $slno = 1;
                  foreach($cess as $row)
                  {
                    ?>

                        <tr>
                            <td>1</td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['cess']; ?></td>
                            <td>
                              <button onclick="edit_cess('<?php echo $row['id'];?>')" class="btn btn-outline-primary">Edit</button>
                            </td>
                            <td>
                              <button class="btn btn-outline-danger" onclick="showSwal('warning-message-and-cancel')">Remove</button>
                            </td>
                        </tr>

                        <!-- Start Follow modal-->
                              <div class="modal fade" id="edit_cess_modal_<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="assign_modal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel-2">Edit Cess</h5>
                                      <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                          
                                    <div class="modal-body">

                                    <div class="col-md-12">
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">cess Name<font color="red">*</font></label>
                                        <div class="col-sm-9">
                                          <input type="text"  id="cess_name" value="<?php echo $row['name']; ?>" class="form-control" placeholder="eg: GST@18%" />
                                        </div>
                                      </div>
                                    </div>


                                      <div class="col-md-12">
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Cess Rate<font color="red">*</font></label>
                                          <div class="col-sm-9">
                                            <input type="number" step="0.01" id="cess_rate" class="form-control" value="<?php echo $row['cess']; ?>" placeholder="%" />
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-12" style="text-align: right;">
                                      <button onclick="update_cess('<?php echo base_url("/settings/cess/update");?>', '<?php echo $row['id'];?>')" class="btn btn-success">Save Changes</button>
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




