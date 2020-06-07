

                              <?php
                                if (sizeof($cart) > 0)
                                {
                              $slno = 1;
                              $price = 0;
                              $total = 0;
                              $gst = 0;
                              foreach($cart as $row)
                               {
                                $price += $row['price'];
                                $total += $row['total'];
                                $gst += $row['gst'];
                               ?>
                                <tr>
                                  <td><?php echo $slno; ?></td>
                                  <td><?php echo $row['item'];?></td>
                                  <td><?php echo $row['quantity']." ".$row['unit_label'];?></td>
                                  <td>₹<?php echo $row['price'];?></td>
                                  
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
                           <button onclick="update_cart('<?php echo base_url("/invoice/purchase/update_cart/");?>', '<?php echo $row['id'];?>')" class="btn btn-success">Save Changes</button>
                                  <button type="button" class="btn btn-light cancel-form" onclick="close_modal()">Cancel</button>
                                    </div>

                                    </div> 
                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->



                                    </td>
                                  <td>
<span class="btn btn-outline-danger" onclick="delete_purchase_item('<?php echo base_url("invoice/purchase/delete_temp/".$row['id']);?>','<?php echo $row["id"]; ?>')"><i class="ti-trash"></i></span></td>

                                </tr>




                              <?php
                              $slno = $slno + 1;
                               }
                               ?>
                        <script type="text/javascript">
                          $('#total_price').html("<?php echo $total- $gst; ?>")
                          $('#total_amount').html("<?php echo $total; ?>")
                          $('#total_gst').html("<?php echo $gst;?>")
                        </script>
                              <?php
                             }
                             else
                             {
                              echo "<tr></tr>";
                             }
                               ?>                        
                                                     
