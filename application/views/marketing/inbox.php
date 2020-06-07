<?php $user_id =  $this->session->userdata['logged_in']['user_id'];?>
          <div class="card">
            <div class="card-body">
              <h4 class="display-4">Leads</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table table-hover">
                      <thead>
                        <tr>
                            <th>Generated on</th>
                            <th>Client</th>
                            <th>Status</th>
                            <th>Source</th>
                            <th>Interested in</th>
                            <th>Shared With</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                  <?php
                  $slno = 1;
                  foreach($leads as $row)
                  {
                    $photo = $row['photo'];
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
                      <?php }?>

                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

                        <!-- Start Follow modal-->
                              <div class="modal fade" id="assign_modal" tabindex="-1" role="dialog" aria-labelledby="assign_modal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel-2">Assign Information</h5>
                                      <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                          
                                    <div class="modal-body row" id="form_follow">
                                        <div class="col-md-12 ">
                                          <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Route</label>
                                            <div class="col-sm-9">
                                              <select style="width: 220px;" class="js-example-basic-multiple w-100" multiple="multiple" id="follow-ddlb" name="follow[]">
                                                <option value="0">-</option>
                                                <?php 
                                              foreach($deployments as $row)
                                                  {          
                                                ?>
                                                <option value="<?php echo $row['id'];?>"><?php echo  $row['nick_name'];?></option>
                                                <?php 
                                              }
                                              ?>
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                    </div>                                     
                                    <div class="modal-footer">
                                      <button type="submit" id="save_assign" class="btn btn-success">Save Changes</button>
                                      <input type="hidden" id="save_assign_url" value="<?php echo base_url("/marketing/assign_employee/lead_inbox");?>">
                                      <button type="button" class="btn btn-light cancel-form close_modal">Cancel</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->
            </div>
          </div>
        </div>
