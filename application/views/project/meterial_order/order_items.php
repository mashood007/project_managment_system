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
                           <button onclick="update_meterial_qty('<?php echo base_url("projects/meterial_order/update_qty_in_order/".$order_id."/");?>', '<?php echo $row['id'];?>')" class="btn btn-success">Save Changes</button>
                                  <button type="button" class="btn btn-light cancel-form" onclick="close_modal()">Cancel</button>
                                    </div>

                                    </div> 
                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->
                        </td>


                        </tr>

                      <?php } ?>
