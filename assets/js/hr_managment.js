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
});