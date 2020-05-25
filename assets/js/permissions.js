
$(document).ready(function(){

$(".update_permissions").click(function(){
  	var role = $(this).data('id')
  	var pages = [];
  	var url = $('#base_url').val()+'settings/role/update_permissions/'+role
    $('.pages:checked').each(function(i){
        pages.push($(this).data('id'))
    });

    $.ajax({
        type: "POST",
        url: url,
        data: {pages: pages},
        error: function(data) {
           console.log(data)
        },
        success: function(data) {
        	showSuccessToast('Permission Updated')
        }
    });
  	
  });

});