        <div class="card">
            <div class="card-body">
              <h4 class="display-4">Parties/Companies</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Party</th>
                            <th>Mobile</th>
                            <th>Created by</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php
                      foreach($parties as $row)
                      {
                        $photo = $row['photo'];
                        $employee_photo = $row['employee_photo'];
                      ?>      
                        <tr id="row_<?php echo $row['id'];?>">
                          <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/party_photo/'.$photo: 'assets/images/client1.jpg'); ?>" ></div></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['mobile1'];?></td>

                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($employee_photo)? '/upload/employee_photo/'.$employee_photo: 'assets/images/client1.jpg'); ?>" ></div></td>
                            <td>
                                    <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <a class="dropdown-item" href="<?php echo base_url('party/profile_info/'.$row['id']);?>">Profile</a>
                                  <a class="dropdown-item" href="<?php echo base_url('party/edit/'.$row['id']);?>">Edit</a>
                                  
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="deleteRow('<?php echo base_url('party/delete/'.$row['id']);?>')">
                                    <font color="red">Remove</a>
                                </div>
                              </div>
                            </td>
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
