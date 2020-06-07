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