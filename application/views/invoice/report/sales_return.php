          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">

                <div class="col-12 col-xl-12">
                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart"></i> Total Returns</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹<span id="total_return">0</span></font><br><font color="DodgerBlue" size="2"><span id="total_notes">0</span>&nbsp;Credit Notes</font></h4>
                    </div>
                    
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-outline"></i> This Year Returns</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹<span id="yearly_return">0</span></font><br><font color="green" size="2"><span id="yearly_notes">0</span>&nbsp;Credit Notes</font></h4>
                    </div>
                   
                    <div class="border-right pr-3 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-plus"></i> This Month Returns</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹<span id="monthly_return">0</span></font><br><font color="orange" size="2"><span id="monthly_notes">0</span>&nbsp;Credit Notes</font></h4>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">From</label>
                          <div class="col-sm-9">
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input id="from_date" onchange="filter('<?php echo base_url("invoice/report/filter_return");?>')" type="text" class="form-control" placeholder="dd/mm/yyyy">
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
                            <input id="to_date" onchange="filter('<?php echo base_url("invoice/report/filter_return");?>')" type="text" class="form-control" placeholder="dd/mm/yyyy">
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
                            <th>Returned on</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>#</th>
                            <th>Returned by</th>
                            <th>Action</th>

                        </tr>
                      </thead>
                      <tbody id="sales_invoice">
                              <?php
                                if (sizeof($sales_return) > 0)
                                {
                              $slno = 0;
                              $total = 0;
                              $yearly_return = 0;
                              $yearly_notes = 0;
                              $monthly_return = 0;
                              $monthly_notes = 0;
                              foreach($sales_return as $row)
                               {
                                $photo = $row['photo'];
                                $slno += 1;
                                $total += $row['total'];
                                $date = date_create($row['date_time']);

                                if (date_format($date,"Y") == date("Y"))
                                {
                                  $yearly_return += $row['total'];
                                  $yearly_notes += 1;
                                
                                if (date_format($date,"m") == date("m"))
                                {
                                  $monthly_return += $row['total'];
                                  $monthly_notes += 1;
                                }
                                } 
                                ?>
                        <tr>
                            <td><?php echo $row['no'];?></td>
                            <td><?php echo $row['InvoiceNo'];?></td>
                            <td><?php echo $row['created_at'];?></td>
                            <td><?php echo $row['full_name']."&#44;&nbsp;".$row['city'];?></td>
                            <td><?php echo $row['mobile1'];?></td>
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
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/sales/return_info/".$row['id']);?>';">Show</span>

                                  
                                  <div class="dropdown-divider"></div>
                                  <span class="dropdown-item"onclick="deleteSale('<?php echo base_url("invoice/report/delete_invoice_return/".$row['id']);?>')">
                                    <font color="red">Remove</span>
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
                  <h4 class="display-4 text-primary total_return"> Total: ₹<?php echo $total;?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
<script type="text/javascript">
  $('#total_return').html("<?php echo $total;?>")
  $('#total_notes').html("<?php echo $slno;?>")

  $('#yearly_return').html("<?php echo $yearly_return;?>")
  $('#yearly_notes').html("<?php echo $yearly_notes;?>")

  $('#monthly_return').html("<?php echo $monthly_return;?>")
  $('#monthly_notes').html("<?php echo $monthly_notes;?>")
</script>