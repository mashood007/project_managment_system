 <input type="hidden" id="units_url" value="<?php echo base_url("invoice/sales/item_units"); ?>">
 <input type="hidden" id="temp_party_url" value="<?php echo base_url("temp_party/add"); ?>">
                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input purchase_type" name="purchase_type" id="purchase_type0" value="0" <?php if ($invoice->purchase_type == '0') { echo 'checked';} ?> >
                                Local Purchase
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input purchase_type" name="purchase_type" id="purchase_type1" value="1" <?php if ($invoice->purchase_type == '1') {echo 'checked';}?>>
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
                  <h4 class="display-2">Purchase Invoice&nbsp;#<?php echo $invoice->no;?></h4>
                    <p class="card-description">
                      Seller Information
                    </p>

                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">


                          <label class="col-sm-2 col-form-label">Purchase Date</label>
                          <div class="col-sm-4">
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" value="<?php echo date("m/d/Y", strtotime($invoice->purchase_date))?>"  id="purchase_date" name="purchase_date" class="form-control" placeholder="dd/mm/yyyy">
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
                            <button type="button" onclick="add_purchase_item('<?php echo base_url("invoice/purchase/add_item_to_invoice/".$invoice->id);?>')" class="btn btn-primary btn-icon-text">
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
                              <table class="border-0">
                                <tbody>
                                  <tr>
                                    <td>Price</td>
                                    <td> : </td>
                                    <td>₹<span id="total_price"></span></td>
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
                            <label for="exampleTextarea1">About Purchase</label>
                            <textarea class="form-control" name="about" id="about" id="exampleTextarea1" rows="4"><?php echo $invoice->about; ?></textarea>
                          </div>
                        </div>                            
                       <?php echo form_open_multipart("invoice/purchase/update/".$invoice->id, array('id' => 'purchase_invoice_form')) ?>
                      </div>
                    </div>
                  </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Cash Paid</label>
                          <div class="col-sm-8">
                            <input type="text" id="cash_paid" value="<?php echo $invoice->cash_paid; ?>" name="cash_paid" class="form-control" placeholder="₹" />
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
                              $('#mode').val("<?php echo $invoice->mode ;?>")
                            </script>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      
                       <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-12" id="balance_will_be">
                          </div>
                        </div>
                      </div>
                    </div>

                        </span>
                    <div  class="btn btn-dark mr-2"><i class="ti-printer"></i> Print</div>
                    <div class="btn btn-light"><i class="ti-trash"></i> Cancel</div>
                    <div  class="btn btn-success mr-2" id="purchase_invoice_submit"><i class="ti-save"></i> Update</div>


                  <?php echo form_close(); ?>
                </div>

              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->

<script type="text/javascript">
  load_items('<?php echo base_url("invoice/purchase/items");?>')
  cart('<?php echo base_url("invoice/purchase/invoice_cart/".$invoice->id);?>')
</script>