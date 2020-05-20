          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-12">
                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart"></i> Total Sales</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹<span id="total_sale"></span></font><br><font color="DodgerBlue" size="2"><span id="total_invoices"></span>&nbsp;Invoices</font></h4>
                    </div>
                    
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-outline"></i> This Year Sales</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹<span id="year_sale"></span></font><br><font color="green" size="2"><span id="year_invoice"></span>&nbsp;Invoices</font></h4>
                    </div>
                   
                    <div class="border-right pr-3 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-plus"></i> This Month Sales</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹<span id="month_sale"></span></font><br><font color="orange" size="2"><span id="month_invoice"></span>&nbsp;Invoices</font></h4>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">From</label>
                          <div class="col-sm-9">
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input id="from_date" onchange="filter('<?php echo base_url("invoice/report/filter");?>')" type="text" class="form-control" placeholder="dd/mm/yyyy">
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
                            <input id="to_date" onchange="filter('<?php echo base_url("invoice/report/filter");?>')" type="text" class="form-control" placeholder="dd/mm/yyyy">
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
              <h4 class="display-4">Invoice Report</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                            <th>Invoice No</th>
                            <th>Soled on</th>
                            <th>Customer</th>
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
                                $total_sale = 0;
                                $year_sale = 0;
                                $year_invoice = 0;
                                $month_sale = 0;
                                $month_invoice = 0;
                                if (sizeof($sales_invoice) > 0)
                                {
                              
                              foreach($sales_invoice as $row)
                               {
                                $slno += 1;
                                $invoice_total = $this->tempsales_model->invoiceTotal($row['id']);
                                $photo = $row['photo'];
                                $total_sale += $invoice_total['sum_of'];
                                $date = date_create($row['date_time']);
                                if (date_format($date,"Y") == date("Y"))
                                {
                                  $year_sale += $invoice_total['sum_of'];
                                  $year_invoice += 1;
                                
                                if (date_format($date,"m") == date("m"))
                                {
                                  $month_sale += $invoice_total['sum_of'];
                                  $month_invoice += 1;
                                }
                                }                             
                               ?>
                        <tr id="sales_invoice_row_<?php echo $row['id'];?>">
                            <td><?php echo $row['no'];?></td>
                            <td><?php echo $row['created_at'];?></td>
                            <td><?php echo $row['full_name']."&#44;&nbsp;".$row['city'];?></td>
                            <td><?php echo $row['mobile1'];?></td>
                            <td>₹ <?php  echo number_format($invoice_total['sum_of'], 2);?> </td>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" >
                          </div></td>
                            <td><?php echo $row['created_by_nick_name'];?></td>

                            <td>
                              <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/sales/invoice_info/".$row['id']);?>';">Show</span>

                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/report/invoice_pdf/".$row['id']);?>';">Print</span>
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/report/download_pdf/".$row['id']);?>';">Download PDF</span>

                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/sales/edit/".$row['id']);?>';">Edit</span>

                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/report/invoice_return/".$row['id']);?>';">Return</span>
                                  
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="deleteSale('<?php echo base_url("invoice/report/delete_invoice/".$row['id']);?>')">
                                    <font color="red">Remove</a>
                                </div>
                              </div>
                            </td>
                        </tr>

                        
                              <?php
                              
                               }
                             }
                             else
                             {
                              echo "<tr></tr>";
                             }
                               ?> 
                     

                       
                      </tbody>
                    </table>
                  </div>
                  <h4 class="display-4 text-primary total_sale"> Total: ₹<?php echo number_format($total_sale,2);?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>

<script type="text/javascript">
  $('#total_sale').html("<?php echo number_format($total_sale,2);?>")
  $('#total_invoices').html("<?php echo $slno;?>")

  $('#year_sale').html("<?php echo number_format($year_sale,2);?>")
  $('#year_invoice').html("<?php echo $year_invoice;?>")

  $('#month_sale').html("<?php echo number_format($month_sale,2);?>")
  $('#month_invoice').html("<?php echo $month_invoice;?>")

</script>