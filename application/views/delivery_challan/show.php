          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Delivery Challan&nbsp;#<?php echo $delivery_challan->id; ?></h4>
                  <form class="form-sample">

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">To/From</label>
                          <div class="col-sm-12">
                               <b><?php echo $project; ?></b>,&nbsp;

                               <font size="2"><?php echo $delivery_challan->location; ?></font>
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
                          <th>Discound</th>
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
                                  
                        </tr>
                      <?php }
                          } 
                          else
                          {
                              echo "<tr><td></td></tr>";
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
                              Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹<?php echo $subtotal; ?><br>Discount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹<?php echo $discound; ?><br>Taxable Value: ₹<?php echo $subtotal - $discound ; ?><br>IGST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹<?php echo $gst; ?><br><div class='display-4'><font size='5' color='#0082DC'>Total Amount: ₹<?php echo $subtotal + $gst - $discound ; ?></font></div>
                            </div>

                          <div class="col-sm-6">
                           <div class="form-group">
                            <label for="exampleTextarea1">Reason</label>
                             <p class="card-description"> <?php echo $delivery_challan->reason; ?> </p><br>
                            <label for="exampleTextarea1">About Delivery</label>
                             <p class="card-description"> <?php echo $delivery_challan->about; ?> </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-12 col-form-label">
                          <b>Created on:</b>&nbsp;<?php echo $delivery_challan->created_at; ?><br>
                          <b>Created by:</b>&nbsp;<?php echo $delivery_challan->emp_name; ?></label>
                        </div>
                      </div>
                    </div>

                   


                    <button type="submit" class="btn btn-dark mr-2"><i class="ti-printer"></i> Print</button>
                    <button type="submit" class="btn btn-success mr-2"><i class="ti-layers"></i> Copy Link</button>
                    <a  class="btn btn-inverse-dark mr-2" href="<?php echo base_url('delivery_challan/copy_to_invoice/'.$delivery_challan->id);?>" ><i class="ti-shopping-cart"></i> Copy to Invoice</a>
                    <a class="btn btn-warning" href="<?php echo base_url('delivery_challan/edit/'.$delivery_challan->id);?>" ><i class="ti-pencil"></i> Edit</a>
                    <a class="btn btn-danger mr-2" href="<?php echo base_url('delivery_challan/report');?>"><i class="ti-trash"></i> Cancel</a>
                    
                  </form>
                </div>

              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
