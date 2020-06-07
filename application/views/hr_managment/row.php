      <?php
                          $photo = $row['photo'];
                          $role = $this->role_model->getRoleDetails($row['role']);
                          $status = $row['status'] == 0? "active-client" : "inactive-client" ;
                        ?>
                            <td>XE<?php echo $row['id'];?></td>
                            <td><?php echo $role['designation'];?></td>
                            <td> <div class="profile">
                             <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" >
                             <div class="client-status <?php echo $status; ?>">
                           </div></td>
                            <td><?php echo $row['full_name'];?></td>
                            <td><?php echo $row['user_name'];?></td>
                            <td><?php echo $row['user_password'];?></td>
                            <td>
                                    <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("hrmanagement/employee_profile_info/".$row['id']) ?>';">Open</span>

                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("hrmanagement/user_connctions/".$row['id']) ?>';">Connection</span>

                                  
                                  <a class="dropdown-item" href="<?php echo base_url('hrmanagement/edit/'.$row['id']);?>">Edit</a>

                                  <?php if ($row['status'] == 0)
                                  {?>
                                    <span class="set-active-inactive dropdown-item" onclick="activeClient('<?php echo base_url('hrmanagement/inactive/'.$row['id']);?>','<?php echo $row['id'];?>')">Set Inactive</span>
                                  <?php
                                  }
                                  else
                                  { ?>
                                    <span class="set-active-inactive dropdown-item" onclick="activeClient('<?php echo base_url('hrmanagement/active/'.$row['id']);?>','<?php echo $row['id'];?>')">Set Active</span>
                                  <?php 
                                  }
                                  ?>

                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="deleteRow('<?php echo base_url('hrmanagement/delete/'.$row['id']);?>')"><font color="red">Remove</a>
                                </div>
                              </div>
                            </td>
