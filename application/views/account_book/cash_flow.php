
           <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">

                <div class="col-12 col-xl-12">
                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted">Cash in Hand</p>
                      <h4 class="mb-0 font-weight-bold"><font color="DodgerBlue">₹50000.00</font></h4>
                    </div>
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted">Cash at Bank</p>
                      <h4 class="mb-0 font-weight-bold"><font color="DodgerBlue">₹125000.00</font></h4>
                    </div>
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted">This Year Turnover</p>
                      <h4 class="mb-0 font-weight-bold">₹88695000.00</h4>
                    </div>
                    <div class="border-right pr-3 mb-3 mb-xl-0">
                      <p class="text-muted">This Year Epences</p>
                      <h4 class="mb-0 font-weight-bold"><font color="orange">₹85648500.00</font></h4>
                    </div>
                    <div class="border-right pr-3 mb-3 mb-xl-0">
                      <p class="text-muted">This Month Turnover</p>
                      <h4 class="mb-0 font-weight-bold"><font color="MediumSeaGreen">₹152300.00</font></h4>
                    </div>
                      <div class="pr-3 mb-3 mb-xl-0">
                      <p class="text-muted">This Month Expences</p>
                      <h4 class="mb-0 font-weight-bold"><font color="red">₹35625.00</font></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

             <div class="row">
                      <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Account</label>
                          <div class="col-sm-9">
                            <select class="form-control" id="account_type">
                              <option value="">All</option>
                              <option value="cash">Cash Account</option>
                              <option value="bank">Bank Account</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Trans</label>
                          <div class="col-sm-9">
                            <select class="form-control" id="trans_type">
                              <option value="">All</option>
                              <option value="R">Inbound</option>
                              <option value="P">Outbound</option>
                            </select>
                          </div>
                        </div>
                      </div>


                     <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">From</label>
                          <div class="col-sm-9">
                            <div  class="input-group date datepicker datepicker-popup">
                            <input id="from_date" type="text" class="form-control" placeholder="dd/mm/yyyy">
                             <span class="input-group-addon input-group-append border-left">
                             <span class="ti-calendar input-group-text"></span>
                             </span>
                           </div>
                         </div>
                       </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">To</label>
                          <div class="col-sm-9">
                            <div  class="input-group date datepicker datepicker-popup">
                            <input id="to_date" type="text" class="form-control" placeholder="dd/mm/yyyy">
                             <span class="input-group-addon input-group-append border-left">
                             <span class="ti-calendar input-group-text"></span>
                             </span>
                           </div>
                         </div>
                       </div>
                     </div>

            </div>



          <div class="card" id ="cash_flow_statement">


            <!-----Cash Flow Statement--->
            <div class="card-body cash_flow">
              <h4 class="display-4"><i class="ti-stats-up"></i> Cash Flow Statement</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-primary text-white">
                            <th>Date & Time</th>
                            <th>To</th>
                            <th>Mode</th>
                            <th>Amount</th>
                            <th>Description</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      <?php
                      $slno = 1;
                      $total = 0;
                      foreach($result as $row)
                      {
                        $total = $total + $row['amount'];
                      ?>
                        <tr>
                            <td><?php echo $row['created_at']; ?></td>
                            <td><?php echo $row['customer_name']; ?></td>
                            <td><?php echo ucwords($row['mode']); ?></td>
                            <?php 
                            if ($row['payment_reciept'] == 'R')
                            {?>
                            <td><font color="green">₹<?php echo $row['amount']; ?></font></td>
                            <?php
                            }
                            else
                            {?>
                            <td><font color="red">₹<?php echo $row['amount']; ?></font></td>
                            <?php }
                            ?>
                            <td><?php echo $row['description']; ?></td>
                        </tr>
                      <?php }?>                 
                      </tbody>
                    </table>
                    </div>
                    <h4 class="display-4 text-primary"> Total: ₹ <?php echo $total; ?></h4>
                </div>
              </div>
            </div>




          </div>
        </div>

