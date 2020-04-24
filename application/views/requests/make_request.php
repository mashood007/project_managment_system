
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">Make a request</h4>
                   <?php echo form_open("request") ?>
                    <p class="card-description">
                      Request details
                    </p>



                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">To</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="employee_id" id="employee_id">

                              <option value="">-</option>
                              <?php foreach($employees as $row)
                                { ?>                         
                              <option value="<?php echo $row['request_to'];?>"><?php echo $row['nick_name'];?></option>
                            <?php }?>
                           </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Subject</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="request Subject" name="Subject" />
                          </div>
                        </div>
                      </div>
                    </div>


                     <div class="form-group">
                      <label for="exampleTextarea1">Description</label>
                      <textarea name="description" class="form-control" id="exampleTextarea1" rows="4" placeholder="Write your request details.."></textarea>
                    </div>



                     <button type="submit" class="btn btn-success btn-block mb-2">Send Request</button>
                   <?php echo form_close() ?>
                   <button onClick="window.location.reload();" class="btn btn-light">Cancel</button>
                </div>
              </div>
            </div>

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body" style="background-color:#fff2f2;">
                  <h4 class="display-4"><i class="ti-arrow-up"></i> Pending Requests</h4>
                  <p class="card-description">Your <code id="code_count"></code> requests is pending!</p>
                  <div class="mt-4">
                    <div class="accordion accordion-bordered" id="accordion-6" role="tablist" >
          
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
                             <font color="red"><?php echo $row['subject'];?></font>
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
                                <p class="mb-0"><?php echo $row['description']; ?></p>
                                <font color="grey" size="0.2"><strong><font color="red">To</font></strong> <?php echo $row['nick_name']; ?></font><br><br>
                                <a href="<?php echo base_url('Request/delete/'.$row['id']); ?>" type="button" class="btn btn-danger btn-rounded btn-fw">
                                
                                Cancel
                                </a>        
                                <button type="button" class="btn btn-warning btn-rounded btn-fw">Edit</button>      
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

        <!-- content-wrapper ends -->
<script type="text/javascript">
  $("#code_count").html('<?php echo $count; ?>')

</script>
<div class="card">
            <div class="card-body">
              <h4 class="display-4">Your Requests History</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                             <th>#</th>
                            <th>To</th>
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

