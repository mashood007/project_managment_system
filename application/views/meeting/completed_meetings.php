                        <?php
                        $slno = 0;
                        foreach ($meetings as $row) {
                          ?>
                        <tr id="row_<?php echo $row['id']; ?>">
                            <td><?php echo $slno += 1; ?></td>
                            <td><?php echo ucwords($row['type']);?></td>
                            <td><div class="badge badge-success badge-pill"><i class="mdi mdi-timer"></i>&nbsp;Finished</div></td>
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
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("meeting/undo_finish/".$row['id']);?>';">Undo Finish</span>

                                  <div class="dropdown-divider"></div>
                                  <span class="dropdown-item" onclick="deleteRow('<?php echo base_url("meeting/delete/".$row['id']);?>')">
                                    <font color="red">Remove</span>
                                </div>
                              </div>
                            </td> 
                        </tr>
                            <?php } ?>
