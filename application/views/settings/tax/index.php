
          
          <div class="row">
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body ">
                  <h4 class="display-2">Add new Tax</h4>

                  <?php echo form_open("settings/tax") ?>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Tax Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" required name="name" class="form-control" placeholder="eg: GST@18%" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Tax Rate<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="number" step="0.01" required name="tax" class="form-control" placeholder="%" />
                          </div>
                        </div>
                      </div>
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <span onclick="$('input').val('')" class="btn btn-light">Cancel</span>
                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->

<div class="card">
            <div class="card-body">
              <h4 class="display-4">Taxes</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                         <tr>
                            <th>#</th>
                            <th>Tax Name</th>
                            <th>Tax Rate</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                  <?php
                  $slno = 1;
                  foreach($tax as $row)
                  {
                    ?>
                        <tr id="row_<?php echo $row['id'];?>">
                            <td><?php echo $slno;?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['tax']; ?></td>
                            <td>
                                    <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <span class="dropdown-item" onclick="edit_tax('<?php echo $row['id'];?>')">Edit</span>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="deleteRow('<?php echo base_url('settings/tax/delete/'.$row['id']);?>')"><font color="red">Remove</a>
                                </div>
                              </div>
                            </td>
                        </tr>

                        <!-- Start Follow modal-->
                              <div class="modal fade" id="edit_tax_modal_<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="assign_modal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel-2">Edit Tax</h5>
                                      <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                          
                                    <div class="modal-body">

                                    <div class="col-md-12">
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Tax Name<font color="red">*</font></label>
                                        <div class="col-sm-9">
                                          <input type="text"  id="tax_name" value="<?php echo $row['name']; ?>" class="form-control" placeholder="eg: GST@18%" />
                                        </div>
                                      </div>
                                    </div>


                                      <div class="col-md-12">
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Tax Rate<font color="red">*</font></label>
                                          <div class="col-sm-9">
                                            <input type="number" step="0.01" id="tax_rate"  name="tax" class="form-control" value="<?php echo $row['tax']; ?>" placeholder="%" />
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-12" style="text-align: right;">
                                      <button onclick="update_tax('<?php echo base_url("/settings/tax/update");?>', '<?php echo $row['id'];?>')" class="btn btn-success">Save Changes</button>
                                  <button type="button" class="btn btn-light cancel-form" onclick="close_modal()">Cancel</button>
                                    </div>

                                    </div> 
                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->



                    <?php
                    $slno += 1;
                     }?>     
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>




