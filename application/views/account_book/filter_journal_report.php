                        <?php foreach ($transactions as $row) {
                          switch ($row['mode']) {
                            case 'cash':
                              $mode ="Cash";
                              $color = "red";
                              break;
                            case 'bank':
                              $mode ="Bank";
                              $color = "red";
                              break;
                            case "nec":
                              $mode = "Non-Economic";
                              $color = "green";
                              break;
                          }

                          ?>
                          
                        <tr>
                            <td><?php echo $row['created_at'];?></td>
                            <td><?php echo $row['item'];?></td>
                            <td><?php echo $row['account_name'];?></td>
                            <td><?php echo $mode;?></td>
                            <td><font color="<?php echo $color;?>">₹<?php echo number_format($row['amount'],2); ?></font></td>
                            <td><?php echo $row['description'];?></td>
                        </tr>
                      <?php } ?>
