<div class="card">
            <div class="card-body">
              <h4 class="display-4">Installed Project</h4>
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
                            <th>Assigning</th>
                            <th>Edit</th>
                            <th>Installed On</th>
                            <th>Finish</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                            <?php 
                            foreach($projects as $row)
                            {
                              
                              $logo = $row['logo'];
                           
                            ?>

                        <tr>
                            <td> <div class="d-flex align-items-center" style="cursor: pointer;">
                        <img src="<?php echo base_url(!empty($logo)? '/upload/project_logo/'.$logo : 'assets/images/client1.jpg'); ?>" alt="profile" onclick="window.location.href = '<?php echo base_url("project/project_info/".$row["id"]); ?>';">

                          </div></td>
                            <td><?php echo $row['name'];?></td>
                            <td><div class="badge badge-danger badge-pill">Pending</div></td>
                            <td><?php echo $row['customer_name'];?></td>
                            <td>₹<?php echo $row['price'];?></td>
                            <td>
                             <button class="btn btn-primary btn-block mb-2 assign_button" type="button" data-id="<?php echo $row['id']; ?>" data-follow="<?php echo $row['follow']; ?>">
                              Assign</button>
                            </td>
                             <td>
                              <button class="btn btn-outline-primary">Edit data</button>
                            </td>
                            <td><?php echo $row['created_at'];?></td>
                            <td>
                              <button class="btn btn-outline-success" onclick="showSwal('warning-message-and-cancel')">Finish</button>
                            </td>
                            <td>
                              <button class="btn btn-outline-danger" onclick="showSwal('warning-message-and-cancel')">Remove</button>
                            </td>
                        </tr>
                      <?php }?>




                        <tr>
                            <td> <div class="d-flex align-items-center">
                            <img src="../../images/client-DP/project2.jpg" alt="profile" onclick="window.location.href = 'project-info.html';"/></div></td>
                            <td>Yams Innovations</td>
                            <td><div class="badge badge-outline-success badge-pill">2&#47;8</div></td>
                            <td>Customer 1</td>
                            <td>₹14,20,000.00</td>
                            <td>
                              <button class="btn btn-primary" onclick="window.location.href = 'project-info.html';">Assign</button>
                            </td>
                             <td>
                              <button class="btn btn-outline-primary">Edit data</button>
                            </td>
                            <td>12/January/2019 12:34am</td>
                             <td>
                              <button class="btn btn-outline-success" onclick="showSwal('warning-message-and-cancel')">Finish</button>
                            </td>
                            <td>
                              <button class="btn btn-outline-danger" onclick="showSwal('warning-message-and-cancel')">Remove</button>
                            </td>
                        </tr>

                        
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
                                      <input type="hidden" id="save_assign_url" value="<?php echo base_url("/project/assign_employee");?>">
                                      <button type="button" class="btn btn-light cancel-form close_modal">Cancel</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->
                        