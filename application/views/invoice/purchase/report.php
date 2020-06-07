          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">

                <div class="col-12 col-xl-12">
                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart"></i> Total Purchases</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹<span id='total_purchase'>0</span></font><br><font color="DodgerBlue" size="2"><span id="total_invoices">0</span>&nbsp;Invoices</font></h4>
                    </div>
                    
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-outline"></i> This Year Purchases</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹<span id="yearly_total">0</span></font><br><font color="green" size="2"><span id="yearly_invoices">0</span>&nbsp;Invoices</font></h4>
                    </div>
                   
                    <div class="border-right pr-3 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-plus"></i> This Month Purchases</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹<span id="monthly_total"></span></font><br><font color="orange" size="2"><span id="monthly_invoices"></span>&nbsp;Invoices</font></h4>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">From</label>
                          <div class="col-sm-9">
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input id="from_date" onchange="filter('<?php echo base_url("invoice/purchase_report/filter");?>')" type="text" class="form-control" placeholder="dd/mm/yyyy">
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
                            <input id="to_date" onchange="filter('<?php echo base_url("invoice/purchase_report/filter");?>')" type="text" class="form-control" placeholder="dd/mm/yyyy">
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
              <h4 class="display-4">Purchase Invoice Report</h4>
             
              <div class="row">
                <div class="col-12" id="purchase_report_content">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                            <th>Invoice No</th>
                            <th>Purchased on</th>
                            <th>Party/Seller</th>
                            <th>Phone</th>
                            <th>Amount</th>
                            <th>#</th>
                            <th>Entered by</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="sales_invoice">
                  <?php 
                        $slno = 0;
                        $grant_total = 0;
                        $total_paid = 0;
                        $yearly_total = 0;
                        $yearly_invoices = 0;
                        $monthly_invoices = 0;
                        $monthly_total = 0;
                        foreach ($purchase_invoices as $row) {
                        $amount = $row['total'];
                        $grant_total += $amount;
                          $photo = $row['photo'];
                          $slno += 1;
                          $date = date_create($row['date_time']);
                          if (date_format($date,"Y") == date("Y"))
                          {
                            $yearly_total += $amount;
                            $yearly_invoices += 1;
                            if (date_format($date,"m") == date("m"))
                            {
                              $monthly_total += $amount;
                              $monthly_invoices += 1;
                            }
                          }                          
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

                            $total_paid += $row['cash_paid'];
                  ?>
                        <tr id="sales_invoice_row_<?php echo $row['id'];?>">
                            <td><?php echo $row['no']; ?></td>
                            <td><?php echo date("d-M-Y", strtotime($row['purchase_date']));?></td>
                            <td><?php echo $seller_name_and_city; ?></td>
                            <td><?php echo $seller_mobile; ?></td>
                            <td>₹<?php echo $amount;?></td>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" ></div></td>
                            <td><?php echo $row['created_by_nick_name'];?></td>



                            <td>
                              <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/purchase/invoice_info/".$row['id']);?>';">Show</span>


                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/purchase/edit/".$row['id']); ?>';">Edit</span>

                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/purchase/invoice_return/".$row['id']); ?>';">Return</span>
                                  
                                  <div class="dropdown-divider"></div>
                                  <span class="dropdown-item" onclick="deleteSale('<?php echo base_url("invoice/purchase_report/cancel_invoice/".$row['id']); ?>')">
                                    <font color="red">Remove</span>
                                </div>
                              </div>
                            </td>                            
                        </tr>
                      <?php } ?>
                        

                     

                       
                      </tbody>
                    </table>
                  </div>
                  <h4 class="display-4 text-primary total_purchase"> Total: ₹<?php echo number_format($grant_total,2); ?></h4>
                  <h4 class="display-6 text-danger paid"> Paid: ₹<?php echo number_format($total_paid,2); ?></h4>
                  <h4 class="display-6 text-warning unpaid"> Unpaid: ₹<?php echo number_format($grant_total - $total_paid, 2);   ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>

<script type="text/javascript">
  $('#total_purchase').html('<?php echo number_format($grant_total,2);?>')
  $('#total_invoices').html('<?php echo $slno;?>')

  $('#yearly_invoices').html('<?php echo number_format($yearly_invoices);?>')
  $('#yearly_total').html('<?php echo number_format($yearly_total,2);?>')

  $('#monthly_total').html('<?php echo number_format($monthly_total,2);?>')
  $('#monthly_invoices').html('<?php echo number_format($monthly_invoices);?>')
</script>