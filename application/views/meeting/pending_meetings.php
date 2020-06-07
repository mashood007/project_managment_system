                        <?php
                        $slno = 0;
                        foreach ($meetings as $row) {
                          ?>
                        <tr>
                            <td><?php echo $slno += 1; ?></td>
                            <td><?php echo ucwords($row['type']);?></td>
                            <td><div class="badge badge-outline-warning badge-pill"><i class="mdi mdi-timer"></i>&nbsp;Waiting</div></td>
                            <td> - </td>
                            <td>
                              <?php echo date('d-m-Y',strtotime(str_replace('-','/', $row['schedule_date']))).'- '.$row['start_time'];?>
                                
                            </td>
                            <td>
                              <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">                               
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("meeting/finish/".$row['id']);?>';">Finish</span>

                                  <div class="dropdown-divider"></div>
                                  <span class="dropdown-item" onclick="deleteRow('<?php echo base_url("meeting/delete/".$row['id']);?>')">
                                    <font color="red">Remove</span>
                                </div>
                              </div>
                            </td>                             
                        </tr>
                            <?php } ?>
