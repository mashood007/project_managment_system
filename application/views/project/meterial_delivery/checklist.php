          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Delivery Checklist</h4>
                    <p class="card-description">
                      Delivery Challan&nbsp;#<?php echo $delivery_challan->id; ?>
                    </p>


           <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Delivered Items</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr class="table-dark">
                          <th>No</th>
                          <th>Item</th>
                          <th>Qty</th>
                          <th>Modify</th>
                        </tr>
                      </thead>
                      <tbody class="Checklist">

                        <?php 
                        $slno = 0;
                        foreach ($cart as $row ) {
                          $slno +=1;

                          ?>
                        
                        <tr>
                          <td><?php echo $slno; ?></td>
                          <td><?php echo $row['item_label'];?></td>
                          <td><?php echo $row['quantity']." ".$row['unit_label'];?></td>
                          <td> <spam class="btn btn-outline-primary" onclick="edit_cart('<?php echo $row['id'];?>')">
                                      <i class="ti-pencil"></i></span></td>



                        <!-- Start Follow modal-->
                              <div class="modal fade edit_cart" id="edit_cart_modal_<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="assign_modal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel-2">Edit Item</h5>
                                      <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                          
                                    <div class="modal-body">

                                    <div class="col-md-12">
                                      <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Qty (<?php echo $row['unit_label']; ?>)<font color="red">*</font></label>
                                        <div class="col-sm-8">
                                          <input type="text"  id="quantity" value="<?php echo $row['quantity']; ?>" class="form-control" />
                                        </div>
                                      </div>
                                    </div>


                                      <div class="col-md-12" style="text-align: right;">
                           <button onclick="update_qty('<?php echo base_url("projects/meterial_delivery/update_qty/".$row['dc_id']."/");?>', '<?php echo $row['id'];?>')" class="btn btn-success">Save Changes</button>
                                  <button type="button" class="btn btn-light cancel-form" onclick="close_modal()">Cancel</button>
                                    </div>

                                    </div> 
                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->
                        </tr>
                      <?php } ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

                   
                    

                   <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">

                            <div class="col-sm-6">
                             <b>Send on:</b>&nbsp;<?php echo date("d-M-Y", strtotime($delivery_challan->delivery_date));?><br>
                             <b>About Delivery:</b>&nbsp;<?php echo $delivery_challan->about; ?><br>
                             <b>Send by:</b>&nbsp;<?php echo $delivery_challan->emp_name; ?><br>
                            </div>


                          <div class="col-sm-6">
                            <?php echo form_open("projects/meterial_delivery/update_check_list/".$delivery_challan->id, array('id' => 'check_list_form')) ?>
                           <div class="form-group">
                            <label for="about_checklist">About Checklist</label>
                            <textarea class="form-control" name="about_checklist" id="about_checklist" rows="4">
                              <?php echo $delivery_challan->about_checklist; ?>
                            </textarea>
                          </div>
                          <?php echo form_close() ?>

                        </div>
        
                      </div>
                    </div>
                  </div>


       
                    <a class="btn btn-light" href="<?php echo base_url("projects/meterial_delivery/info/".$delivery_challan->delivery_for);?>" >
                      <i class="ti-angle-left"></i> Back</a>
                    <button onclick="$('#check_list_form').submit();" class="btn btn-success mr-2"><i class="ti-save"></i> Delivered</button>
                    
                </div>

              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
