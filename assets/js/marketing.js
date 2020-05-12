var imported = document.createElement('toastDemo');
imported.src = 'toastDemo';
document.head.appendChild(imported);

$(document).ready(function(){
  setLeadStatus()

  $(".lead-status").change(function(){
  	var rate = $(this).val()
    console.log(rate)
    $('#lead_status').val(rate)
    rateLead(rate)

  });  


  $("#make_user_connections").click(function(){
    apply_tasks_settings_changes($(this).data('user'))

  });

  $(".assign_button").click(function(){
    var lead_id = $(this).data('id');
    assign_button(lead_id)
  });

  $(".close_modal").click(function(){
      $("#assign_modal").hide()
      $("#assign_modal").css({'opacity' : '0', "background" : ""});
  });
  


  $("#save_assign").click(function(){
    var lead_id = $(this).val();
    var follow_id = $("#follow-ddlb").val();
     save_assign(lead_id, follow_id)
  });
  

});


function assign_button(lead_id)
{
    var follow_id = ''
    $("#assign_modal").show()
    $("#assign_modal").css({'opacity' : '1', "background" : "rgba(53, 53, 53, 0.3) none repeat scroll 0% 0%"});
    $(".followers-img-"+lead_id).each(function(){
      follow_id = $(this).attr('data-id')
      $("#follow-ddlb option[value='"+ follow_id + "']").attr("selected", "selected");
    });
    $("#follow-ddlb").select2()
    $("#save_assign").val(lead_id) 
}


function setLeadStatus()
{
	var status = $('#lead_status').val()
	$('.lead-status').val(status)
}

function rateLead(rate)
{
	var id = $('#lead_id').val()
	var url = $('#rate_lead_base_url').val() 
        $.ajax({
           url: url,
           type: 'POST',
           data: {id: id, rate: rate},

           error: function(data) {

             // alert('Something is wrong'+data);

           },

           success: function(data) {
                //alert("Record added successfully"+data);  

           }

        });

}

function apply_tasks_settings_changes(selected_user_id)
{
  var task_to_users_list = $('#task_to').val();
  var requests_to = $('#requests_to').val(); 
  var messaging_to = $('#messaging_to').val();
  apply_settings_changes(task_to_users_list, selected_user_id, requests_to, messaging_to)

}

function apply_settings_changes(task_to_users_list, selected_user_id, requests_to, messaging_to)
{
  var url = $('#user_connection_base_url').val();
        $.ajax({
           url: url,
           type: 'POST',
           data: { task_to_users_list: task_to_users_list, selected_user_id: selected_user_id, requests_to: requests_to, messaging_to: messaging_to},

           error: function() {

              alert('Something is wrong');

           },

           success: function(data) {
                showSuccessToast('Applied '+data+' connection setup')  

           }

        });  

}

function save_assign(lead_id, follow_id)
{
  var url = $('#save_assign_url').val();
        $.ajax({
           url: url,
           type: 'POST',
           data: {id: lead_id, follow: follow_id},

           error: function() {

              alert('Something is wrong');

           },

           success: function(data) {
                showSuccessToast('Assigned')  
                $("#assign_modal").hide()
                $("#assign_modal").css({'opacity' : '0', "background" : ""});
                $('#row_'+lead_id).html(data)
                console.log(data)
           }

        });    

}


