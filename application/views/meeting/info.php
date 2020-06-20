           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="border-bottom text-center pb-4">
                        <img src="<?php echo base_url(!empty($photo)? '/upload/customer_photo/'.$photo : 'assets/images/client1.jpg'); ?>" alt="profile" class="img-lg rounded-circle mb-3"/>
                        <div class="mb-3">
                          <h3><?php echo $meeting['visitor'];?></h3>
                        </div>
                        <p class="w-75 mx-auto mb-3"><?php echo ucwords($meeting['type']);?></p>
                        <div class="d-flex justify-content-center">
                          <button class="btn btn-success mr-1 btn-icon-text" onclick="window.location.href='tel:<?php echo $meeting['phone'];?>'">
                            <i class="mdi mdi-phone btn-icon-prepend"></i>Call</button>
                          <button class="btn btn-primary btn-icon-text" onclick="window.location.href='mailto:<?php echo $meeting['email'];?>'">
                          <i class="mdi mdi-email-open-outline btn-icon-prepend"></i></i>Email</button>
                        </div>
                      </div>
                     

                      <div class="profile-feed">
                        <div>
                           <div class="py-4">
                        <p class="clearfix">
                          <span class="float-left">
                            Time
                          </span>
                          <span class="float-right text-muted">
                            <?php
                            $time = !empty($meeting['start_time']) ? $meeting['start_time']." to ".$meeting['end_time'] : $meeting['schedule_time'];
                             echo date('d-m-Y',strtotime(str_replace('-','/', $meeting['schedule_date']))).'  '.$time;?>
                          </span>
                        </p>

                         <p class="clearfix">
                          <span class="float-left">
                            Purpose
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $meeting['purpose']; ?>
                          </span>
                        </p>
                      </div>
                    </div>
                  </div>
                      
                     
                     
                    </div>
                    <div class="col-lg-8">
                     
                     
                      <div class="profile-feed">
                        <div>
                           <div class="py-4">
                        <p class="clearfix">
                          <span class="float-left">
                            Location/Link
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $meeting['location']; ?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Industry
                          </span>
                          <span class="float-right text-muted">
                           <?php echo $meeting['industry']; ?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Mode
                          </span>
                          <span class="float-right text-muted">
                           <?php echo ucwords($meeting['mode']); ?>
                          </span>
                        </p>




                       

                        <p class="clearfix">
                          <span class="float-left">
                            Phone 
                          </span>
                          <span class="float-right text-muted">
                            <a href="tel:<?php echo $meeting['phone']; ?>"><?php echo $meeting['phone']; ?></a>
                          </span>
                        </p>




                         <p class="clearfix">
                          <span class="float-left">
                            Email
                          </span>
                          <span class="float-right text-muted">
                            <a href="mailto:<?php echo $meeting['email']; ?>"><?php echo $meeting['email']; ?></a>
                          </span>
                        </p>

                      </div>
                        </div>
                       
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            



        </div>
      </div></div>
