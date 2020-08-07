     <input type="hidden" id="units_url" value="<?php echo base_url("invoice/sales/item_units"); ?>">
     <input type="hidden" id="customer_id" value="<?php echo $invoice['customer_id'];?>">
     
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Credit Note&nbsp;#01</h4><h6 class="display-4">Invoice&nbsp;#<?php echo $invoice["no"]; ?></h6>
                  <form class="form-sample">
                    <p class="card-description">
                      Credit Note Information
                    </p>

                   

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Party</label>
                          <div class="col-sm-9">
                               <b><?php print_r($invoice['full_name']);?></b>,&nbsp;
                               <font size="2"><?php print_r($invoice['city']);?>,&nbsp;<?php print_r($invoice['mobile1']);?><br>
                                </font>
                          </div>
                        </div>
                      </div>
                    </div>
                        
                        
                    <p class="card-description">
                     Add Item
                    </p>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <select class="js-example-basic-single w-100" id="item_list">
                              <option value="">-</option>
                              <?php
                             
                              foreach($services as $row)
                              {
                                ?>
                              <option data-discound = "<?php echo $row['discound'];?>" data-tax="<?php echo $row['tax'];?>" data-type="service" data-price="<?php echo $row['price'];?>" value="<?php echo $row['id'];?>"><?php echo $row['service'];?></option>
                            <?php } ?>

                              <?php
                             
                              foreach($products as $row)
                              {
                                ?>
                              <option data-discound = "<?php echo $row['discound'];?>" data-tax="<?php echo $row['tax_rate'];?>" data-type="product" data-price="<?php echo $row['sales_price'];?>" value="<?php echo $row['id'];?>"><?php echo $row['product_name'];?></option>
                            <?php } ?>

                           </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Price</label>
                          <div class="col-sm-10">
                            <input type="text" id="item_price" class="form-control" placeholder="₹0.00" />
                          </div>  
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Discount</label>
                          <div class="col-sm-10">
                            <input type="text" id="item_discound" class="form-control" placeholder="₹0.00" />
                          </div>     
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-">
                          <font size="2">Price:&nbsp;<b> 
                            ₹<span id="price_tag">0.00</span></b>&nbsp;-&nbsp;Discount:&nbsp;<b>₹<span id="discound_tag">0.00</span></b>&nbsp;+&nbsp;Tax:&nbsp;<b>₹<span id="tax_tag">0.00</span></b></font> &nbsp;|&nbsp;
                          <font color="#0082DC">Total Price:&nbsp;<b>₹<span id="total_tag">0.00</span></b></font>
                        </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-3">
                            <input type="text" class="form-control" name="quantity" id="quantity" placeholder="QTY" />
                          </div>
                          <div class="col-sm-6">
                            <select class="form-control" id="units_list">
                              <!-----------units here ------->
                            </select>
                          </div>
                          
                            <button type="button" onclick="add_item('<?php echo base_url("invoice/temp_sales_return/add_item");?>')" class="btn btn-primary btn-icon-text">
                                 Add to cart
                              </button>
                          
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
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="bill_area">

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
                              <table class="border-0">
                                <tbody>
                                  <tr>
                                    <td>Price</td>
                                    <td> : </td>
                                    <td>₹<span id="total_price"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Discount</td>
                                    <td> : </td>
                                    <td>₹<span id="total_discound"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Taxable Value</td>
                                    <td> : </td>
                                    <td>₹<span id="taxable_val"></span></td>
                                  </tr>
                                  <tr>
                                    <td>GST</td>
                                    <td> : </td>
                                    <td>₹<span id="total_gst"></span></td>
                                  </tr>
                                </tbody>
                              </table>
                             <br>
                             <div class="display-4"><font size="5" color="#0082DC">Total Amount: ₹<span id="total_amount">0</span></font></div>
                            </div>

                          <div class="col-sm-6">
                           <div class="form-group">
                            <label for="exampleTextarea1">About Sale</label>
                            <textarea class="form-control" id="about" rows="4"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Cash Refund</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" id="cash_refund" class="form-control" placeholder="₹" />
                          </div>
                        </div>
                      </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mode</label>
                          <div class="col-sm-9">
                            <select class="form-control" id="mode">
                              <option value="cash">Cash</option>
                              <option value="bank">Bank</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <span onclick="make_invoice_return('<?php echo base_url("invoice/sales/make_invoice_return/".$invoice["id"]);?>')" class="btn btn-success mr-2">
                      <i class="ti-save"></i> Submit
                    </span>
                    
                  </form>
                </div>

              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->

<script type="text/javascript">
  bill('<?php echo base_url("invoice/sales/return_bill/".$invoice["id"]);?>')
  $('#mode').val("<?php echo $invoice['mode'];?>")
</script>