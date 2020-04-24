
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
			    <th>Details</th>
                            <th>Created on</th>
                            <th>Convert</th>
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
                        <tr>
                            <td>01</td>
			    <td><button class="btn btn-primary " onclick="window.location.href = '<?php echo base_url("/invoice/estimate/info/".$row['id']); ?>'"> Show</button></td>
                            <td><?php echo $row['created_at'];?></td>
                            <td>
          <button class="btn btn-success btn-md" onclick="window.location.href = '<?php echo base_url("/invoice/sales/convert_sale/".$row['id']); ?>'">Convert Sale</button>
                              
                            </td>
                            <td><?php echo $row['full_name']."&#44;&nbsp;".$row['city'];?></td>
                            <td><?php echo $row['mobile1'];?></td>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" >
                          </div></td>
                            <td><?php echo $row['created_by_nick_name'];?></td>
			    <td>
            <button class="btn btn-danger " onclick="window.location.href = '#';">Delete</button>
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
