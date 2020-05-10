<?php $user_id =  $this->session->userdata['logged_in']['user_id'];
?>
<input type="hidden" id="rate_lead_base_url" value="<?php echo base_url("/marketing/rate_lead");?>">
           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="border-bottom text-center pb-4">

                        <img src="<?php echo base_url('assets/images/client1.jpg'); ?>" alt="profile" class="img-lg rounded-circle mb-3"/>
                        <div class="mb-3">
                          <h3><?php echo $lead['client_name'];?></h3>
                          <p class="text-muted mb-0"><?php echo $lead['company'];?>&#44;&nbsp;<?php echo $lead['place'];?></p>
                          <p><i class="mdi mdi-phone btn-icon-prepend"></i>&nbsp;<?php echo $lead['phone'];?>&nbsp;&nbsp;|&nbsp;&nbsp;<i class="mdi mdi-whatsapp btn-icon-prepend"></i>&nbsp;<?php echo $lead['whatsapp'];?><br><i class="mdi mdi-email-open-outline btn-icon-prepend"></i>&nbsp;<?php echo $lead['email'];?></p>
                          <div class="d-flex align-items-center">
                            <p class="text-muted mb-0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Priority Rating:&nbsp;&nbsp; </p>
                            <input type="hidden" id="lead_status" name="" value="<?php echo $lead['status'];?>">
                            <select id="profile-rating" class="lead-status" name="rating" autocomplete="off">
                              <option value=""></option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                            </select>
                          </div>
                        </div>
                     
                        <div class="d-flex justify-content-center">
                          <button class="btn btn-success mr-1 btn-icon-text" onclick="window.location.href='tel:<?php echo $lead['phone'];?>'">
                            <i class="mdi mdi-phone btn-icon-prepend"></i>Call</button>
                          <button class="btn btn-success mr-1 btn-icon-text" onclick="window.location.href='https://api.whatsapp.com/send?phone=<?php echo $lead['whatsapp']; ?>&text=Hello'">
                            <i class="mdi mdi-whatsapp btn-icon-prepend"></i>WhatsApp</button>
                          <button class="btn btn-primary btn-icon-text" onclick="window.location.href='mailto:<?php echo $lead['email'];?>'">
                          <i class="mdi mdi-email-open-outline btn-icon-prepend" >
                            
                          </i></i>Email</button>


                        </div>
                      </div>
                      <div class="border-bottom py-4">
                        <p><font color="grey">Interested in</font></p>
                        <div>
                          <?php 
                          foreach($services as $service)
                          {
                          ?>
                          <label class="badge badge-outline-dark"><?php echo $service['service']; ?></label>
                          <?php }?>
       
                        </div><br>    
                        <p><font color="grey">About Inquiry:</font></p> 
                        <p><?php echo $lead['about'];?></p><br>

                         <p><font color="grey">Estimated Price:&nbsp;</font>₹<?php echo $lead['est_price'];?></p><br>
                         <p><font color="grey">Source:&nbsp;</font>Employee</p>
                         <p><font color="grey">Generated on:&nbsp;</font><?php echo $lead['created_at'];?></p>
                         
                      </div><br>

                      <?php if ($lead['status'] == 6){?>
                        <div class="alert alert-success">Already Converted</div>
                      <?php } ?>
                      <button class="btn btn-success btn-block mb-2" onclick="window.location.href='<?php echo base_url('marketing/convert_as_customer/'.$lead['id']);?>'">Convert as customer <i class="mdi mdi-account-multiple-plus"></i></button>
                      <button class="btn btn-warning btn-block mb-2" onclick="window.location.href='<?php echo base_url('marketing/edit_lead/'.$lead['id']);?>'">
                        Edit Data <i class="mdi mdi-pen"></i></button><br>
                    </div>
                    <div class="col-lg-8">
                      <div class="d-flex justify-content-between">

                        <div class="col-sm-6">
                          <button class="btn btn-outline-primary btn-block mb-2" type="button" data-toggle="modal" data-target="#exampleModal-3" >
                          <i class="mdi mdi-calendar-clock btn-icon-prepend"></i>Shedule </button>
                        </div>
                          <div class="col-sm-6">
                          <button class="btn btn-outline-success btn-block mb-2" type="button" data-toggle="modal" data-target="#exampleModal-2">
                          <i class="mdi mdi-plus btn-icon-prepend"></i>Add Follow</button>      
                        </div>

                        <!-- Start Shedule modal-->
                         <div class="modal fade" id="exampleModal-3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-3" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-3">Shedule</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                          <?php echo form_open("lead_schedule/add/".$lead['id']) ?>

                        <div class="modal-body form-group row">
                             <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date</label>
                                <div class="col-sm-9">
                                  <div id="datepicker-popup" class="input-group date datepicker">
                                    <input type="text" required name="schedule_date" class="form-control">
                                    <span class="input-group-addon input-group-append border-left">
                                    <span class="ti-calendar input-group-text"></span>
                                   </span>
                                 </div>
                                </div>
                              </div>
                            </div>
                          
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Time</label>
                                <div class="col-sm-9">
                                 <div class="input-group date" id="timepicker-example" data-target-input="nearest">
                                   <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
                                   <input type="text" required name="schedule_time" class="form-control datetimepicker-input" data-target="#timepicker-example1"/>
                                   <div class="input-group-addon input-group-append"><i class="ti-time input-group-text"></i></div>
                                 </div>
                               </div>
                              </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <textarea class="form-control" name="notes" placeholder="Notes"></textarea>
                                </div>
                              </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Shedule</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                        <?php echo form_close(); ?>
                      </div>
                    </div>
                  </div>
                        <!-- End Shedule modal-->




                        <!-- Start Follow modal-->
                              <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel-2">Follow Information</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                          
                                    <?php echo form_open("LeadFollow/add_new") ?>
                                    <div class="modal-body" id="form_follow">
                                        <div class="col-md-12">
                                          <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Route</label>
                                            <div class="col-sm-9">
                                              <select class="form-control" id="route_type" name="route">
                                                <option>-</option>
                                                <option value="call">Call</option>
                                                <option value="whatsapp">WhatsApp</option>
                                                <option value="email">Email</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <textarea class="form-control" id="replay" name="replay" rows="4" placeholder="Reply"></textarea>
                                        </div>
                                    </div>                                     
                                    <div class="modal-footer">
                                      <button type="submit" id="add_new_form" class="btn btn-success">Add Follow</button>
                                      <button type="button" class="btn btn-light cancel-form" data-dismiss="modal">Cancel</button>
                                    </div>
                                    <input type="hidden" id="lead_id" name="lead_id" value="<?php echo $lead['id'];?>">
                                    <?php echo form_close(); ?>

                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->



                      </div>
                      <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav profile-navbar">
                          <?php foreach ($schedules as $row) { ?>
                          <li class="nav-item item_<?php echo $row['id'];?>">
                            <div class="nav-link" href="#">
                              <i class="mdi mdi-message-reply-text"></i>
                              Follows &nbsp;&nbsp;&nbsp; 
                              <font size=".5" color="grey"><i class="mdi mdi-calendar-clock btn-icon-prepend"></i> Next Shedule: 24/March/2019 10:00am</font>
                            
                              <?php 
                                if ($user_id == $row['created_by'])
                                {
                                ?>
                                <small class="ml-4 text-muted">
                              <a onclick="deleteItem('<?php echo base_url('lead_schedule/delete/'.$row['id']);?>')" class="text-danger">
                                 Remove</a></small>
                              <?php } ?>
                              </div>
                          </li>
                        <?php } ?>
                        </ul>
                      </div>
                      <div class="profile-feed">

                        <?php 
                        foreach($lead_follows as $follow)
                        {
                          $photo = $row['photo'];
                        ?>       
                        <div id="row_1_<?php echo $follow['id'];?>" class="d-flex align-items-start profile-feed-item">
                           <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo: 'assets/images/lockscreen-bg.jpg'); ?>" class="img-sm rounded-circle">
                          <div class="ml-4">
                            <h6>
                              <?php echo $follow['nick_name'];?>
                              <small class="ml-4 text-muted">
                                <i class="ti-time mr-1"></i><?php echo $follow['created_at'];?> &nbsp;&nbsp;&nbsp;<span>
                                  <?php if ($follow['route'] == 'email')
                                  {
                                    $icon ="mdi-email-open-outline";
                                  }
                                  elseif ($follow['route'] == "whatsapp") {
                                    $icon = "mdi-whatsapp";
                                  }
                                  else
                                  {
                                    $icon = "mdi-phone";
                                  }?>
                                <i class="mdi <?php echo $icon;?>"></i> <?php echo $follow['route'];?>
                              </span>&nbsp;&nbsp;&nbsp;
                              <?php 
                             
                                if ($user_id == $follow['created_by'])
                                {
                                ?>
                              <a onclick="deleteRow('<?php echo base_url('LeadFollow/delete/'.$follow['id']);?>')" class="text-danger">
                                <i class="mdi mdi-window-close"></i> Remove</a>
                              <?php } ?>
                              </small> 
                            </h6>
                            <p>
                              <?php echo $follow['replay'];?>
                            </p>
                          </div>
                        </div>
                      <?php }?>
                       
                        
                      </div>

                    
                       
                   
                    </div>
                  </div>
                </div>

              </div>
           




        </div>
      </div></div>