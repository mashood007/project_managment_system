
         <div class="col-lg-12 grid-margin stretch-card">
              <div class="card" style="background-color:#f4fff0;">
                <div class="card-body">
                  <h4 class="display-4"><i class="ti-arrow-down"></i> Waiting Permissions</h4>
                  <p class="card-description"><code id="code_count"></code> Requests is waiting for your permissions!</p>
                  <div class="mt-4">
                    <div class="accordion accordion-solid-content" id="accordion-6" role="tablist">


                    <?php 

                    $count = 0; 
                    foreach($all_records as $row)
                      { 

                        if ($row['status'] != 0)
                        {
                        continue;
                        }
                        $photo = $row['photo'];
                        $count = $count+1;  
                        ?>                        
                      <div class="card">
                        <div class="card-header" role="tab" id="heading-<?php echo $row['id']; ?>">
                          <h6 class="mb-0">
                            <a data-toggle="collapse" href="#collapse-<?php echo $row['id']; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $row['id']; ?>" >
                            <font><?php echo $row['nick_name']; ?> requests to you:</font>  <font color="#74be2b"><?php echo $row['subject'];?></font>
                            </a>
                          </h6>
                        </div>
                        <div id="collapse-<?php echo $row['id']; ?>" class="collapse" role="tabpanel" aria-labelledby="heading-<?php echo $row['id']; ?>" data-parent="#accordion-6">
                          
                          <div class="card-body">
                            <div class="row">
                              <div class="col-3">
                                 <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" class="mw-100" alt="image"/>                    
                              </div>
                              <div class="col-9">
                                <p class="mb-0"><?php echo $row['description']; ?></p> <br>
                                <a href="<?php echo base_url('Request/status/'.$row['id'].'/2'); ?>" type="button" class="btn btn-danger btn-rounded btn-fw">Reject</a>  
                                <a href="<?php echo base_url('Request/status/'.$row['id'].'/1'); ?>" type="button" class="btn btn-light btn-rounded btn-fw">Approve</a>           
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php }?> 

                      
                    </div>
                  </div>
                </div>
              </div>
            </div>








<script type="text/javascript">
  $("#code_count").html('<?php echo $count; ?>')

</script>



        <!-- content-wrapper ends -->

<div class="card">
            <div class="card-body">
              <h4 class="display-4">Your Permissions History</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                             <th>#</th>
                            <th>From</th>
                            <th>Status</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>Requested on</th>
                            <th>Replied on</th>
                        </tr>
                      </thead>
                      <tbody>
                    <?php
                    foreach($all_records as $row)
                      { 

                        if ($row['status'] == 0)
                        {
                        continue;
                        }
                        $photo = $row['photo'];
                        ?>  

                        <tr>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" alt="profile"/></div></td>
                            <td><?php echo $row['nick_name']; ?></td>
                            <?php 
                            if ($row['status'] == 1)
                            {
                            ?>
                            <td><font color="green">Approved</font></td>
                            <?php 
                            }
                            else
                            {
                            ?>
                            <td><font color="red">Rejected</font></td>
                            <?php                               
                            }
                            ?>
                            <td><?php echo $row['subject'];?></td>
                            <td><?php echo $row['description']; ?> </td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>12/April/2019 12:20pm</td>
                        </tr>
                      <?php }?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
