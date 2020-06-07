            <div class="col-lg-12">
              <div class="card px-3">
                <div class="card-body">




                  <h4 class="display-4"><?php echo $todo['name'];?></h4><br>


                  <div class="list-wrapper">
                    <ul class="d-flex flex-column-reverse todo-list">
                      <?php foreach ($todo_tasks as $row) {
                        ?>
                        
                      <li class="<?php if ($row['status'] == '1'){echo 'completed';}?>">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="task-checkbox" <?php if ($row['status'] == '1'){echo "checked='checked'";}?> type="checkbox" value="<?php echo $row['id'];?>">
                            <?php echo $row['name'];?>
                          </label>
                        </div>
                        
                      </li>
                    <?php } ?>
 

                    </ul>
                  </div>



                </div>
              </div>
            </div>
           </div>
  