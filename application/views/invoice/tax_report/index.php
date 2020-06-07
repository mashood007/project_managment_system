
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">

                <div class="col-12 col-xl-12">
                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">From</label>
                          <div class="col-sm-9">
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input id="from_date" onchange="filter('<?php echo base_url("invoice/tax_report/filter");?>')" type="text" class="form-control" placeholder="dd/mm/yyyy">
                             <span class="input-group-addon input-group-append border-left">
                             <span class="ti-calendar input-group-text"></span>
                             </span>
                           </div>
                         </div>
                       </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">To</label>
                          <div class="col-sm-9">
                            <div  class="input-group date datepicker datepicker-popup">
                            <input id="to_date" onchange="filter('<?php echo base_url("invoice/tax_report/filter");?>')" type="text" class="form-control" placeholder="dd/mm/yyyy">
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
              <h4 class="display-4">Tax Report</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                            <th>Data</th>
                            <th>Report</th>
                            <th>Tax Value</th>
                            <th>Other</th>
                            <th>Total Value</th>
                        </tr>
                      </thead>
                      <tbody id="sales_invoice">


                        <tr>
                            <td><?php echo $sales['total_sales'];?> Invoices</td>
                            <td>Sales Invoices</td>
                            <td>₹<?php echo number_format($sales['total_tax'],2);?></td>
                            <td>CESS: ₹<?php echo number_format($sales['total_cess'],2);?></td>
                            <td>₹<?php echo number_format($sales['total_cess']+$sales['total_tax'],2);?></td>
                        </tr>

                         <tr>
                            <td><?php echo $sales_return['total_sales'];?> Credit Notes</td>
                            <td>Sales Returns/Credit Notes</td>
                            <td>₹<?php echo number_format($sales_return['total_tax'],2);?></td>
                            <td>-</td>
                            <td>₹<?php echo number_format($sales_return['total_tax'],2);?></td>
                        </tr>

                        <tr>
                            <td><?php echo $purchase['total_purchase'];?>  Invoices</td>
                            <td>Purchase Invoices</td>
                            <td>₹<?php echo number_format($purchase['total_tax'],2);?></td>
                            <td>-</td>
                            <td>₹<?php echo number_format($purchase['total_tax'],2);?></td>
                        </tr>

                        <tr>
                            <td><?php echo $purchase_return['total_purchase'];?>  Debit Notes</td>
                            <td>Purchase Returns/Debit Notes</td>
                            <td>₹<?php echo number_format($purchase_return['total_tax'],2);?></td>
                            <td>-</td>
                            <td>₹<?php echo number_format($purchase_return['total_tax'],2);?> </td>
                        </tr>

                        <tr>
                            <td>15 types</td>
                            <td>Item/Code wise sales report</td>
                            <td>₹0.00 (Net Value)</td>
                            <td>-</td>
                            <td>₹0(Net Value)</td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                  <h4 class="display-4 text-primary"> Total Input: ₹28693.00 <font size="2" color="black">(Net tax value from purchases)</font></h4>
                  <h4 class="display-4 text-success"> Total Output: ₹28693.00 <font size="2" color="black">(Net tax value from sales)</font></h4>
       
                </div>
              </div>
            </div>
          </div>
        </div>

