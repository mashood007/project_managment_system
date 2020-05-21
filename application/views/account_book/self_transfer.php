          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">Selft Transfer</h4>
                  <?php echo form_open("account_book/self_transfer") ?>
                    <p class="card-description">
                      Transfer within Bank and Cash Accounts
                    </p>



                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-9">
                            <i class="ti-harddrive"></i> Cash Balance: <font color="MediumSeaGreen" size="5" class="display-4"> ₹7600.00</font>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-9">
                             <i class="ti-credit-card"></i> Bank Balance:  <font color="dodgerblue" size="5" class="display-4"> ₹1650.00</font>
                            </div>
                          </div>
                      </div>
                    </div>
                    
                    
                    <div class="row">


                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">From</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="from_account">
                              <option value="cash">Cash Account</option>
                              <option value="bank">Bank Account</option>
                            </select>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"><i class="ti-arrow-right"></i> &nbsp;&nbsp;To</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="to_account">
                              <option value="bank">Bank Account</option>
                              <option value="cash">Cash Account</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Amount</label>
                          <div class="col-sm-9">
                            <input type="number" step="0.01" required name="amount" class="form-control" placeholder="Transfer Amount of" />
                          </div>
                        </div>
                      </div>

                    </div>


                     <div class="form-group">
                      <label for="exampleTextarea1">Description</label>
                      <textarea class="form-control" id="description" name="description" rows="4" placeholder="Narration for this self transfer"></textarea>
                    </div>



                     <button type="submit" class="btn btn-primary btn-block mb-2">Transfer</button>
                    <span class="btn btn-light">Cancel</span>
                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
        <!-- content-wrapper ends -->

<div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <h4 class="display-4"><i class="ti-reload"></i> Self Transfer History</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                           <th>Transaction No</th>
                            <th>When</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Who</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($transactions as $row) { 
                          ?>
                          
                        <tr>
                            <td><?php echo $row['no'];?></td>
                            <td><?php echo $row['created_at'];?></td>
                            <td><?php echo $row['from_account'] == 'bank' ? "Bank Account" : "Cash Account";?></td>
                            <td><?php echo $row['to_account'] == 'bank' ? "Bank Account" : "Cash Account";?></td>
                            <td>₹<?php echo number_format($row['amount'], 2); ?></td>
                            <td><?php echo $row['description'];?></td>
                            <td><?php echo $row['designation']."  (".$row['emp_name'].")";?></td>
                        </tr>
                      <?php } ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


</div>
        
       
