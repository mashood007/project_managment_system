             <div class="col-lg-8">
                      <div class="d-flex justify-content-between">

                        <div class="col-sm-6">
                          <button class="btn btn-outline-primary btn-block mb-2" type="button" data-toggle="modal" data-target="#exampleModal-2" >
                          <i class="mdi mdi-calendar-clock btn-icon-prepend"></i> Schedule Meeting </button>
                        </div>
                        <div class="col-sm-6">
                          <button class="btn btn-outline-success btn-block mb-3" type="button" data-toggle="modal" data-target="#exampleModal-3" >
                          <i class="mdi mdi-human-greeting btn-icon-prepend"></i> Add Availability </button>
                        </div>
                        

                        <!-- Start Shedule modal-->
                         <div class="modal fade" id="exampleModal-2" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog modal-m" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2">Schedule</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <?php echo form_open("meeting/add_meeting") ?>
                        <div class="modal-body form-group row">
                             <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date</label>
                                <div class="col-sm-9">
                                  <div id="datepicker-popup" class="input-group date datepicker">
                                    <input name="schedule_date" type="text" class="form-control">
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
                          <label class="col-sm-3 col-form-label">Type</label>
                          <div class="col-sm-9">
                            <select name="type" class="form-control">
                              <option value="online meeting">Online Meeting</option>
                              <option value="direct meeting">Direct Meeting</option>
                              <option value="via telephone">Via Telephone</option>
                            </select>
                          </div>
                        </div>
                      </div>

                       <div class="col-md-12">
                           <div class="form-group">
                           <textarea name="location" class="form-control" id="exampleTextarea1" rows="4" placeholder="Location/Link"></textarea>
                            </div>
                       </div>

                            
                                
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Visitor</label>
                          <div class="col-sm-9">
                            <input name="visitor" type="text" class="form-control" placeholder="Name of vistor" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input name="email" type="text" class="form-control" placeholder="email" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone</label>
                          <div class="col-sm-9">
                            <input name="phone" type="text" class="form-control" placeholder="Phone" />
                          </div>
                        </div>
                      </div>
                       <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Purpose</label>
                          <div class="col-sm-9">
                            <input name="purpose" type="text" class="form-control" placeholder="Meeting Agenda/Purpose" />
                          </div>
                        </div>
                      </div>

                                       
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Schedule</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                       <?php echo form_close() ?>

                      </div>
                    </div>
                  </div>
                        <!-- End Shedule modal-->





                        <!-- Start availability modal-->
                         <div class="modal fade" id="exampleModal-3" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel-3" aria-hidden="true">
                    <div class="modal-dialog modal-m" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-3">Availability</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <?php echo form_open("meeting/add_availability") ?>
                        <div class="modal-body form-group row">
                          
                             <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date</label>
                          <div class="col-sm-9">
                            <div  class="input-group date datepicker datepicker-popup">
                            <input name="schedule_date" type="text" class="form-control" placeholder="dd/mm/yyyy">
                             <span class="input-group-addon input-group-append border-left">
                             <span class="ti-calendar input-group-text"></span>
                             </span>
                           </div>
                         </div>
                              </div>
                            </div>
                          
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Start Time</label>
                                <div class="col-sm-9">
                                 <div class="input-group date" id="timepicker-example2" data-target-input="nearest">
                                   <div class="input-group" data-target="#timepicker-example2" data-toggle="datetimepicker">
                                   <input name="start_time" type="text" required name="schedule_time" class="form-control datetimepicker-input" data-target="#timepicker-example1"/>
                                   <div class="input-group-addon input-group-append"><i class="ti-time input-group-text"></i></div>
                                 </div>
                               </div>
                              </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">End Time</label>
                                <div class="col-sm-9">
                                 <div class="input-group date" id="timepicker-example1" data-target-input="nearest">
                                   <div class="input-group" data-target="#timepicker-example1" data-toggle="datetimepicker">
                                   <input name="end_time" type="text" class="form-control datetimepicker-input" data-target="#timepicker-example1"/>
                                   <div class="input-group-addon input-group-append"><i class="ti-time input-group-text"></i></div>
                                 </div>
                               </div>
                              </div>
                              </div>
                            </div>


                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Type</label>
                          <div class="col-sm-9">
                            <select name="type" class="form-control">
                              <option value="online meeting">Online Meeting</option>
                              <option value="direct meeting">Direct Meeting</option>
                              <option value="via telephone">Via Telephone</option>
                            </select>
                          </div>
                        </div>
                      </div>
                            


                                      <div class="col-md-12">
                                       <div class="form-group">
                                          <textarea name="location" class="form-control" id="exampleTextarea1" rows="4" placeholder="Location/Link"></textarea>
                                        </div>
                                      </div>

                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success">Publish</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                        <?php echo form_close() ?>
                      </div>
                    </div>
                  </div>
                        <!-- End availability modal-->


                      </div>
                    </div>


          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">

                <div class="col-12 col-xl-12">
                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-human-male-female"></i> Total meetings</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4"><?php echo $total_meetings; ?></font><font size="1">&nbsp;Meetings</font></h4>
                    </div>

                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-human-male-female"></i> In this year</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4"><?php echo $yearly_meetings; ?></font><font size="1">&nbsp;Meetings</font></h4>
                    </div>

                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-human-male-female"></i>In This month</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4"><?php echo $monthly_meetings;?></font><font size="1">&nbsp;Meetings</font></h4>
                    </div>
                    
                  

                    <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-9">
                            <select class="form-control" id="filter_meetings">
                              <option value="upcoming">Upcoming Meetings</option>
                              <option value="completed">Completed Meetings</option>
                              <option value="pending">Pending Schedules</option>
                            </select>
                          </div>
                        </div>
                      </div>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h4 class="display-4">Meetings</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                            <th>#</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Visitor</th>
                            <th>Scheduled for</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="meeting_table_body">
                        <?php
                        $slno = 0;
                        foreach ($meetings as $row) {
                          $end_date = new DateTime($row['schedule_date']);
                          $start_date = new DateTime();
                          $time =  $start_date->diff($end_date);
                          ?>
                        <tr id="row_<?php echo $row['id']; ?>">
                            <td><?php echo $slno += 1; ?></td>
                            <td><?php echo ucwords($row['type']);?></td>
                           <?php if ($time->format("%R%a") >= 0) { ?>
                            <td><div class="badge badge-outline-success badge-pill"><i class="mdi mdi-timer"></i>
                              <?php
                             echo $time->format("%a")." Days" ;
                               ?></div></td>
                             <?php } 
                             else { ?>
                              <td>
                                <div class="badge badge-danger badge-pill"><i class="mdi mdi-timer"></i>&nbsp;Time Over</div>
                              </td>
                            <?php } ?>
                            <td><?php echo $row['visitor'];?></td>
                            <td>
                              <?php echo date('d-m-Y',strtotime(str_replace('-','/', $row['schedule_date']))).'- '.$row['schedule_time'];?>
                                
                            </td>
                            <td>
                              <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("meeting/info/".$row['id']);?>';">Show</span>                                  
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("meeting/finish/".$row['id']);?>';">Finish</span>

                                  <div class="dropdown-divider"></div>
                                  <span class="dropdown-item" onclick="deleteRow('<?php echo base_url("meeting/delete/".$row['id']);?>')">
                                    <font color="red">Remove</span>
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

