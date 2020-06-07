                    <?php 
                       $todo_tasks =  $this->my_todo_model->all($user_id);
                       foreach ($todo_tasks as $row) {
                        ?>
                      <li class="<?php if ($row['status'] == '1'){echo 'completed';}?>">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="task-checkbox" <?php if ($row['status'] == '1'){echo "checked='checked'";}?> type="checkbox" value="<?php echo $row['id'];?>">
                            <?php echo $row['name'];?>
                          </label>
                        </div>
                        <i class="remove ti-close" data-id="<?php echo $row['id'];?>"></i>
                      </li>
                    <?php } ?>