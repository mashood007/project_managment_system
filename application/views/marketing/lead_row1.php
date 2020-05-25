               <?php     $photo = $row['photo'];
                    ?>

                        <tr id="row_<?php echo $row['id']; ?>">
                            <td onclick="window.location.href = '<?php echo base_url("marketing/lead_info/".$row["id"]); ?>';" >
                              <?php echo $row['created_at'];?></td>
                            <td onclick="window.location.href = '<?php echo base_url("marketing/lead_info/".$row["id"]); ?>';">
                              <?php echo $row['client_name'];?>&#44;&nbsp;<?php echo $row['place'];?>
                                
                            </td>
                            <td onclick="window.location.href = '<?php echo base_url("marketing/lead_info/".$row["id"]); ?>';">
                            <?php if ($row['status'] == "0")
                            {
                            ?>
                            <div class="badge badge-danger badge-pill">Pending</div>
                          <?php }?>

                         
                            <?php if ($row['status'] == "1")
                            {
                            ?>
                            <div class="badge badge-outline-danger badge-pill">Very Low</div>
                          <?php }?>

                            <?php if ($row['status'] == "2")
                            {
                            ?>
                            <div class="badge badge-outline-warning badge-pill">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Low&nbsp;&nbsp;&nbsp;&nbsp;</div>
                          <?php }?>


                            <?php if ($row['status'] == "3")
                            {
                            ?>
                            <div class="badge badge-outline-info badge-pill">Medium</div>
                          <?php }?>
                            <?php if ($row['status'] == "4")
                            {
                            ?>
                            <div class="badge badge-outline-primary badge-pill">Highest</div>
                          <?php }?>
                            <?php if ($row['status'] == "5")
                            {
                            ?>
                            <div class="badge badge-outline-success badge-pill">Confirmed</div>
                          <?php }?>
                            <?php if ($row['status'] == "6")
                            {
                            ?>
                            <div class="badge badge-success badge-pill">Sale Closed</div>
                          <?php }?>

                          </td>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo: 'assets/images/client1.jpg'); ?>" ></div></td>
                            <td onclick="window.location.href = '<?php echo base_url("marketing/lead_info/".$row["id"]); ?>';">
                              <?php echo $this->LeadService_model->servicesOfLead($row['id']);?></td>
                            <?php 
                            $followers = unserialize($row['follow']);
                            ?>
                            <td>
                              <?php if ($followers)
                              {
                                if ($row['created_by'] == $user_id)
                                {
                                ?>

                              <span id="assign_button_<?php echo $row['id'] ?>" class="assign_button btn btn-outline-secondary btn-rounded btn-icon add_follower" data-id="<?php echo $row['id']; ?>" data-follow="<?php echo $row['follow']; ?>">
                                <span class="ti-plus follower-plus"></span>                          
                              </span>
                            <?php }
                            else
                            {
                              ?>
                              <div style="padding: 5px;float:right;"></div>
                              <?php
                            }
                             ?>
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
                          elseif ($row['created_by'] == $user_id){
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
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("marketing/lead_info/".$row["id"]); ?>';">Open</span>
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("marketing/to_estimate/".$row["id"]); ?>';">Create Estimate</span>
                                  <?php                                
                                   if ($row['created_by'] == $user_id)
                                    {?>
                                   <div class="dropdown-divider"></div>

                                  <a class="dropdown-item" href="#" onclick="deleteRow('<?php echo base_url('marketing/delete_lead/'.$row['id']);?>')"><font color="red">Remove</a>
                                  <?php } ?>
                                </div>
                              </div>
                            </td>
                        </tr>