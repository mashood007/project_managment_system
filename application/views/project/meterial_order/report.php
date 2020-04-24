          <div class="card">
            <div class="card-body">
              <h4 class="display-4">Meterial Orders</h4>
              <div class="row">
                <div class="col-12" >
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                            <th>Order No</th>
                            <th>Status</th>
                            <th>Project</th>
                            <th>Subject</th>
                            <th>Ordered on</th>
                            <th>#</th>
                            <th>Ordered by</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="purchase_report_content">



                        <?php foreach ($meterial_orders as $row) {                        
                          $photo = $row['ordered_emp_photo'];
                        ?>

                            <tr>
                            <td>#<?php echo $row['id']; ?></td>
                            <td>
                              <?php if ($row['status'] == 0)
                              { ?> 
                              <button class="btn btn-outline-warning btn-md" onclick="sendMeterialOrder('<?php echo base_url("projects/meterial_order/send/".$row['id']); ?>')">Pending</button>
                              <?php } 
                              else {
                              ?>
                              <button class="btn btn-success btn-md" onclick="window.location.href = '#';">Send</button>
                            <?php } ?>
                            </td>
                            <td><?php echo $row['project_name']; ?></td>
                            <td><?php echo $row['subject']; ?></td>
                            <td><?php echo $row['ordered_on']; ?></td>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" >
                          </div></td>
                            <td><?php echo $row['ordered_by_emp']; ?></td>
                            <td><button class="btn btn-outline-danger" onclick="cancel('<?php echo base_url("projects/meterial_order/remove/".$row['id']); ?>')" >Remove</button></td>
                        </tr>

                      <?php } ?>
                        

                     

                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
