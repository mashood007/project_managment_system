          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-12">
                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart"></i> Total Sales</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹125000.00</font><br><font color="DodgerBlue" size="2">150&nbsp;Invoices</font></h4>
                    </div>
                    
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-outline"></i> This Year Sales</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹125000.00</font><br><font color="green" size="2">150&nbsp;Invoices</font></h4>
                    </div>
                   
                    <div class="border-right pr-3 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-plus"></i> This Month Sales</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹125000.00</font><br><font color="orange" size="2">150&nbsp;Invoices</font></h4>
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
                            <th>Print</th>
                            <th>Details</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Amount</th>
                            <th>#</th>
                            <th>Entered by</th>
                            <th>Modify</th>
                            <th>Return</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="sales_invoice">

                              <?php
                                if (sizeof($sales_invoice) > 0)
                                {
                              
                              foreach($sales_invoice as $row)
                               {
                                $invoice_total = $this->tempsales_model->invoiceTotal($row['id']);
                                $photo = $row['photo'];
                               ?>
                        <tr id="sales_invoice_row_<?php echo $row['id'];?>">
                            <td><?php echo $row['id'];?></td>
                            <td><?php echo $row['created_at'];?></td>
                            <td>
                              <button class="btn btn-dark btn-md" onclick="window.location.href = '<?php echo base_url("invoice/report/invoice_pdf/".$row['id']);?>';">Print</button>
                            </td>
                            <td>
                              <button class="btn btn-success" onclick="window.location.href = '<?php echo base_url("invoice/sales/invoice_info/".$row['id']);?>';">Show</button>
                            </td>
                            <td><?php echo $row['full_name']."&#44;&nbsp;".$row['city'];?></td>
                            <td><?php echo $row['mobile1'];?></td>
                            <td>₹ <?php  print_r($invoice_total['sum_of']);?> </td>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" >
                          </div></td>
                            <td><?php echo $row['created_by_nick_name'];?></td>

                            <td>
          <button class="btn btn-outline-warning" onclick="window.location.href = '<?php echo base_url("invoice/sales/edit/".$row['id']);?>';">Edit</button>
                            </td>
                            <td>
            <button class="btn btn-outline-primary" onclick="window.location.href = '<?php echo base_url("invoice/report/invoice_return/".$row['id']);?>';">Return</button>
                            </td>
                            <td><button class="btn btn-outline-danger" onclick="deleteSale('<?php echo base_url("invoice/report/delete_invoice/".$row['id']);?>')">Cancel</button></td>
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
                  <h4 class="display-4 text-primary"> Total: ₹28693.00</h4>
                  <h4 class="display-6 text-success"> Paid: ₹28693.00</h4>
                  <h4 class="display-6 text-warning"> Unpaid: ₹100.00</h4>
                  <h4 class="display-6 text-danger"> Missed: ₹5.00</h4>
                </div>
              </div>
            </div>
          </div>
        </div>

