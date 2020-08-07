
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
                                  <a class="dropdown-item" href="<?php echo base_url('product/new_product');?>">Product</a>
                                  <a class="dropdown-item" href="<?php echo base_url('settings/service');?>">Service</a>
                                  <a class="dropdown-item" href="<?php echo base_url('product/product_category');?>">Category</a>
                                  <a class="dropdown-item" href="<?php echo base_url('settings/unit');?>">Units</a>
                                </div>
                          </div>
                        </div>
                      </div>
                    </div>
          
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h6 class="display-2">Last Invoice&nbsp;#<?php print_r($invoice_no);?></h6>

                  <!---------->
                  <?php if (isset($lead) && $from == 'lead')
                  { ?>
                  <h6 style="color: red;">Lead No: <?php echo $lead;?></h6>
                  <h6><?php echo $lead_creator['nick_name'];?> <font color="red">(incentive) : <?php echo $lead_creator['marketing_incentive']; ?>%</font> </h6>

                  <h6><?php echo $lead_convertor['nick_name'];?> <font color="red">(incentive) : <?php echo $lead_convertor['sales_incentive']; ?>%</font> </h6>

                  <?php } ?>
                  <h6><?php echo $invoice_submitor['nick_name'];?> <font color="red">(incentive) : <?php echo $invoice_submitor['invoice_incentive']; ?>%</font> </h6>

                  <br>
                  <!---------->

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
                            <select class="js-example-basic-single w-100 old_customers" id="customers_ddlb">
                                  <option data-details="" data-type="" value="">-</option>
                                  <?php 
                                  foreach ($parties as $row) {
                                      ?>
            <option data-type="party"  data-details="<?php echo $row['city'].', '.$row['mobile1'].', GSTIN: '.$row['gstin'];?>" value="<?php echo $row['id'];?>"><?php echo $row['name'];?> (party)</option>
                                     <?php
                                  }

                                  foreach ($customers as $row) {
                                     ?>
                                    <option <?php if ($project && $project['customer_id'] == $row['id']) { echo "selected";}?> data-type="customer" data-details="<?php echo $row['city'].', '.$row['mobile1'];?>" value="<?php echo $row['id'];?>"><?php echo $row['full_name'];?>
                                     (customer)
                                      </option>
                                      <?php
                                  }?>
                           </select>
                           <span id="customer_details"></span>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-9" id="account_balance">
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
                                  <tr>
                                    <td>CESS</td>
                                    <td> : </td>
                                    <td><span id="cess_content"></span></td>
                                  </tr>
                                </tbody>
                              </table>
                             <br>
                             <div class="display-4"><font size="5" color="#0082DC">Total Amount: ₹<span id="total_amount"></span></font>

                             </div>
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

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Balance to pay</label>
                          <div class="col-sm-8">
                            <input id="balance_to_pay" type="number" step="0.01" class="form-control" placeholder="0" />
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Sale Date</label>
                          <div class="col-sm-4">
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" value="<?php echo date("d/m/Y"); ?>" name="sale_date" id="sale_date" class="form-control" placeholder="dd/mm/yyyy">
                             <span class="input-group-addon input-group-append border-left">
                             <span class="ti-calendar input-group-text"></span>
                             </span>
                           </div>
                         </div>
                    </div>



                    <span  class="btn btn-primary mr-2"><i class="ti-credit-card"></i> Google Pay</span>
                    <?php if (isset($from)) {
                      ?>
                      <span onclick="create_estimate('<?php echo base_url("invoice/sales/create_estimate/".$from."/".$lead);?>')" class="btn btn-inverse-dark mr-2">
                      <?php }
                    else {  ?>
                    <span onclick="create_estimate('<?php echo base_url("invoice/sales/create_estimate");?>')" class="btn btn-inverse-dark mr-2">
                      <?php } ?>
                      <i class="ti-write"></i> Create Estimate</span>
                    
                    <?php if (isset($from)) {
                      ?>
                    <span onclick="make_invoice('<?php echo base_url("invoice/sales/make_invoice/".$from."/".$lead);?>')" class="btn btn-success mr-2">
                    <?php }
                    else {  ?>
                    <span onclick="make_invoice('<?php echo base_url("invoice/sales/make_invoice/");?>')" class="btn btn-success mr-2"> 
                  <?php } ?>
                      <i class="ti-save"></i> Submit
                    </span>
                    <a onclick="clear_bill('<?php echo base_url("invoice/sales/clear/");?>')" class="btn btn-light"><i class="ti-trash"></i> Cancel</a>
                  </form>
                </div>

              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
<script type="text/javascript">
  bill('<?php echo base_url("invoice/temp_sales/bill/");?>')
</script>