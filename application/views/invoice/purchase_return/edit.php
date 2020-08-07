 <input type="hidden" id="units_url" value="<?php echo base_url("invoice/sales/item_units"); ?>">
 <input type="hidden" id="temp_party_url" value="<?php echo base_url("temp_party/add"); ?>">
                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">



                        </div>
                      </div>
                    </div>
          
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Debit Note&nbsp;#<?php echo $invoice->no; ?></h4>
                    <p class="card-description">
                      Debit Note Information
                    </p>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Seller</label>
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
                            <select class="js-example-basic-single w-100" id="purchase_items" onchange="get_item()" >
                              <option value="">-</option>
                              <?php
                              foreach($products as $row)
                              {
                                ?>
                              <option data-discound = "<?php echo $row['discound'];?>" data-tax_ex_in="<?php echo $row['sales_tax_ex_in'];?>" data-type="product" data-price="<?php echo $row['purchase_price'];?>" value="<?php echo $row['id'];?>"><?php echo $row['product_name'];?></option>
                            <?php } ?>
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
                            <button type="button" onclick="add_purchase_return_item('<?php echo base_url("invoice/purchase/add_item_to_invoice_return/".$invoice->invoice_no.'/'.$invoice->id);?>')" class="btn btn-primary btn-icon-text">
                                Save
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
                            <textarea class="form-control" name="about" id="about" id="exampleTextarea1" rows="4"><?php echo $invoice->about;?></textarea>
                          </div>
                        </div>                            
                       <?php echo form_open("invoice/purchase/update_return/".$invoice->id, array('id' => 'purchase_invoice__return_form')) ?>
                      </div>
                    </div>
                  </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Cash Recieved</label>
                          <div class="col-sm-8">
                            <input type="text" value="<?php echo $invoice->cash_recieved;?>" id="cash_paid"  name="cash_recieved" class="form-control" placeholder="₹" />
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


                        </span>
                    <div  class="btn btn-dark mr-2"><i class="ti-printer"></i> Print</div>
                    <div class="btn btn-light"><i class="ti-trash"></i> Cancel</div>
                    <div  class="btn btn-success mr-2" id="purchase_invoice_return_submit" onclick="submit_purchase_return();" ><i class="ti-save"></i> Update</div>
             

                  <?php echo form_close(); ?>
                </div>

              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->

<script type="text/javascript">
  cart('<?php echo base_url("invoice/purchase/edit_return_cart/".$invoice->id);?>')
  $('#mode').val("<?php echo $invoice->mode;?>")
</script>