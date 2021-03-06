<div class="card">
            <div class="card-body">
              <h4 class="display-4">Master Project Controller</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Project</th>
                            <th>Status</th>
                            <th>Customer</th>
                            <th>Price</th>
                            <th>Installed On</th>
                            <th>Shared With</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                            <?php 
                            foreach($projects as $row)
                            {?>
                              
                        <tr id="row_<?php echo $row['id'];?>">
                            <?php $logo = $row['logo'];?>

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
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("project/to_invoice/".$row["id"]); ?>';">Copy to Invoice</span>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="deleteRow('<?php echo base_url('project/delete/'.$row['id']);?>')"><font color="red">Remove</a>
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
                                      <input type="hidden" id="save_assign_url" value="<?php echo base_url("/project/assign_employee");?>">
                                      <button type="button" class="btn btn-light cancel-form close_modal">Cancel</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->

            </div>
          </div>
        </div>
