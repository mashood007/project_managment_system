
          <div class="card">
            <div class="card-body">
              <h4 class="display-4">Estimates</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                            <th>Est No</th>
                            <th>Created on</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>#</th>
                            <th>Entered by</th>
			                       <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                              <?php
                                if (sizeof($estimate_invoice) > 0)
                                {
                              foreach($estimate_invoice as $row)
                               {
                                $photo = $row['photo'];
                                $invoice_total = $this->tempsales_model->invoiceTotal($row['id']);
                               ?>
                        <tr id="sales_invoice_row_<?php echo $row['id'];?>">
                            <td><?php echo $row['no'];?></td>
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
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("/invoice/estimate/info/".$row['id']); ?>'">Show</span>

                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("/invoice/sales/convert_sale/".$row['id']); ?>'">Convert Sale</span>
                                  
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="deleteSale('<?php echo base_url("invoice/estimate/delete/".$row['id']);?>')">
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
                </div>
              </div>
            </div>
          </div>
        </div>
