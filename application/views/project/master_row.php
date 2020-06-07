                         <?php     $logo = $row['logo'];
                           
                            ?>

                            <td> <div class="d-flex align-items-center" style="cursor: pointer;">
                        <img src="<?php echo base_url(!empty($logo)? '/upload/project_logo/'.$logo : 'assets/images/client1.jpg'); ?>" alt="profile" onclick="window.location.href = '<?php echo base_url("project/project_info/".$row["id"]); ?>';">

                          </div></td>
                            <td><?php echo $row['name'];?></td>
                            <td>
                              <?php 
                              if ($row['total_jobs'] < 1)
                                {?>
                                  <div class="badge badge-danger badge-pill">Pending</div>
                                <?php }else{ ?>
                                <div class="badge badge-outline-success badge-pill">
                                  <?php echo $row['total_finished_jobs']."&#47;".$row['total_jobs'];?>
                                </div>
                               <?php } ?>
                            </td>
                            <td><?php echo $row['customer_name'];?></td>
                            <td>₹<?php echo $row['price'];?></td>
                            <td><?php echo $row['created_at'];?></td>
                            <?php 
                            $followers = unserialize($row['follow']);
                            ?>
                            <td>
                              <?php if ($followers)
                              {?>
                              <span id="assign_button_<?php echo $row['id'] ?>" class="assign_button btn btn-outline-secondary btn-rounded btn-icon add_follower" data-id="<?php echo $row['id']; ?>" data-follow="<?php echo $row['follow']; ?>">
                                <span class="ti-plus follower-plus"></span>                          
                              </span>

                             <div class="d-flex align-items-center followers-list ">
                              <?php
                              foreach ($followers as $key => $value) {
                                $follower = $this->employee_model->getDetails($value);
                                $photo_f = $follower['photo'];
                                ?>
                            <img data-id="<?php echo $follower['id'];?>" class="followers-img-<?php echo $row['id']; ?>" title="<?php echo $follower['nick_name'];?>" src="<?php echo base_url(!empty($photo_f)? '/upload/employee_photo/'.$photo_f : 'assets/images/client1.jpg'); ?>"  alt="profile"/>
                          <?php } ?>
                            </div>
                          <?php }
                          else{
                           ?>
                               <span style="float: left;left: 90px;" id="assign_button_<?php echo $row['id'] ?>" class="assign_button btn btn-outline-secondary btn-rounded btn-icon add_follower" data-id="<?php echo $row['id']; ?>" data-follow="<?php print_r($followers); ?>">
                                <span class="ti-plus follower-plus"></span>                          
                              </span>                          
                          <?php }
                          ?>
                          </td>                            
                            <td>
                                    <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <span class="dropdown-item" onclick="deleteRow('<?php echo base_url('project/finish/'.$row['id']);?>')">Finish</span>
                                  <a class="dropdown-item" href="<?php echo base_url('project/edit/'.$row['id'].'/master_list');?>">Edit</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="deleteRow('<?php echo base_url('project/delete/'.$row['id']);?>')"><font color="red">Remove</a>
                                </div>
                              </div>
                            </td>
