 <input type="hidden" id="units_url" value="<?php echo base_url("invoice/sales/item_units"); ?>">
 <input type="hidden" id="temp_party_url" value="<?php echo base_url("temp_party/add"); ?>">

                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input purchase_type" name="purchase_type" id="purchase_type0" value="0" checked>
                                Local Purchase
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input purchase_type" name="purchase_type" id="purchase_type1" value="1">
                                Interstate Purchase
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
                    </div>
          
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Purchase Order&nbsp;#<?php echo $last_purchase_order_no + 1;?></h4>
                    <p class="card-description">
                      Seller Information
                    </p>

                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">

                          <div class="col-sm-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input party_type" name="party_type" id="party_type0" value="old" checked>
                                Seller
                              </label>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input party_type" name="party_type" id="party_type1" value="temp" >
                                Temporary Seller
                              </label>
                            </div>
                          </div>


                          <label class="col-sm-2 col-form-label">Purchase Date</label>
                          <div class="col-sm-4">
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" name="purchase_date" id="purchase_date" class="form-control" placeholder="dd/mm/yyyy">
                             <span class="input-group-addon input-group-append border-left">
                             <span class="ti-calendar input-group-text"></span>
                             </span>
                           </div>
                         </div>

                        </div>
                      </div>
                    </div>



                    <div class="row" id="old_party">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Purchase from<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100 old_customers" name="registed_parties" id="registed_parties">
                              <option value="">-</option>
                              <?php 
                              foreach ($parties as $row) {
                                ?>
                                <option data-by='party' data-details="<?php echo $row['city'].', '.$row['mobile1'].', GSTIN: '.$row['gstin'];?>" data-gstin="<?php echo $row['gstin'];?>" value="<?php echo $row['id'];?>"><?php echo $row['name'];?> (party)</option>
                                <?php
                              }
                              foreach ($customers as $row) {
                                ?>
                                <option data-by='customer' data-details="<?php echo $row['city'].', '.$row['mobile1'];?>" data-gstin="<?php echo $row['gstin'];?>" value="<?php echo $row['id'];?>"><?php echo $row['full_name'];?>
                                  (customer)
                                </option>
                                <?php
                              }
                              ?>
                           </select>
                            <span id="customer_details"></span>
                          </div>
                        </div>
                      </div>


                    </div>


                    <div class="row temp_party" style="display: none;">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Purchase from<font color="red">*</font></label>
                          <div class="col-sm-10">
                            <input type="text" id="temp_parties" class="form-control" placeholder="Seller Name" />
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row temp_party" style="display: none;">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone</label>
                          <div class="col-sm-9">
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="+91" />
                          </div>
                        </div>
                      </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                         <label class="col-sm-3 col-form-label">GSTIN </label>
                          <div class="col-sm-9">
                            <input type="text" name="gstin" id="gstin" class="form-control" placeholder="Seller's GST Details" />
                          </div>
                        </div>
                      </div>
                    </div>


                    
                  
                        
                        
                    <p class="card-description">
                     Add Item
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <select class="form-control" id="purchase_item_category" onchange="load_items('<?php echo base_url("invoice/purchase/items");?>')">
                              <option value="sale">Sale Items</option>
                              <option value="no_sale">Non-Sale Items</option>
                              <option value="out_of_stock">Out of Stock Items</option>

                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <select class="js-example-basic-single w-100" id="purchase_items" onchange="get_item()">
                              <option value="">-</option>
                           </select>
                          </div>
                        </div>
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Purchase Amount</label>
                          <div class="col-sm-5">
                            <input type="text" class="form-control" id="purchase_amount" placeholder="₹" />
                          </div>
                          <div class="col-sm-3">
                            <select class="form-control" id="tax_ex_in">
                              <option value="in">Tax Included</option>
                              <option value="ex">Tax Excluded</option>
                            </select>
                          </div>
                        </div>
                      </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="purchase_qty" placeholder="QTY" />
                          </div>
                          <div class="col-sm-6">
                            <select class="form-control" id="units_list">
                              <option value="">-</option>
  
                            </select>
                          </div>
                          <div class="col-sm-3">
                            <button type="button" onclick="add_purchase_item('<?php echo base_url("invoice/purchase_order/add_item");?>')" class="btn btn-primary btn-icon-text">
                                ADD
                              </button>
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
                          <th>Modify</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="purchase_cart">
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
                              
                             <div class="display-4"><font size="5" color="#0082DC">Total Amount: ₹<span id="total_amount">0</span></font></div>
                            </div>
                          <div class="col-sm-6">
                           <div class="form-group">
                            <label for="exampleTextarea1">About Purchase</label>
                            <textarea class="form-control" name="about" id="about" id="exampleTextarea1" rows="4"></textarea>
                          </div>
                        </div>                            
                       <?php echo form_open_multipart("invoice/purchase_order/save", array('id' => 'purchase_invoice_form')) ?>
                      </div>
                    </div>
                  </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Cash Paid</label>
                          <div class="col-sm-8">
                            <input type="text" id="cash_paid" name="cash_paid" class="form-control" placeholder="₹" />
                          </div>
                        </div>
                      </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mode</label>
                          <div class="col-sm-9">
                            <select class="form-control" id="mode" name="mode">
                              <option value="cash">Cash</option>
                              <option value="bank">Bank</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>


                        <div class="form-group mr-2" style="float: left;">
                          
                      <input type="file" name="photo" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text"  class="form-control file-upload-info" style="display:none;" disabled>
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button"><i class="ti-camera"></i> Add Image</button>
                        </span>
                      </div>
                          
                        </div>

                        </span>
                    <div  class="btn btn-dark mr-2"><i class="ti-printer"></i> Print</div>
                    <div class="btn btn-light"><i class="ti-trash"></i> Cancel</div>
                    <div  class="btn btn-success mr-2" id="purchase_invoice_submit"><i class="ti-save"></i> Submit</div>
                    
                  <?php echo form_close(); ?>
                </div>

              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->

<script type="text/javascript">
  load_items('<?php echo base_url("invoice/purchase/items");?>')
  cart('<?php echo base_url("invoice/purchase_order/cart");?>')
</script>