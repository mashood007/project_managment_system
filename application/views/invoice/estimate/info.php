         <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Estimate&nbsp;#<?php echo $invoice['no']; ?> </h4>
                  <form class="form-sample">

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Customer</label>
                          <div class="col-sm-12">
                               <b><?php echo $invoice['full_name']; ?></b>,&nbsp;
                               <font size="2">
                                <?php echo $invoice['city'].",&nbsp;".$invoice['mobile1']; ?>    </font>
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
                          <th>Discount</th>
                          <th>GST</th>
                          <th>Total Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $slno = 0;
                        $subtotal = 0.0;
                        $discound = 0.0;
                        $gst = 0.0;
                        foreach ($bill as $row) {
                          $slno =+ 1;
                          $subtotal += $row['total']; 
                          $discound += $row['discound'];
                          $gst += $row['gst'];
                         ?>
                        <tr>
                          <td><?php echo $slno; ?></td>
                          <td><?php echo $row['item']; ?></td>
                          <td><?php echo $row['quantity']."  ".$row['unit']; ?></td>
                          <td>₹<?php echo $row['price']; ?></td>
                          <td>₹<?php echo $row['discound']; ?></td>
                          <td>₹<?php echo $row['gst']; ?></td>
                          <td><b>₹<?php echo $row['total']; ?></b></td>
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
                             Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹<?php echo $subtotal + $discound - $gst; ?><br>
                             Discount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹<?php echo $discound; ?><br>
                             Taxable Value: ₹<?php echo $subtotal - $gst; ?>
                              <br>
                            <?php if ($invoice["sale_type"] == 0){?>
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
            $cess_rate =($subtotal + $discound - $gst)*$row['cess']/100;
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
                            <label for="exampleTextarea1">About Sale</label>
                             <p class="card-description"><?php echo $invoice['about']; ?> </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-12 col-form-label"><font size="5" class="text-dark">Cash Recieved </font><font size="5" class="text-success">₹<?php echo $invoice['cash_recieved']; ?></font> by <?php echo $invoice['mode']; ?><br>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-12 col-form-label">
                          <b>Sold on:</b>&nbsp;<?php echo $row['created_at'];?><br>
                          <b>Soled by:</b>&nbsp;<?php echo $invoice['emp_name']; ?></label>
                        </div>
                      </div>
                    </div>

                   

                    <button type="submit" class="btn btn-primary mr-2"><i class="ti-credit-card"></i> Google Pay</button>
                    <a class="btn btn-dark btn-md" href="<?php echo base_url("invoice/estimate/pdf/".$invoice['id']);?>">Print</a>
                    <button type="submit" class="btn btn-success mr-2"><i class="ti-layers"></i> Copy Link</button>
                    <a href = "<?php echo base_url("/invoice/sales/convert_sale/".$invoice['id']);?>" class="btn btn-inverse-dark mr-2"><i class="ti-write"></i> Convert To Sale</a>
       <a class="btn btn-warning" href="<?php echo base_url("invoice/estimate/edit/".$invoice['id']);?>">
                      <i class="ti-pencil"></i> Edit</a>
                    <a  class="btn btn-danger mr-2" href = "<?php echo base_url("invoice/report/estimate");?>">
                      <i class="ti-trash"></i> Cancel</a>
                    
                  </form>
                </div>

              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
