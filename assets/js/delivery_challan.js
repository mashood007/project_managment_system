var imported = document.createElement('toastDemo');
imported.src = 'toastDemo';
document.head.appendChild(imported);

$(document).ready(function(){
	
	
	$('input[name=for_type]').change(function(){
		var delivery_for = $(this).val()
		delivery_for_list(delivery_for)
		
	});
	$('#delevery_for_list, .old_customers').change(function(){
		var name = $(this).find(':selected').text()
		var details = $(this).find(':selected').data('details')
		$('#for_cat').val($(this).find(':selected').data('type'))
		details = "<b>"+name+"</b>,&nbsp;<font size='2'>"+details+"</font>"
		$('#customer_details').html(details)
		
	});
});

function delivery_for_list(delivery_for)
{
		var url = $('#for_url').val()
		
        $.ajax({
           url: url,
           type: 'POST',
           data: {for: delivery_for},

           error: function(data) {
           	console.log(data)

           },

           success: function(data) {
           	$('#delevery_for_list').html(data)
           	
           }


        });

}

function delivery_challan_form_submit()
{
	var delivery_for = $('#delevery_for_list').val()
	var location = $('#location').val()
	var reason = $('#reason').val()
	var for_type = "<input type='hidden' name='for_type' value='"+$('input[name=for_type]:checked').val()+"'>"
	if (delivery_for != "" && reason != "" && location != "")
	{
		$('#delivery_challan_form').append($('#about'));
		$('#delivery_challan_form').append(for_type);
		$('#delivery_challan_form').submit();	
	}
	else
	{
		showWarningToast('Please fill mantetory fields')
	}
}

function removeDeliveryChallan(url)
{
  swal({
        title: 'Are you sure?',
        text: "You won't be able to revert!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f51b5',
        cancelButtonColor: '#ff4081',
        confirmButtonText: 'Great ',
        buttons: {
          cancel: {
            text: "Cancel",
            value: null,
            visible: true,
            className: "btn btn-danger ",
            closeModal: true,
          },
          confirm: {
            text: "Ok, Confirm",
            value: true,
            visible: true,
            className: "btn btn-primary ",
            closeModal: true
          }
        }
      }).then(function(event) {
        setTimeout(function() {
          if(event)
          {
            destroyDeliveryChallan(url)
          }
        }, 2);
      });  
}

function destroyDeliveryChallan(url)
{
	$.ajax({
       url: url,
       type: 'POST',
           error: function(data) {
              showWarningToast('Something is wrong')
           },
           success: function(data) {
            
            showSuccessToast('Canceled')
            location.reload();
           }
    });	
}

function delivery_for_list_with_selected(delivery_for, selected)
{
    var url = $('#for_url').val()
    
        $.ajax({
           url: url,
           type: 'POST',
           data: {for: delivery_for},

           error: function(data) {
            console.log(data)

           },

           success: function(data) {
            $('#delevery_for_list').html(data)
            $('#delevery_for_list').val(selected)
           }

        });

}