(function($) {
  'use strict';
  $(function() {
    var todoListItem = $('.todo-list');
    var todoListInput = $('.todo-list-input');
    var base_url = $('#base_url').val()
    $('.todo-list-add-btn').on("click", function(event) {
      event.preventDefault();

      var item = $(this).prevAll('.todo-list-input').val();

      if (item) {
        todoListItem.append("<li><div class='form-check'><label class='form-check-label'><input class='checkbox' type='checkbox'/>" + item + "<i class='input-helper'></i></label></div><i class='remove ti-close'></i></li>");
        todoListInput.val("");
      }

    });

    //add new todo tasks
    $('.todo-list-add-task-btn').on("click", function(event) {
      event.preventDefault();
      var url = $(this).data('url')
      
      var item = $(this).prevAll('.todo-list-input').val();

      if (item) {
 
        $.ajax({
           url: url,
           type: 'POST',
           data: {name: item},
           error: function(data) {
              alert('Something is wrong');
           },
           success: function(data) {
              todoListItem.append("<li><div class='form-check'><label class='form-check-label'><input value='"+data.trim()+"' class='task-checkbox' type='checkbox'/>" + item + "<i class='input-helper'></i></label></div><i class='remove ti-close' data-id='"+item+"'></i></li>");
              todoListInput.val("");
           }

        });

      }


    });


    todoListItem.on('change', '.task-checkbox', function() {
      var status ;
      if ($(this).attr('checked')) {
        $(this).removeAttr('checked');
        status = 0;
      } else {
        $(this).attr('checked', 'checked');
        status = 1;
      }
      var id = $(this).val()

        $.ajax({
           url: base_url+'project/check_task/'+id,
           type: 'POST',
           data: {status: status}
        });

      $(this).closest("li").toggleClass('completed');

    });

    todoListItem.on('change', '.checkbox', function() {
      if ($(this).attr('checked')) {
        $(this).removeAttr('checked');
      } else {
        $(this).attr('checked', 'checked');
      }

      $(this).closest("li").toggleClass('completed');

    });


    todoListItem.on('click', '.remove', function() {     
      
      var id = $(this).data('id')
      var url = base_url+'project/remove_task/'+id
      $.ajax({
        url: url,
        type: 'POST'
      });
      $(this).parent().remove();
    });

  });
})(jQuery);