          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">Payroll</h4>
                  <?php echo form_open("account_book/payroll") ?>
                    <p class="card-description">
                      Payroll information
                    </p>



                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Employee</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="employee_id" id="user_ddlb">
                              <option value="">-</option>
                              <?php foreach($employees as $row)
                                { ?>
                         
                              <option value="<?php echo $row['id'];?>"><?php echo $row['nick_name'];?></option>
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
                          <label class="col-sm-3 col-form-label">Transaction</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="payment_reciept" id="payment_reciept1" value="P" checked>
                                Payment
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="payment_reciept" id="payment_reciept2" value="R">
                                Reciept
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mode</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="mode">
                              <option>Cash</option>
                              <option>Bank</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Amount</label>
                          <div class="col-sm-9">
                            <input type="text" name="amount" class="form-control" placeholder="Transaction Amount of" />
                          </div>
                        </div>
                      </div>
                    </div>


                     <div class="form-group">
                      <label for="exampleTextarea1">Description</label>
                      <textarea name="description" class="form-control" id="exampleTextarea1" rows="4" placeholder="Narration for this transaction.."></textarea>
                    </div>



                     <button type="submit" class="btn btn-primary btn-block mb-2">Submit</button>
                    <span class="btn btn-light clear-input">Cancel</span>
                   <?php echo form_close() ?>
                </div>
              </div>
            </div>
        <!-- content-wrapper ends -->

</div>
