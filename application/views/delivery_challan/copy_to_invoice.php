
            <input type="hidden" id="units_url" value="<?php echo base_url("invoice/sales/item_units"); ?>">
            <input type="hidden" id="temp_user_url" value="<?php echo base_url("temp_customer/add"); ?>">
                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input sale_type" name="sale_type" id="sale_type0" value="0" checked>
                                Local Sale
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input sale_type" name="sale_type" id="sale_type1" value="1">
                                Interstate Sale
                              </label>
                            </div>
                          </div>
                              <div class="col-sm-8">
                                <div class="button">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-settings"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6">
                                  <h6 class="dropdown-header"><font color="text-primary">Settings</font></h6>
                                  <a class="dropdown-item" href="product-settings.html">Product</a>
                                  <a class="dropdown-item" href="service-settings.html">Service</a>
                                  <a class="dropdown-item" href="product-category-settings.html">Category</a>
                                  <a class="dropdown-item" href="unit-settings.html">Units</a>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
          
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h6 class="display-2">Last Invoice&nbsp;#<?php print_r($invoice_no);?></h4>
                  <form class="form-sample">
                    <p class="card-description">
                      Customer Information
                    </p>

                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input user_type_radio" name="user_type_radio" value="old" checked>
                                Customer
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input user_type_radio" name="user_type_radio" value="temp">
                                Temporary User
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="row" id="local_user" >
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Sale to<font color="red">*</font></label>
                          <input type="hidden" name="for_cat" id="for_cat">
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100 old_customers">
                                  <option data-details="" data-type="" value="">-</option>
                                  <?php 
                                  foreach ($parties as $row) {
     if (($customer == $row['id']) && $delivery_challan->for_cat == "party")
                            {
                            ?>

                                      ?>
                                   <option selected="selected" data-type="party" data-details="<?php echo $row['city'].', '.$row['mobile1'].', GSTIN: '.$row['gstin'];?>" value="<?php echo $row['id'];?>"><?php echo $row['name'];?> (party)</option>
                                     <?php
                                  }
                              else
                              {
                                      ?>
                                   <option data-type="party" data-details="<?php echo $row['city'].', '.$row['mobile1'].', GSTIN: '.$row['gstin'];?>" value="<?php echo $row['id'];?>"><?php echo $row['name'];?> (party)</option>
                                     <?php
                              }
                            }

                                  foreach ($customers as $row) {

                            if (($customer == $row['id']) && $delivery_challan->for_cat != "party")
                            {
                            ?>
                            <option selected="selected" data-type="customer" data-details="<?php echo $row['city'].', '.$row['mobile1'];?>" value="<?php echo $row['id'];?>"><?php echo $row['full_name'];?>
                                     (customer)
                                      </option>
                            <?php
                            }
                            else
                            {

                            ?>

                                    <option data-type="customer" data-details="<?php echo $row['city'].', '.$row['mobile1'];?>" value="<?php echo $row['id'];?>"><?php echo $row['full_name'];?>
                                     (customer)
                                      </option>
                            <?php
                            }?>



                                      <?php
                                  }?>
                           </select>
                           <span id="customer_details"></span>
                          </div>
                        </div>
                      </div>


                    </div>


                    <div class="row" id="temp_user" style="display: none;">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Sale to <font color="red">*</font></label>
                          <div class="col-sm-8">
                            <input type="text" id="temp_user_name" class="form-control" placeholder="Customer Name" />
                          </div>
                        </div>
                      </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                         <label class="col-sm-4 col-form-label">Phone <font color="red">*</font></label>
                          <div class="col-sm-8">
                            <input type="text" id="temp_user_mobile" class="form-control" placeholder="Mobile Number" />
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
                            ₹<span id="price_tag">0.00</span></b>&nbsp;-&nbsp;Discount:&nbsp;<b>₹<span id="discound_tag">0.00</span></b>&nbsp;+&nbsp;Tax:&nbsp;<b>₹<span id="tax_tag">0.00</span></b>(18%)</font> &nbsp;|&nbsp;
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
                          
                            <button type="button" onclick="add_item('<?php echo base_url("invoice/temp_sales/add_item");?>')" class="btn btn-primary btn-icon-text">
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
                             Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹13.00<br>
                             Discount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹13.00<br>
                             Taxable Value: ₹13.00<br>
                             CGST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹13.00&nbsp;(9%)<br>
                             SGST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹13.00&nbsp;(9%)<br>
                             CESS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹1.00&nbsp;(CESS Name)<br>
                             <div class="display-4"><font size="5" color="#0082DC">Total Amount: ₹1353.50</font></div>
                            </div>

                          <div class="col-sm-6">
                           <div class="form-group">
                            <label for="exampleTextarea1">About Sale</label>
                            <textarea class="form-control" id="about" rows="4"><?php echo $delivery_challan->about; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Cash Recieved</label>
                          <div class="col-sm-8">
                            <input name="cash_recieved" id="cash_recieved" type="number" step="0.01" class="form-control" placeholder="₹" />
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



                    <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Sale Date</label>
                          <div class="col-sm-4">
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" name="sale_date" id="sale_date" class="form-control" placeholder="dd/mm/yyyy">
                             <span class="input-group-addon input-group-append border-left">
                             <span class="ti-calendar input-group-text"></span>
                             </span>
                           </div>
                         </div>
                    </div>



                    <button type="submit" class="btn btn-primary mr-2"><i class="ti-credit-card"></i> Google Pay</button>
                    <button type="submit" class="btn btn-dark mr-2"><i class="ti-printer"></i> Print Estimate</button>
                    <span onclick="create_estimate('<?php echo base_url("invoice/sales/create_estimate");?>')" class="btn btn-inverse-dark mr-2"><i class="ti-write"></i> Create Estimate</span>
                    <button onclick="clear_bill()" class="btn btn-light"><i class="ti-trash"></i> Cancel</button>
                    <span onclick="make_invoice('<?php echo base_url("invoice/sales/make_invoice");?>')" class="btn btn-success mr-2">
                      <i class="ti-save"></i> Submit
                    </span>
                    
                  </form>
                </div>

              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
<script type="text/javascript">
  bill('<?php echo base_url("invoice/temp_sales/bill/");?>')
</script>