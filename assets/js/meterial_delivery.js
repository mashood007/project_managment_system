function update_qty(url, id)
{
	
	var quantity = $("#edit_cart_modal_"+id).find("#quantity").val()
		    $.ajax({
       url: url+id,
       type: 'POST',
       data: {quantity: quantity},
           error: function(data) {
              console.log(data);
              showWarningToast('Something is wrong')
              close_modal()
           },
           success: function(data) {
            $('.Checklist').html(data)
            showSuccessToast('Quantity Updated')
            close_modal()
           }

        });
}