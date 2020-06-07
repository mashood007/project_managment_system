          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">

                <div class="col-12 col-xl-12">
                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart"></i> Total P Returns</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹<span id="total_purchase">0</span></font><br><font color="DodgerBlue" size="2"><span id="total_invoices">0</span>&nbsp;Debit Notes</font></h4>
                    </div>
                    
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-outline"></i> This Year P Returns</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹<span id ="yearly_total">0</span></font><br><font color="green" size="2"><span id="yearly_invoices"></span>&nbsp;Debit Notes</font></h4>
                    </div>
                   
                    <div class="border-right pr-3 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-plus"></i> This Month P Returns</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹<span id="monthly_total"></span></font><br><font color="orange" size="2"><span id="monthly_invoices"></span>&nbsp;Debit Notes</font></h4>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">From</label>
                          <div class="col-sm-9">
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input id="from_date" onchange="filter('<?php echo base_url("invoice/purchase_report/return_filter");?>')" type="text" class="form-control" placeholder="dd/mm/yyyy">
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
                            <input id="to_date" onchange="filter('<?php echo base_url("invoice/purchase_report/return_filter");?>')" type="text" class="form-control" placeholder="dd/mm/yyyy">
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
                            <th>Returned on</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Returned by</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="sales_invoice">

                        <?php 
                        $grand_total = 0;
                        $yearly_total = 0;
                        $yearly_invoices = 0;
                        $monthly_invoices = 0;
                        $monthly_total = 0;
                        $slno =0;                        
                        foreach ($purchase_return_invoices as $row) 
                        {
                          $grand_total += $row['total'];
                          $date = date_create($row['date_time']);
                          if (date_format($date,"Y") == date("Y"))
                          {
                            $yearly_total += $row['total'];
                            $yearly_invoices += 1;
                            if (date_format($date,"m") == date("m"))
                            {
                              $monthly_total += $row['total'];
                              $monthly_invoices += 1;
                            }
                          }  

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

                         ?>
                          
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['InvoiceNo']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td><?php echo $seller_name_and_city; ?></td>
                            <td><?php echo $seller_mobile; ?></td>
                            <td> <div class="d-flex align-items-center">
                             <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" title="<?php echo $row['employee_name']; ?>" ></div></td>
                            <td>
                              <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/purchase/return_info/".$row['id']);?>';">Show</span>

                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/purchase/edit/".$row['id']); ?>';">Edit</span>

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
                  <h4 class="display-4 text-primary total_purchase"> Total: ₹<?php echo number_format($grand_total,2);?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>

<script type="text/javascript">
  $('#total_purchase').html('<?php echo number_format($grand_total,2);?>')
  $('#total_invoices').html('<?php echo $slno;?>')

  $('#yearly_invoices').html('<?php echo number_format($yearly_invoices);?>')
  $('#yearly_total').html('<?php echo number_format($yearly_total,2);?>')

  $('#monthly_total').html('<?php echo number_format($monthly_total,2);?>')
  $('#monthly_invoices').html('<?php echo number_format($monthly_invoices);?>')  
</script>