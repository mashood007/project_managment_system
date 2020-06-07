$(document).ready(function(){


$("#project_complete").submit(function(e) {

    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var value = form.find('input').val()
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        error: function(data) {
           alert('Something is wrong');
           console.log(data)
        },
        success: function(data) {
          $('#project_complete_button').html(value+"% completed")
        }
    });
});

  $(".submit_project_form").click(function(){
  	$("#project_form").submit()
  	
  });

  $('.page-number').click(function(){
  	$('.page-number').removeClass('active')
  	$(this).addClass('active');
  	var page = $(this).attr('number')
  	$('.discussion-item').attr("style", "display: hide !important");
  	$('.page_no_'+page).attr("style", "display: inline !important");
  });


  $('.page-right-nav').click(function(){
  	var page = parseInt($('.page-number.active').attr('number')) + 1
  	if (parseInt($(this).attr('last')) >= page)
  	{
  		$('.discussion-item').attr("style", "display: hide !important");
  		$('.page_no_'+page).attr("style", "display: inline !important");
  		$('.page-number').removeClass('active')
  		$('#page-number-'+page).addClass('active');
 	}
  	
  });


  $('.page-left-nav').click(function(){
  	var page = parseInt($('.page-number.active').attr('number')) - 1
  	if (page > 0)
  	{
  		$('.discussion-item').attr("style", "display: hide !important");
  		$('.page_no_'+page).attr("style", "display: inline !important");
  		$('.page-number').removeClass('active')
  		$('#page-number-'+page).addClass('active');
 	}
  	
  });

   });

function submitDiscussion()
{
	var discussion = "<input name='discussion' type='hidden' value='"+$('.note-editable').html()+"'>"
	$('#discussion_form').append(discussion).submit()
	//$('#test').html($('.note-editable').html());
}

function submitConversation()
{
  var post = "<input name='post' type='hidden' value='"+$('.note-editable').html()+"'>"
  $('#discussion_form').append(post).submit()
  //$('#test').html($('.note-editable').html());
}

function todo_tasks(url)
{
  $.ajax({
    url: url,
    type: 'POST',
    error: function(data) {
      alert('Something is wrong');
      console.log(data)
    },
    success: function(data) {
      $('#todo_tasks').html(data)
     }
  });
}

function changeTodo(url, _this)
{
  $('.todo-button').removeClass('btn-primary')
  $('.todo-button').addClass('btn-outline-primary')
  _this.removeClass('btn-outline-primary')
  _this.addClass('btn-primary')
  todo_tasks(url)

}

function assign_todo_modal() {
   $(".assign_todo").show()
   $(".assign_todo").css({'opacity' : '1', "background" : "rgba(53, 53, 53, 0.3) none repeat scroll 0% 0%"});
   
}

function assignTodo(todo_id)
{
  var assign = $('#deployment').val()
  var emp_name = $('#deployment').find(':selected').text()
  var base_url = $('#base_url').val()
  $.ajax({
    url: base_url+'project/assign_todo/'+todo_id,
    type: 'POST',
    data: {assign: assign},
    error: function(data) {
      alert('Something is wrong');
      console.log(data)
    },
    success: function(data) {
     // alert(data)
     $('#emp_name').text(emp_name)
      close_modal()
     }
  });




}

// this is the id of the form
function finishStatus(project_id, _this)
{
  _this.toggleClass('btn-outline-success')
  _this.toggleClass('btn-success')
  var flag = _this.data('flag')
  var url = $('#base_url').val()
  var status = _this.data('id')
  if (flag == 0)
  {
    _this.data('flag', 1)
    url = url+'projects/status/finish/'+project_id+"/"+status
  }
  else
  {
    _this.data('flag', 0)
    url = url+'projects/status/undo/'+project_id+"/"+status
  }


  $.ajax({
    url: url,
    type: 'POST',
    error: function(data) {
     // alert('Something is wrong');
      console.log(data)
    },
    success: function(data) {
     showSuccessToast(data.trim())
     }
  });  

}

function myTodo(url)
{
  $.ajax({
    url: url,
      type: 'POST',
        error: function(data) {
          alert('Something is wrong');
          console.log(data)
        },
        success: function(data) {
          $('.todo-list1').html(data)
        }      
    });
}