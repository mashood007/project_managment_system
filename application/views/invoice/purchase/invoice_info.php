          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Purchase Invoice&nbsp;#<?php echo $invoice->no; ?></h4>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Seller</label>
                          <div class="col-sm-12">
                               <?php echo $seller; ?>
                          </div>
                        </div>
                      </div>


                    </div>


                   


                    
                  
                        
                   

           <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Cart List</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr class="table-dark">
                          <th>No</th>
                          <th>Item</th>
                          <th>Qty</th>
                          <th>Price</th>
                          <th>GST</th>
                          <th>Total Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (sizeof($cart) > 0)
                        {
                        
                        $slno = 0;
                        $subtotal = 0.0;
                        $gst = 0.0;
                        foreach ($cart as $row) {
                          $slno =+ 1;
                          $subtotal += $row['total']; 
                          $gst += $row['gst'];
                         ?>
                                           
                        <tr>
                          <td><?php echo $slno; ?></td>
                          <td><?php echo $row['item'];?></td>
                          <td><?php echo $row['quantity']." ".$row['unit_label'];?></td>
                          <td>₹<?php echo $row['price'];?></td>
                          <td>₹<?php echo $row['gst'];?></td>
                          <td><b>₹<?php echo $row['total'];?></b></td>
                        </tr>


                        <?php
                        $slno = $slno + 1;
                        }

                         }
                        else
                        {
                          echo "<tr></tr>";
                        }
                        ?>  
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
                             Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹<?php echo $subtotal - $gst; ?><br>
                             
                             Taxable Value: ₹<?php echo $subtotal - $gst; ?>
                              <br>
                            <?php if ($invoice->purchase_type == 0){?>
                              CGST:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹<?php echo $gst/2;?><br>
                              SGST:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹<?php echo $gst/2;?>
                            
                            <?php }else{?>

                              IGST:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹<?php echo $gst;?>
                                       
                            <?php }   ?>  

                             <br><br>
                             CESS<br>
          <?php 
            $total_cess = 0;                     
          if (sizeof($cess) > 0)
          {
          foreach($cess as $row)
          { 
            $cess_rate =($subtotal - $gst)*$row['cess']/100;
            $total_cess += $cess_rate;
            ?> <div style="margin-left: 17%;margin-top: -10px;padding: 6px;">:₹<?php echo $cess_rate."&nbsp;(".$row['name']; ?>)</div>
        <?php 
            }
            }

          ?>
                             <div class="display-4"><font size="5" color="#0082DC">Total Amount: ₹<?php echo $subtotal + $total_cess;?></font></div>
                            </div>

                          <div class="col-sm-6">
                           <div class="form-group">
                            <label for="exampleTextarea1">About Purchase</label>
                             <p class="card-description"> <?php echo $invoice->about; ?>  </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-12 col-form-label"><font size="5" class="text-dark">Cash Paid </font>
                            <font size="5" class="text-success">₹<?php echo $invoice->cash_paid; ?></font>

                             by <?php echo $invoice->mode; ?><br>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-12 col-form-label">
                          <b>Purchased on:</b>&nbsp;<?php echo date("d-M-Y", strtotime($invoice->purchase_date)); ?><br>
                          <b>Purchased by:</b>&nbsp;<?php echo $invoice->created_by_name; ?></label>
                        </div>
                      </div>
                    </div>


                        <!-- Start Follow modal-->
                              <div class="modal fade" id="show_image" tabindex="-1" role="dialog" aria-labelledby="assign_modal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel-2">Image</h5>
                                      <button type="button" onclick="close_modal()" class="close close_modal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                          
                                    <div class="modal-body">

                                    <div class="col-md-12">
                <?php $photo = $invoice->invoice_image; ?>
      <img src="<?php echo base_url(!empty($photo)? '/upload/purchase_invoice/'.$photo : 'assets/images/client1.jpg'); ?>" class="img-rounded"  width="304" height="236"> 
                                    </div>


                                      <div class="col-md-12" style="text-align: right;">
                                  <button type="button" class="btn btn-light cancel-form" onclick="close_modal()">Cancel</button>
                                    </div>

                                    </div> 
                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->


                   

                    <button type="submit" class="btn btn-primary mr-2" onclick="show_image();">
                      <i class="ti-camera"></i> Show Image</button>
                    <button type="submit" class="btn btn-dark mr-2" onclick="window.location.href = '<?php echo base_url("invoice/purchase/print/".$invoice->id); ?>'">
                      <i class="ti-printer"></i> Print</button>
                    <button type="submit" onclick="window.location.href = '<?php echo base_url("invoice/purchase/invoice_return/".$invoice->id); ?>'" class="btn btn-inverse-dark mr-2"><i class="ti-write"></i> Return</button>
                    <button class="btn btn-warning" onclick="window.location.href = '<?php echo base_url("invoice/purchase/edit/".$invoice->id); ?>'">
                      <i class="ti-pencil"></i> Edit</button>
                    <button type="submit" class="btn btn-danger mr-2" onclick="window.location.href = '<?php echo base_url("invoice/purchase_report"); ?>'"><i class="ti-trash"></i> Cancel</button>
                    
                </div>

              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->

                        
                        <script type="text/javascript">
                          $('#total_price').html("<?php echo $total; ?>")
                        </script>
                        