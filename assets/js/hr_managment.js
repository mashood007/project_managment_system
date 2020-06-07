  function showEmployeesOfRole()
  {
    var role_id = $("#roles_list").val()
    $('.role_card').hide()
    $('.role_'+role_id).show();   
  }  
$(document).ready(function(){
  showEmployeesOfRole()
  $("#roles_list").change(function(){
    showEmployeesOfRole()
  });

  //meeting page
  $("#filter_meetings").change(function(){
    var type  = $(this).val()
    url = $('#base_url').val()+'meeting/filter/'+type
    $.ajax({
      url: url,
      type: 'POST',
      error: function(data) {
         $('#meeting_table_body').html("Something is wrong!! Try again")
      },
      success: function(data) {
        $('#meeting_table_body').html(data)
      }
    });


  });

});
