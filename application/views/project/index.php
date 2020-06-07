          <div class="card">
            <div class="card-body">
              <h4 class="display-4">Projects</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Project</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Remaining</th>
                            <th>Managed by</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($projects as $row) { ?>
                          
                        <tr>
                            <?php $logo = $row['logo'];

                            $end_date = new DateTime($row['end_date']);
                            $start_date = new DateTime();

                            $estimate_time = $start_date->diff($end_date);
                            ?>                          
                            <td> 
                              <div class="d-flex align-items-center" style="cursor: pointer;">
                                <img src="<?php echo base_url(!empty($logo)? '/upload/project_logo/'.$logo : 'assets/images/client1.jpg'); ?>" alt="profile" onclick="window.location.href = '<?php echo base_url("project/project_info/".$row["id"]); ?>';">
                            </div>
                          </td>
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
                            <td><?php echo $row['complete'];?>% completed</td>
                            <td><div class="badge badge-outline-danger badge-pill"><i class="mdi mdi-timer"></i>&nbsp;
                              <?php
                             echo $estimate_time->format("%R%a") < 0 ? "Over" : $estimate_time->format("%a")." Days" ;
                               ?> </div></td>
                            <?php 
                            $followers = unserialize($row['follow']);
                            ?>
                            <td>
                              <?php if ($followers)
                              {?>

                             <div class="d-flex align-items-center followers-list " style="float: left">
                              <?php
                              foreach ($followers as $key => $value) {
                                $follower = $this->employee_model->getDetails($value);
                                $photo_f = $follower['photo'];
                                ?>
                            <img data-id="<?php echo $follower['id'];?>" class="followers-img-<?php echo $row['id']; ?>" title="<?php echo $follower['nick_name'];?>" src="<?php echo base_url(!empty($photo_f)? '/upload/employee_photo/'.$photo_f : 'assets/images/client1.jpg'); ?>"  alt="profile"/>
                          <?php } ?>
                            </div>
                          <?php } ?>
                          </td>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("project/to_estimate/".$row["id"]); ?>';">Create Estimate</span>
                                  <div class="dropdown-divider"></div>
                                </div>

                        </tr>
                      <?php } ?>

                       

                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
