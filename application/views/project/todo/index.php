<?php
$logo = $project['logo'];
?>
            <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                         <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                        <img src="<?php echo base_url(!empty($logo)? '/upload/project_logo/'.$logo : 'assets/images/client1.jpg'); ?>" alt="profile" class="img-lg rounded-circle mb-3"/>
                        
                        <div class="mb-3" style="margin-left: 5px;">
                          <h3><?php echo $project['name'];?></h3>
                          <p class="text-muted mb-0">Client:&nbsp;<a href="#"><?php echo $project['customer_name'];?></a></p>
                          </div>
                        </div>
                     
                      
                     
                    
                    </div>
                    <div class="col-lg-8">
                      <div class="d-flex justify-content-between">
                        <div>
                         
                          
                          
                        </div>
                      </div>
                      <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav profile-navbar">
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('project/project_info/'.$project['id']);?>">
                              <i class="ti-home"></i>
                              Project Home
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url('project/todo/'.$project['id']);?>">
                              <i class="ti-pin2"></i>
                              Todo
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('project/discussions/'.$project['id']);?>">
                              <i class="ti-comment-alt"></i>
                              Discussion
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('projects/meterial_delivery/info/'.$project['id']);?>">
                              <i class="ti-package"></i>
                              Meterial
                            </a>
                          </li>
                          
                        </ul>
                      </div>


                      <div class="profile-feed">
                        <div>
                           <div class="py-4">

             

                      </div>
                        </div>
                       
                      </div>
                    </div>
                 </div>

          <?php 
          $index = 1;
          
          foreach ($todo_list as $row) {
            if ($index == 1 && $todo_id == "")
            {
              $todo_id = $row['todo_id'];
            }
            ?>
      
          <button onclick="window.location.href='<?php echo base_url('project/todo/'.$project['id'].'/'.$row['todo_id']);?>'" type="button" class="todo-button btn btn<?php if($todo_id != $row['todo_id']) {echo '-outline';} ?>-primary btn-rounded btn-fw"><?php echo $row['todo_name'];?>&nbsp;&nbsp;
            <div class="badge badge-pill badge-<?php if ($row['total_checked_tasks'] == $row['total_tasks']) {echo 'primary';}else{echo 'danger';}?>">
            <?php echo $row['total_checked_tasks'].'/'.$row['total_tasks'];?></div></button>
          <?php
          $index +=1;
           } ?>

          <button onclick="window.location.href = '<?php echo base_url("project/new_todo/".$project['id']); ?>';" type="button" class="btn btn-primary btn-rounded btn-fw"><i class="ti-plus"></i></button>

          <br><br>

          <div class="row" id="todo_tasks">



          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
<script type="text/javascript">
  todo_tasks("<?php echo base_url('project/todo_tasks/'.$todo_id); ?>")
</script>