          <div class="card">
            <div class="card-body">
              <h4 class="display-4">Advanced Lead Inbox</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>Generated on</th>
                            <th>Client</th>
                            <th>Status</th>
                            <th>#</th>
                            <th>Source</th>
                            <th>Data</th>
                            <th>Interested in</th>
                            <th>Assigning</th>
                            <th>#</th>
                            <th>Follower</th>
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

                        <tr>
                            <td><?php echo $row['created_at'];?></td>
                            <td><?php echo $row['client_name'];?>&#44;&nbsp;<?php echo $row['place'];?></td>
                            <?php if ($row['status'] == "0")
                            {
                            ?>
                            <td><div class="badge badge-danger badge-pill">Pending</div></td>
                          <?php }?>

                         
                            <?php if ($row['status'] == "1")
                            {
                            ?>
                            <td><div class="badge badge-outline-danger badge-pill">Very Low</div></td>
                          <?php }?>

                            <?php if ($row['status'] == "2")
                            {
                            ?>
                            <td><div class="badge badge-outline-warning badge-pill">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Low&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
                          <?php }?>


                            <?php if ($row['status'] == "3")
                            {
                            ?>
                            <td><div class="badge badge-outline-info badge-pill">Medium</div></td>
                          <?php }?>
                            <?php if ($row['status'] == "4")
                            {
                            ?>
                            <td><div class="badge badge-outline-primary badge-pill">Highest</div></td>
                          <?php }?>
                            <?php if ($row['status'] == "5")
                            {
                            ?>
                            <td><div class="badge badge-outline-success badge-pill">Confirmed</div></td>
                          <?php }?>


                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)?$photo: 'assets/images/client1.jpg'); ?>" ></div></td>
                            <td><?php echo $row['nick_name'];?></td>
                             <td>
                        <button class="btn btn-success btn-md" onclick="window.location.href = '<?php echo base_url("marketing/lead_info/".$row["id"]); ?>';">Open</button>
                            </td>
                            <td><?php echo $this->LeadService_model->servicesOfLead($row['id']);?></td>
                             <td>
                              <button class="btn btn-primary btn-block mb-2 assign_button" type="button" data-id="<?php echo $row['id']; ?>" data-follow="<?php echo $row['follow']; ?>">
                              Assign</button>


                            </td>
                            <?php $follower = $this->employee_model->getDetails($row['follow']);
                            $photo_f = $follower['photo'];
                            ?>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo_f)? '/upload/employee_photo/'.$photo_f : 'assets/images/client1.jpg'); ?>"  alt="profile"/></div></td>
                            <td><?php echo $follower['nick_name'];?></td>
                            <td>
                              <button class="btn btn-outline-danger" onclick="showSwal('warning-message-and-cancel')">Remove</button>
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
                          
                                    <div class="modal-body" id="form_follow">
                                        <div class="col-md-12">
                                          <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Route</label>
                                            <div class="col-sm-9">
                                              <select class="form-control " id="follow-ddlb" name="follow">
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
                                      <input type="hidden" id="save_assign_url" value="<?php echo base_url("/marketing/assign_employee");?>">
                                      <button type="button" class="btn btn-light cancel-form close_modal">Cancel</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->
            </div>
          </div>
        </div>

