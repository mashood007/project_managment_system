function update_meterial_qty(url, id)
{
	
	var quantity = $("#edit_cart_modal_"+id).find("#quantity").val()
	var unit_id = $("#edit_cart_modal_"+id).find("#unit_id").val()
	$.ajax({
       url: url+id,
       type: 'POST',
       data: {quantity: quantity, unit_id: unit_id},
           error: function(data) {
              console.log(data);
              showWarningToast('Something is wrong')
              close_modal()
           },
           success: function(data) {
            $('.used_items').html(data)
            showSuccessToast('Quantity Updated')
            close_modal()
           }

        });
}


function add_mu_item(url)
{

  var quantity = $("#item_quantity").val()
  var unit_id = $("#units_list").val()
  var item_id = $('#purchase_items').val()
  if (quantity != "" && unit_id != "" && item_id != "")
    {
      $.ajax({
         url: url,
         type: 'POST',
         data: {quantity: quantity, unit_id: unit_id, item_id: item_id},
             error: function(data) {
                console.log(data);
                showWarningToast('Something is wrong')
             },
             success: function(data) {
              $('.used_items').html(data)
              showSuccessToast('Item added')
              
             }

          });  
  }
  else
  {
    showWarningToast('You should fill the values')
  }
}