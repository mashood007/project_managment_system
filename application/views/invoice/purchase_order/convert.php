 <input type="hidden" id="units_url" value="<?php echo base_url("invoice/sales/item_units"); ?>">
 <input type="hidden" id="temp_party_url" value="<?php echo base_url("temp_party/add"); ?>">

                     <div class="row">
                      <div class="col-md-12">
                      </div>
                    </div>
          
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Purchase Order&nbsp;#<?php echo $purchase_order->id; ?></h4>
                    <p class="card-description">
                      Seller Information
                    </p>

                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">




                          <label class="col-sm-2 col-form-label">Purchase Date</label>
                          <div class="col-sm-4">
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" name="purchase_date" id="purchase_date" class="form-control" value="<?php echo $purchase_order->purchase_date; ?>" placeholder="dd/mm/yyyy">
                             <span class="input-group-addon input-group-append border-left">
                             <span class="ti-calendar input-group-text"></span>
                             </span>
                           </div>
                         </div>

                        </div>
                      </div>
                    </div>

                    <div class="row" >
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Purchase from<font color="red">*</font></label>
                          <div class="col-sm-9">
                              <?php echo $seller; ?>

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
                            <button type="button" onclick="add_purchase_item('<?php echo base_url("invoice/purchase_order/add_item/".$purchase_order->id);?>')" class="btn btn-primary btn-icon-text">
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
                             Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹<span id="total_price">0.00</span><br>
                             CGST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹13.00&nbsp;(9%)<br>
                             SGST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹13.00&nbsp;(9%)<br>
                             CESS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;₹1.00&nbsp;(CESS Name)<br>
                             <div class="display-4"><font size="5" color="#0082DC">Total Amount: ₹<span id="total_amount">0</span></font></div>
                            </div>
                          <div class="col-sm-6">
                           <div class="form-group">
                            <label for="exampleTextarea1">About Purchase</label>
                            <textarea class="form-control" name="about" id="about" id="exampleTextarea1" rows="4"><?php  echo $purchase_order->about; ?></textarea>
                          </div>
                        </div>                            
                       <?php echo form_open("invoice/purchase_order/convert_to_invoice/".$purchase_order->id, array('id' => 'convert_form')) ?>
                      </div>
                    </div>
                  </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Cash Paid</label>
                          <div class="col-sm-8">
                            <input type="text" value="<?php  echo $purchase_order->cash_paid; ?>" id="cash_paid" name="cash_paid" class="form-control" placeholder="₹" />
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
                            <script type="text/javascript">
                              $('#mode').val('<?php echo $purchase_order->mode; ?>')
                            </script>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      
                       <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         Balance will be: <font color="green" size="5" class="display-4"> ₹352.00</font> <font color="grey" size="1">is advanced</font><br>
                          </div>
                        </div>
                      </div>
                    </div>
                        </span>
                    <div class="btn btn-light"><i class="ti-trash"></i> Cancel</div>
        <div  class="btn btn-success mr-2" onclick="$('#convert_form').append($('#purchase_date'));$('#convert_form').append($('#about'));$('#convert_form').submit();"><i class="ti-save"></i> Submit</div>
                    
                  <?php echo form_close(); ?>
                </div>

              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->

<script type="text/javascript">
  load_items('<?php echo base_url("invoice/purchase/items");?>')
  cart('<?php echo base_url("invoice/purchase_order/convert_cart/".$purchase_order->id);?>')
</script>