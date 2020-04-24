          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">

                <div class="col-12 col-xl-12">
                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart"></i> Total Returns</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹125000.00</font><br><font color="DodgerBlue" size="2">150&nbsp;Credit Notes</font></h4>
                    </div>
                    
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-outline"></i> This Year Returns</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹125000.00</font><br><font color="green" size="2">150&nbsp;Credit Notes</font></h4>
                    </div>
                   
                    <div class="border-right pr-3 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-plus"></i> This Month Returns</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹125000.00</font><br><font color="orange" size="2">150&nbsp;Credit Notes</font></h4>
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
              <h4 class="display-4">Credit Notes/Returns</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                            <th>CN No</th>
                            <th>Invoice</th>
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
                                if (sizeof($sales_return) > 0)
                                {
                              $slno = 0;
                              foreach($sales_return as $row)
                               {
                                $photo = $row['photo'];
                                $slno += 1;
                                ?>
                        <tr>
                            <td><?php echo $slno;?></td>
                            <td><?php echo $row['invoice_no'];?></td>
                            <td>
                             <button class="btn btn-success" onclick="window.location.href = '<?php echo base_url("invoice/sales/return_info/".$row['id']);?>';">Show</button>
                            </td>
                            <td><?php echo $row['created_at'];?></td>
                            <td><?php echo $row['full_name']."&#44;&nbsp;".$row['city'];?></td>
                            <td><?php echo $row['mobile1'];?></td>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" >
                            </div></td>
                            <td><?php echo $row['created_by_nick_name'];?></td>
                          
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
                </div>
              </div>
            </div>
          </div>
        </div>
