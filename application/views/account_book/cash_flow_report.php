            <!-----Cash Flow Statement--->
            <div class="card-body cash_flow">
              <h4 class="display-4"><i class="ti-stats-up"></i> Cash Flow Statement</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-primary text-white">
                            <th>Date & Time</th>
                            <th>To</th>
                            <th>Mode</th>
                            <th>Amount</th>
                            <th>Description</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      <?php
                      $slno = 1;
                      $total = 0;
                      foreach($result as $row)
                      {
                        $total = $total + $row['amount'];
                      ?>
                        <tr>
                            <td><?php echo $row['created_at']; ?></td>
                            <td><?php echo $row['transaction']; ?></td>
                            <td><?php echo $row['customer_name']; ?></td>
                            <td><?php echo ucwords($row['mode']); ?></td>
                            <?php 
                            if ($row['payment_reciept'] == 'R')
                            {?>
                            <td><font color="green">₹<?php echo $row['amount']; ?></font></td>
                            <?php
                            }
                            else
                            {?>
                            <td><font color="red">₹<?php echo $row['amount']; ?></font></td>
                            <?php }
                            ?>
                            <td><?php echo $row['description']; ?></td>
                        </tr>
                      <?php }?>                 
                      </tbody>
                    </table>
                    </div>
                    <h4 class="display-4 text-primary"> Total: ₹<?php echo $total; ?></h4>
                </div>
              </div>
            </div>
