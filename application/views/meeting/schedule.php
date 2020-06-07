<div class="col-lg-8">
                      <div class="d-flex justify-content-between">

                        <?php echo form_open("meeting/add_meeting") ?>
                        <div class="form-group row">
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
                          <label class="col-sm-3 col-form-label">Purpose</label>
                          <div class="col-sm-9">
                            <input name="purpose" type="text" class="form-control" placeholder="Meeting Agenda/Purpose" />
                          </div>
                        </div>
                      </div>

                                       
                        </div>
                        <div class="row">
                          <button type="submit" class="btn btn-primary">Schedule</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                       <?php echo form_close() ?>
            </div>
          </div>
        </div>