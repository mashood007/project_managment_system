 <input type="hidden" id="units_url" value="<?php echo base_url("invoice/sales/item_units"); ?>">
 <input type="hidden" id="for_url" value="<?php echo base_url("delivery_challan/for_delivery"); ?>">

                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-3">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="for_type" id="for_type" value="indivitual" checked>
                                For Indivitual
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="for_type" id="for_type" value="project" >
                                For Project/Contract
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="for_type" id="for_type" value="branch">
                                For Branches/Warehouse
                              </label>
                            </div>
                          </div>
                              <div class="col-sm-2">
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
                  <h4 class="display-2">Delivery Challan&nbsp;#<?php echo $next; ?></h4>
                    <p class="card-description">
                      Delivery Information
                    </p>

              <?php echo form_open("delivery_challan/add", array('id' => 'delivery_challan_form')) ?>
              <input type="hidden" name="for_cat" id="for_cat">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-3">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="bound" id="outbound" value="outbound" checked>
                                Outbound
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="bound" id="inbound" value="inbound" checked>
                                Inbound
                              </label>
                            </div>
                          </div>
                         
                        </div>
                      </div>
                    </div>

                

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">For <font color="red">*</font></label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="delivery_for" id="delevery_for_list" required>
                              <option value="">-</option>
                           </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Delivery Date</label>
                          <div class="col-sm-9">
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control" name="delivery_date" placeholder="mm/dd/yyyy">
                             <span class="input-group-addon input-group-append border-left">
                             <span class="ti-calendar input-group-text"></span>
                             </span>
                           </div>
                         </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                       <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-12" id="customer_details">

                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Location <font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" name="location" id="location" required class="form-control" placeholder="Delivery Location" />
                          </div>
                        </div>
                      </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                         <label class="col-sm-3 col-form-label">Reason <font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" name="reason" id="reason" required class="form-control" placeholder="Reason for this move" />
                          </div>
                        </div>
                      </div>
                    </div>
                     <?php echo form_close(); ?> 

                    
                  
                        
                        
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
                          <label class="col-sm-4 col-form-label">Price</label>
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
                            <button type="button" onclick="add_purchase_item('<?php echo base_url("delivery_challan_dep/cart/add");?>')" class="btn btn-primary btn-icon-text">
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
                          <th>Discound</th>
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

                            <div class="col-sm-6" id="summary">

                            </div>

                          <div class="col-sm-6">
                           <div class="form-group">
                            <label for="exampleTextarea1">About Delivery</label>
                            <textarea name="about" id="about" class="form-control" id="exampleTextarea1" rows="4"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


       
                    <button type="submit" class="btn btn-dark mr-2"><i class="ti-printer"></i> Print</button>
                    <button class="btn btn-light"><i class="ti-trash"></i> Cancel</button>
                    <span type="button" onclick="delivery_challan_form_submit()" class="btn btn-success mr-2"><i class="ti-save"></i> Submit</span>
                    
                </div>

              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
<script type="text/javascript">
  load_items('<?php echo base_url("invoice/purchase/items");?>')
  cart('<?php echo base_url("delivery_challan/cart");?>')
  delivery_for_list('indivitual')
</script>