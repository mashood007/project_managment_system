                        <?php
                        $slno = 0;
                        foreach ($meetings as $row) {
                          $end_date = new DateTime($row['schedule_date']);
                          $start_date = new DateTime();
                          $time =  $start_date->diff($end_date);
                          ?>
                        <tr id="row_<?php echo $row['id']; ?>">
                            <td><?php echo $slno += 1; ?></td>
                            <td><?php echo ucwords($row['type']);?></td>
                           <?php if ($time->format("%R%a") >= 0) { ?>
                            <td><div class="badge badge-outline-success badge-pill"><i class="mdi mdi-timer"></i>
                              <?php
                             echo $time->format("%a")." Days" ;
                               ?></div></td>
                             <?php } 
                             else { ?>
                              <td>
                                <div class="badge badge-danger badge-pill"><i class="mdi mdi-timer"></i>&nbsp;Time Over</div>
                              </td>
                            <?php } ?>
                            <td><?php echo $row['visitor'];?></td>
                            <td>
                              <?php echo date('d-m-Y',strtotime(str_replace('-','/', $row['schedule_date']))).'- '.$row['schedule_time'];?>
                                
                            </td>
                            <td>
                              <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("meeting/info/".$row['id']);?>';">Show</span>                                  
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("meeting/finish/".$row['id']);?>';">Finish</span>

                                  <div class="dropdown-divider"></div>
                                  <span class="dropdown-item" onclick="deleteRow('<?php echo base_url("meeting/delete/".$row['id']);?>')">
                                    <font color="red">Remove</span>
                                </div>
                              </div>
                            </td>                             
                        </tr>
                          <?php } ?>