           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="border-bottom text-center pb-4">
                        <?php $photo = $profile_info['photo'];?>
                        <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" alt="profile" class="img-lg rounded-circle mb-3"/>
                        <div class="mb-3">
                          <h3><?php echo $profile_info['full_name']; ?></h3>
                          <p class="text-muted mb-0"><?php echo $profile_info['designation']; ?></p>
                        </div>
                        <p class="w-75 mx-auto mb-3"><?php echo $profile_info['about']; ?></p>

                        <div class="d-flex justify-content-center">
                          <button class="btn btn-success mr-1 btn-icon-text" onclick="window.location.href='tel:<?php echo $profile_info['mobile1'];?>'">
                            <i class="mdi mdi-phone btn-icon-prepend"></i>Call</button>

                          <button class="btn btn-success mr-1 btn-icon-text" onclick="window.location.href='https://api.whatsapp.com/send?phone=<?php echo $profile_info['whatsapp']; ?>&text=Hello'">
                            <i class="mdi mdi-whatsapp btn-icon-prepend"></i>WhatsApp</button>
                          <button class="btn btn-primary btn-icon-text" onclick="window.location.href='mailto:<?php echo $profile_info['email'];?>'">
                          <i class="mdi mdi-email-open-outline btn-icon-prepend"></i></i>Email</button>
                        </div>
                      </div>
                      <div class="border-bottom py-4">
                        <p>Skills</p>
                        <div>
                          <?php $skills = unserialize($profile_info['skills']);
                            foreach ($skills as $key => $value) {
                              $skill = $this->skill_model->byId($value);
                           ?>
                          <label class="badge badge-outline-dark"><?php echo $skill->skill;?></label>
                          <?php } ?> 
                        </div>                                                               
                      </div>
                      
                      <div class="border-bottom py-4">


                        <p class="clearfix">
                          <span class="float-left">
                            Lead Incentive
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $profile_info['marketing_incentive']; ?>%
                          </span>
                        </p>


                        <p class="clearfix">
                          <span class="float-left">
                            Conversion Incentive
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $profile_info['sales_incentive']; ?>%
                          </span>
                        </p>


                        <p class="clearfix">
                          <span class="float-left">
                            Invoice Incentive
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $profile_info['invoice_incentive']; ?>%
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Total Earned
                          </span>
                          <span class="float-right text-success">
                            <?php echo number_format($profile_info['total_salary']+$profile_info['total_revenue']+$profile_info['total_finished_revenue'], 2);?>
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Total Withdrawals
                          </span>
                          <span class="float-right text-danger">
                            <?php echo number_format($profile_info['total_payroll_paid'],2);?>
                          </span>
                        </p>                        

                        <p class="clearfix">
                          <span class="float-left">
                            Balance To Receive
                          </span>
                          <span class="float-right text-info">
                            <?php echo number_format($profile_info['total_salary']+$profile_info['total_revenue']+$profile_info['total_finished_revenue']+$profile_info['total_payroll_received']-$profile_info['total_payroll_paid'], 2);?>
                          </span>
                        </p>

                      </div>

                      <?php
                      $id_proof = $profile_info['id_proof'];
                       if (!empty($id_proof)) { ?>
                      <a target="blank" href="<?php echo base_url('/upload/employee_id_proof/'.$id_proof); ?>" class="btn btn-primary btn-block mb-2">Show ID Proof</a>
                    <?php } ?>
                    </div>
                    <div class="col-lg-8">
                      <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav profile-navbar">
                          <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url('hrmanagement/employee_profile_info/'.$profile_info['id']);?>">
                              <i class="ti-user"></i>
                              Info
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('hrmanagement/profile_jobs/'.$profile_info['id']);?>">
                              <i class="ti-vector"></i>
                              Jobs
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('hrmanagement/payroll/'.$profile_info['id']);?>">
                              <i class="ti-receipt"></i>
                              Payroll
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('hrmanagement/sales/'.$profile_info['id']);?>">
                              <i class="ti-briefcase"></i>
                              Sales
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('hrmanagement/salary/'.$profile_info['id']);?>">
                              <i class="ti-microphone-alt "></i>
                              Salary
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div class="profile-feed">
                        <div>
                           <div class="py-4">
                        <p class="clearfix">
                          <span class="float-left">
                            Status
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $profile_info['status'] == 0 ? "Active User" : "Inactive User";?>
                            
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Gender
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $profile_info['gender']; ?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Date of Birth
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $profile_info['dob']; ?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Marital Status
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $profile_info['marital_status']; ?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Qualification
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $profile_info['qualifications'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Address
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $profile_info['address1'];?>
                          </span>
                           <span class="float-right text-muted">
                           <?php echo $profile_info['address2'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            City
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $profile_info['city'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Postal Code
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $profile_info['post_code'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Country
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $profile_info['country'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Mobile 1
                          </span>
                          <span class="float-right text-muted">
                            <a href="tel:<?php echo $profile_info['mobile1'];?>"><?php echo $profile_info['mobile1'];?></a>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Mobile 2
                          </span>
                          <span class="float-right text-muted">
                            <a href="tel:<?php echo $profile_info['mobile2'];?>"><?php echo $profile_info['mobile2'];?></a>
                          </span>
                        </p>

                         <p class="clearfix">
                          <span class="float-left">
                            WhatsApp
                          </span>
                          <span class="float-right text-muted">
                            <a href="http://wa.me/<?php echo $profile_info['whatsapp'];?>"><?php echo $profile_info['whatsapp'];?></a>
                          </span>
                        </p>

                         <p class="clearfix">
                          <span class="float-left">
                            Email
                          </span>
                          <span class="float-right text-muted">
                            <a href="mailto:<?php echo $profile_info['email'];?>"><?php echo $profile_info['email'];?></a>
                          </span>
                        </p>
                         <p class="clearfix">
                          <span class="float-left">
                            Salary
                          </span>
                          <span class="float-right text-muted">
                           ₹<?php echo number_format($profile_info['salary'],2); ?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Salary Day
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $profile_info['salary_date']; ?>th day of every month
                          </span>
                        </p>
                      </div>
                        </div>
                       
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="card bg-primary border-0 position-relative">
                <div class="card-body">
                  <p class="card-title text-white">Performance Overview</p>
                  <div id="performanceOverview" class="carousel slide performance-overview-carousel position-static pt-2" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <div class="row">
                          <div class="col-md-4 item">
                            <div class="d-flex flex-column flex-xl-row mt-4 mt-md-0">
                              <div class="icon icon-a text-white mr-3">
                                <i class="ti-cup icon-lg ml-3"></i>
                              </div>
                              <div class="content text-white">
                                <div class="d-flex flex-wrap align-items-center mb-2 mt-3 mt-xl-1">
                                  <h3 class="font-weight-light mr-2 mb-1">Revenue</h3>
                                  <h3 class="mb-0">₹ <?php echo number_format($profile_info['total_salary']+$profile_info['total_revenue']+$profile_info['total_finished_revenue'], 2);?></h3>
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                </div>
                                <p class="text-white font-weight-light pr-lg-2 pr-xl-5">The total revenue you received from different works of the company.</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 item">
                            <div class="d-flex flex-column flex-xl-row mt-5 mt-md-0">
                              <div class="icon icon-b text-white mr-3">
                                <i class="ti-bar-chart icon-lg ml-3"></i>
                              </div>
                              <div class="content text-white">
                                <div class="d-flex flex-wrap align-items-center mb-2 mt-3 mt-xl-1">
                                  <h3 class="font-weight-light mr-2 mb-1">Participated</h3>
                                  <h3 class="mb-0"><?php print_r(sizeof($project_count)); ?> </h3>&nbsp;
                                  <h4 class="font-weight-light mr-2 mb-1"> Projects</h4>
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                </div>
                                <p class="text-white font-weight-light pr-lg-2 pr-xl-5">The total value of your services towards the whole projects company took up.</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 item">
                            <div class="d-flex flex-column flex-xl-row mt-5 mt-md-0">
                              <div class="icon icon-c text-white mr-3">
                                <i class="ti-shopping-cart-full icon-lg ml-3"></i>
                              </div>
                              <div class="content text-white">
                                <div class="d-flex flex-wrap align-items-center mb-2 mt-3 mt-xl-1">
                                  <h3 class="font-weight-light mr-2 mb-1">Closed</h3>
                                  <h3 class="mb-0"><?php echo $profile_info['total_sale'];?></h3>&nbsp;
                                  <h4 class="font-weight-light mr-2 mb-1"> Sales</h4>
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                </div>
                                <p class="text-white font-weight-light pr-lg-2 pr-xl-5">The number of Marketing Tasks that is converted to a successful sale.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="row">
                          <div class="col-md-4 item">
                            <div class="d-flex flex-column flex-xl-row mt-4 mt-md-0">
                              <div class="icon icon-a text-white mr-3">
                                <i class="ti-calendar icon-lg ml-3"></i>
                              </div>
                              <div class="content text-white">
                                <div class="d-flex flex-wrap align-items-center mb-2 mt-3 mt-xl-1">
                                  <h3 class="font-weight-light mr-2 mb-1">Completed</h3>
                                  <h3 class="mb-0"><?php echo $profile_info['completed_tasks'];?></h3>&nbsp;
                                  <h4 class="font-weight-light mr-2 mb-1">Tasks</h4>
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                </div>
                                <p class="text-white font-weight-light pr-lg-2 pr-xl-5">The number of successfully completed tasks out of the total tasks you took up.</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 item">
                            <div class="d-flex flex-column flex-xl-row mt-5 mt-md-0">
                              <div class="icon icon-b text-white mr-3">
                                <i class="ti-vector icon-lg ml-3"></i>
                              </div>
                              <div class="content text-white">
                                <div class="d-flex flex-wrap align-items-center mb-2 mt-3 mt-xl-1">
                                  <h3 class="font-weight-light mr-2 mb-1">Working on</h3>
                                  <h3 class="mb-0"><?php echo $profile_info['total_working_jobs'];?></h3>&nbsp;
                                  <h4 class="font-weight-light mr-2 mb-1">Jobs</h4>
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                </div>
                                <p class="text-white font-weight-light pr-lg-2 pr-xl-5">The number of jobs you are working with currently, out of the total tasks given to you</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 item">
                            <div class="d-flex flex-column flex-xl-row mt-5 mt-md-0">
                              <div class="icon icon-c text-white mr-3">
                                <i class="ti-medall icon-lg ml-3"></i>
                              </div>
                              <div class="content text-white">
                                <div class="d-flex flex-wrap align-items-center mb-2 mt-3 mt-xl-1">
                                  <h3 class="font-weight-light mr-2 mb-1">Finished</h3>
                                  <h3 class="mb-0"><?php echo $profile_info['total_finished_jobs'];?></h3>&nbsp;
                                  <h4 class="font-weight-light mr-2 mb-1">Jobs</h4>
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                </div>
                                <p class="text-white font-weight-light pr-lg-2 pr-xl-5">The number of the projects you finished out of the total projects given to you.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    <a class="carousel-control-prev" href="#performanceOverview" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#performanceOverview" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
            </div>




        </div>
      </div></div>
        <!-- partial:../../partials/_footer.html -->
