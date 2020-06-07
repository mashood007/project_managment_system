          
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">Transaction Entry</h4>
                  <?php echo form_open("account_book/journal_transaction") ?>
                    <p class="card-description">
                      Ecenomic/Non-Economic transactional information
                    </p>



                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Account Book</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="account" id="account">
                              
                              <?php
                              
                              foreach($accounts as $row)
                              {
                                ?>     
                                  <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php }?>
                           </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Transaction</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="payment_reciept" id="membershipRadios1" value="P" checked>
                                Payment
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="payment_reciept" id="membershipRadios2" value="R">
                                Reciept
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    
                    <div class="row">

                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Item</label>
                          <div class="col-sm-9">
                            <input name="item" type="text" class="form-control" placeholder=" The details of a claim" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Value</label>
                          <div class="col-sm-9">
                            <input name="amount" type="text" class="form-control" placeholder="Transaction Amount/Value of" />
                          </div>
                        </div>
                      </div>


                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mode</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="mode">
                              <option value="cash">Cash</option>
                              <option value="bank">Bank</option>
                              <option value="nec">Non-Economic Transaction</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>


                     <div class="form-group">
                      <label for="exampleTextarea1">Description</label>
                      <textarea class="form-control" name="description" id="description" rows="4" placeholder="Narration for this transaction.."></textarea>
                    </div>



                     <button type="submit" class="btn btn-primary btn-block mb-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                   <?php echo form_close() ?>
                </div>
              </div>
            </div>
        <!-- content-wrapper ends -->

</div>
