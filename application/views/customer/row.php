                        <?php 
                        $emp_photo = $row['emp_photo'];
                        $photo = $row['photo'];
                        $client_status = $row['active']? "active-client" : "inactive-client" ;
                        ?>
                          <td>
                            <div class="profile">
                           <img src="<?php echo base_url(!empty($photo)? '/upload/customer_photo/'.$photo : 'assets/images/client1.jpg'); ?>" >
                            <div class="client-status <?php echo $client_status; ?>"></div>
                          </div></td>
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['mobile1']; ?></td>
                            <td><font color="red">₹150.00</font></td>

                            <td>
                                    <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <a class="dropdown-item" href="#">Profile</a>
                                  <a class="dropdown-item" href="#">Edit</a>
                                  <?php if ($row['active'])
                                  {?>
                                    <span class="set-active-inactive dropdown-item" onclick="activeClient('<?php echo base_url('customer/inactive/'.$row['id']);?>','<?php echo $row['id'];?>')">Set Inactive</span>
                                  <?php
                                  }
                                  else
                                  { ?>
                                    <span class="set-active-inactive dropdown-item" onclick="activeClient('<?php echo base_url('customer/active/'.$row['id']);?>','<?php echo $row['id'];?>')">Set Active</span>
                                  <?php 
                                  }
                                  ?>
                                  
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="deleteRow('<?php echo base_url('customer/delete/'.$row['id']);?>')">
                                    <font color="red">Remove</a>
                                </div>
                              </div>
                            </td>