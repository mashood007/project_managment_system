
        <?php echo form_open("account_book/filter_journal_report", array('id' => 'filter_journal_report')) ?>
             <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Account Book</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" onchange="$('#filter_journal_report').submit()" name="account">
                              <option value="">All</option>
                              <?php foreach ($accounts as $row) { ?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                             <?php } ?>
                           </select>
                          </div>
                        </div>
                      </div>
            </div>

            <div class="row">
                       <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mode</label>
                          <div class="col-sm-9">
                            <select class="form-control" onchange="$('#filter_journal_report').submit()" name="account_type">
                              <option value="">All</option>
                              <option value="cash">Cash</option>
                              <option value="bank">Bank</option>
                              <option value="nec">Non-Economic</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Trans</label>
                          <div class="col-sm-9">
                            <select class="form-control" onchange="$('#filter_journal_report').submit()" name="trans_type">
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
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input id="from_date" name="from_date" onchange="$('#filter_journal_report').submit()" type="text" class="form-control" placeholder="dd/mm/yyyy">
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
                            <input id="to_date" name="to_date" onchange="$('#filter_journal_report').submit()" type="text" class="form-control" placeholder="dd/mm/yyyy">
                             <span class="input-group-addon input-group-append border-left">
                             <span class="ti-calendar input-group-text"></span>
                             </span>
                           </div>
                         </div>
                       </div>
                     </div>


            </div>

                  <?php echo form_close() ?>


          <div class="card">
            <div class="card-body">
              <h4 class="display-4"> Account Report</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-primary text-white">
                            <th>Date & Time</th>
                            <th>Particulars</th>
                            <th>Account Book</th>
                            <th>Mode</th>
                            <th>Amount/Value</th>
                            <th>Description</th>
                        </tr>
                      </thead>
                      <tbody id="journal_report">
                        <?php foreach ($transactions as $row) {
                          switch ($row['mode']) {
                            case 'cash':
                              $mode ="Cash";
                              $color = "red";
                              break;
                            case 'bank':
                              $mode ="Bank";
                              $color = "red";
                              break;
                            case "nec":
                              $mode = "Non-Economic";
                              $color = "green";
                              break;
                          }

                          ?>
                          
                        <tr>
                            <td><?php echo $row['created_at'];?></td>
                            <td><?php echo $row['item'];?></td>
                            <td><?php echo $row['account_name'];?></td>
                            <td><?php echo $mode;?></td>
                            <td><font color="<?php echo $color;?>">₹<?php echo number_format($row['amount'],2); ?></font></td>
                            <td><?php echo $row['description'];?></td>
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
