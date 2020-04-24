 <input type="hidden" id="units_url" value="<?php echo base_url("invoice/sales/item_units"); ?>">

          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Order Meterials</h4>
                                                   
                      
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <select class="js-example-basic-single w-100" id="purchase_items" onchange="get_item()">
                              <option value="">Item</option>
                              <?php foreach ($products as $row) { ?>
                                <option value="<?php echo $row['id'];?>">
                                  <?php echo $row['product_name']; ?>
                                </option>
                             <?php } ?>
                           </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-3">
                            <input type="number" step="0.01" id="item_quantity" class="form-control" placeholder="QTY" />
                          </div>
                          <div class="col-sm-6">
                            <select class="form-control" id="units_list">
                              <option value="">-</option>
                              
                            </select>
                          </div>
                          <div class="col-sm-3">
                            <button type="button" onclick="add_mu_item('<?php echo base_url("projects/meterial_order/add_item/");?>')" class="btn btn-primary btn-icon-text">
                                ADD
                              </button>
                          </div>
                        </div>
                      </div>
                    </div>

                  

           <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Order Items</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr class="table-dark">
                          <th>No</th>
                          <th>Item</th>
                          <th>Qty</th>
                          <th>Modify</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody class="used_items">
                      <?php 
                      $slno = 0;
                      foreach ($items as $row) {
                        $slno += 1;
                        ?>
                        <tr>
                          <td><?php echo $slno; ?></td>
                          <td><?php echo $row['product_name']; ?></td>
                          <td><?php echo $row['quantity']." ".$row['unit_name']; ?></td>
                          <td> <span class="btn btn-outline-primary" onclick="edit_cart('<?php echo $row['id'];?>')">
                          <i class="ti-pencil"></i></span>



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
                                        <label class="col-sm-4 col-form-label">Qty<font color="red">*</font></label>
                                        <div class="col-sm-8">
                                          <input type="text"  id="quantity" value="<?php echo $row['quantity']; ?>" class="form-control" />
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-12">
                                      <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Unit<font color="red">*</font></label>
                                        <div class="col-sm-8">
                                        <select class="form-control" id="unit_id">
                                          <option value="<?php echo $row['base_unit_id']?>">
                                            <?php echo $row['base_unit_name'];?>
                                          </option>
                                        <option value="<?php echo $row['secondary_unit_id']?>">
                                          <?php echo $row['secondary_unit_name'];?>
                                        </option>                                          

                                        </select>
                                        </div>
                                      </div>
                                    </div>


                                      <div class="col-md-12" style="text-align: right;">
                           <button onclick="update_meterial_qty('<?php echo base_url("projects/meterial_order/update_qty/");?>', '<?php echo $row['id'];?>')" class="btn btn-success">Save Changes</button>
                                  <button type="button" class="btn btn-light cancel-form" onclick="close_modal()">Cancel</button>
                                    </div>

                                    </div> 
                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->
                        </td>

                          <td>
                          <span class="btn btn-outline-danger" onclick="update_meterial_qty('<?php echo base_url("projects/meterial_order/delete_item/");?>', '<?php echo $row['id'];?>')">
                            <i class="ti-trash"></i></span>
                        </td>

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
              <?php echo form_open("projects/meterial_order/create_order/".$project['id'], array('id' => 'order_form')) ?>              
                           <div class="form-group">
                            <label for="exampleTextarea1">About Order (Subject)</label>
                            <textarea name="subject" class="form-control" id="exampleTextarea1" rows="4"></textarea>
                          </div>
                <?php echo form_close() ?>          
                        </div>
                      </div>
                    </div>
                  </div>

       
                    <a class="btn btn-light" onclick="window.location.href='<?php echo base_url("projects/meterial_order/index/".$project["id"]); ?>'">
                      <i class="ti-angle-left"></i> Back</a>
                    <button onclick="$('#order_form').submit()" class="btn btn-outline-success mr-2"><i class="ti-receipt"></i> Create Order</button>
                    
                  
                </div>

              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
