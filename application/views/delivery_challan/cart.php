

                        <?php
                        if (sizeof($cart) > 0)
                        {
                        
                        $slno = 0;
                        $subtotal = 0.0;
                        $discound = 0.0;
                        $gst = 0.0;
                        foreach ($cart as $row) {
                          $slno += 1;
                          $subtotal += $row['total']; 
                          $discound += $row['discound'];
                          $gst += $row['gst'];
                         ?>
                                <tr>
                                  <td><?php echo $slno; ?></td>
                                  <td><?php echo $row['item'];?></td>
                                  <td><?php echo $row['quantity']." ".$row['unit_label'];?></td>
                                  <td>₹<?php echo $row['price'];?></td>
                                  <td>₹<?php echo $row['discound'];?></td>
                                  <td>₹<?php echo $row['gst'];?></td>
                                  <td><b>₹<?php echo $row['total'];?></b></td>
                                  <td>
              <button class="btn btn-outline-primary" onclick="edit_cart('<?php echo $row['id'];?>')">
                                      <i class="ti-pencil"></i></button>



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
                                        <label class="col-sm-4 col-form-label">Purchase Amount<font color="red">*</font></label>
                                        <div class="col-sm-8">
                                          <input type="text"  id="price" value="<?php echo $row['price']; ?>" class="form-control" />
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-12">
                                      <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Qty<font color="red">*</font></label>
                                        <div class="col-sm-8">
                                          <input type="text"  id="quantity" value="<?php echo $row['quantity']; ?>" class="form-control" />
                                        </div>
                                      </div>
                                    </div>




                                      <div class="col-md-12" style="text-align: right;">
                           <button onclick="update_cart('<?php echo base_url("delivery_challan_dep/cart/update/");?>', '<?php echo $row['id'];?>')" class="btn btn-success">Save Changes</button>
                                  <button type="button" class="btn btn-light cancel-form" onclick="close_modal()">Cancel</button>
                                    </div>

                                    </div> 
                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->



                                    </td>
                                  <td>
<span class="btn btn-outline-danger" onclick="delete_purchase_item('<?php echo base_url("delivery_challan_dep/cart/delete/".$row['id']);?>','<?php echo $row["id"]; ?>')"><i class="ti-trash"></i></span></td>

                                </tr>




                              <?php
                              
                               }
                               ?>
                        <script type="text/javascript">
var summary = "Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹<?php echo $subtotal; ?><br>Discount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹<?php echo $discound; ?><br>Taxable Value: ₹<?php echo $subtotal - $discound ; ?><br>IGST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹<?php echo $gst; ?><br><div class='display-4'><font size='5' color='#0082DC'>Total Amount: ₹<?php echo $subtotal + $gst - $discound ; ?></font></div>"

            $('#summary').html(summary);
                        </script>
                              <?php
                             }
                             else
                             {
                              echo "<tr><td></td></tr>";
                             }
                               ?>                        
                                                     
