         <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Credit Note&nbsp;#<?php echo $invoice['no']; ?> </h4>
                  <h4 class="display-4">Invoice &nbsp;#<?php echo $invoice['InvoiceNo']; ?> </h4>
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
                             Taxable Value: ₹<?php echo $subtotal - $gst; ?><br><br>

                             <div class="display-4"><font size="5" color="#0082DC">Total Amount: ₹<?php echo $subtotal;?></font></div>
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
                          <label class="col-sm-12 col-form-label"><font size="5" class="text-dark">Cash Recieved </font><font size="5" class="text-success">₹<?php echo $invoice['cash_refund']; ?></font> by <?php echo $invoice['mode']; ?><br>
                          <font size="2" class="text-warning">Unpaid ₹<?php echo $subtotal - $invoice['cash_refund'];?></font><br>
                         </label>
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

                   
                    <button type="submit" class="btn btn-success mr-2"><i class="ti-layers"></i> Copy Link</button>

       <a class="btn btn-warning" href="<?php echo base_url("invoice/sales/edit_return/".$invoice['id']);?>">
                      <i class="ti-pencil"></i> Edit</a>
                    <a  class="btn btn-danger mr-2" href = "<?php echo base_url("invoice/report/sales_return");?>">
                      <i class="ti-trash"></i> Cancel</a>
                    
                  </form>
                </div>

              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
