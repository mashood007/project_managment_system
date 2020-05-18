
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">Cash Payment</h4>
                    <p class="card-description">
                      Cash payment information
                    </p>
                  <?php echo form_open("account_book/cash_payment") ?>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">To</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" id="customers_ddlb" name="customer_id">
                              <option value="">-</option>
                              <?php foreach($customers as $row)
                                { ?>
                         
                              <option value="<?php echo $row['id'];?>"><?php echo $row['full_name'];?></option>
                            <?php }?>
                           </select>
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
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mode</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="mode">
                              <option value="cash">Cash</option>
                              <option value="bank">Bank</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Amount</label>
                          <div class="col-sm-9">
                            <input name="amount" type="number" step="0.01" class="form-control" placeholder="Recieved Amount of" />
                          </div>
                        </div>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="exampleTextarea1">Description</label>
                      <textarea name="description" class="form-control" id="exampleTextarea1" rows="4" placeholder="Narration for this payment.."></textarea>
                    </div>
                     <button type="submit" class="btn btn-danger btn-block mb-2">Submit</button>
                  <?php echo form_close() ?>

                    <button class="btn btn-light">Cancel</button>
                </div>
              </div>
            </div>
        <!-- content-wrapper ends -->

</div>
