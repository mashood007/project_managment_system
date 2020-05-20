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
                            <td><?php echo $slno;?></td>
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
<script type="text/javascript">
    $('.total_return').html("<?php echo $total;?>")
</script>