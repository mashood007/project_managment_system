          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">

                <div class="col-12 col-xl-12">
                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart"></i> Total P Returns</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹125000.00</font><br><font color="DodgerBlue" size="2">150&nbsp;Debit Notes</font></h4>
                    </div>
                    
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-outline"></i> This Year P Returns</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹125000.00</font><br><font color="green" size="2">150&nbsp;Debit Notes</font></h4>
                    </div>
                   
                    <div class="border-right pr-3 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-plus"></i> This Month P Returns</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹125000.00</font><br><font color="orange" size="2">150&nbsp;Debit Notes</font></h4>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">From</label>
                          <div class="col-sm-9">
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control" placeholder="dd/mm/yyyy">
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
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control" placeholder="dd/mm/yyyy">
                             <span class="input-group-addon input-group-append border-left">
                             <span class="ti-calendar input-group-text"></span>
                             </span>
                           </div>
                         </div>
                       </div>
                     </div>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h4 class="display-4">Debit Notes/Purchase Returns</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                            <th>DN No</th>
                            <th>P Invoice</th>
                            <th>Open</th>
                            <th>Returned on</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>#</th>
                            <th>Returned by</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php 
                        $grand_total = 0;
                        foreach ($purchase_return_invoices as $row) 
                        {
                         $photo = $row['emp_photo'];

                            switch ($row['selled_by']) {
                              case 'party':
                                $seller = $this->party_model->getDetails($row['party_id']);
                                $seller_mobile = $seller['mobile1'];
                                $seller_name_and_city = $seller['name']."&#44;&nbsp;".$seller['city']; 
                                break;
                              case 'temp_party':
                                $seller = $this->temp_party_model->getDetails($row['party_id']);
                                $seller_name_and_city = $seller['name'];
                                $seller_mobile = $seller['phone'];
                                break;
                              case 'customer':
                                $seller = $this->customer_model->getDetails($row['party_id']);
                                $seller_mobile = $seller['mobile1'];
                                $seller_name_and_city = $seller['full_name']."&#44;&nbsp;".$seller['city']; 
                                break;
                            }
                            $amount = $this->purchase_return_model->amount($row['id']);
                            $grand_total += $amount;

                         ?>
                          
                        

                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['invoice_no']; ?></td>
                            <td>
                              <a class="btn btn-success btn-md" href="<?php echo base_url("invoice/purchase/return_info/".$row['id']);?>">Show</a>
                            </td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td><?php echo $seller_name_and_city; ?></td>
                            <td><?php echo $seller_mobile; ?></td>
                            <td> <div class="d-flex align-items-center">
                             <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" ></div></td>
                            <td><?php echo $row['employee_name']; ?></td>
                          
                        </tr>

                        <?php } ?>

                     

                       
                      </tbody>
                    </table>
                  </div>
                  <h4 class="display-4 text-primary"> Total: ₹<?php echo $grand_total; ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
