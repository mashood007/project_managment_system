var imported = document.createElement('toastDemo');
imported.src = 'toastDemo';
document.head.appendChild(imported);

$(document).ready(function(){


  $("#item_list").change(function(){
     var item = $(this).find(":selected")
     var item_type = item.data('type')
     var price = item.data('price')
     var discound = item.data('discound')
     var tax = item.data('tax')

     $('#item_price').val(price)
     $("#item_type").val(item_type);
     $("#item_discound").val(price*discound/100)
     print_tag(price, price*discound/100, tax)
     units($(this).val(),item_type)
  }); 

$("#item_price, #item_discound").change(function(){
  var item = $("#item_list").find(":selected")
  var price = item.data('price')
  var discound = item.data('discound')
  var tax = item.data('tax') 
  print_tag(price, price*discound/100, tax)
});

$('.user_type_radio').change(function(){
    if($(this).val() == 'temp')
    {
      $('#local_user').hide()
      $('#temp_user').show()
    }
    else
    {
      $('#local_user').show()
      $('#temp_user').hide()

    }
    //temp_user
  }); 


});  

function print_tag(price, discound, tax)
{ 
  tax = (price - discound)/100*tax
  $('#price_tag').html(price)
  $('#discound_tag').html(parseFloat(discound).toFixed(2))
  $('#tax_tag').html(parseFloat(tax).toFixed(2))
  $('#total_tag').html(parseFloat(price-discound+tax).toFixed(2))
}

function units(item, item_type)
{		var url = $('#units_url').val()

        $.ajax({
           url: url,
           type: 'POST',
           data: {item: item, item_type: item_type },

           error: function(data) {

              alert('Something is wrong'+data);

           },

           success: function(data) {
           	$('#units_list').html(data)
            // alert('success'+data);
           }

        });

}


 function add_item(url)
 {


  var item = $("#item_list").val()
  var type = $("#item_list").find(":selected").data('type')
  var unit =  $("#units_list").val()
  var quantity = $("#quantity").val()
  var price = $("#item_price").val()
  var discound = $("#item_discound").val()
  if (quantity != '')
  {
    $.ajax({
       url: url,
       type: 'POST',
         data: {item_id: item, type: type, unit_id: unit, quantity: quantity, price: price, discound: discound },
           error: function(data) {
              alert('Something is wrong'+data);
              console.log(data)
           },
           success: function(data) {
            $('#bill_area').html(data)
            showSuccessToast('Item Added')
           }

        });
  }
  else
  {
    showWarningToast('QTY and Item should not be blank')

  }

 }

 function confirm_delete(url,id)
 {
    $.ajax({
       url: url,
       type: 'POST',
         data: {id: id },
           error: function(data) {
              alert('Something is wrong'+data);
           },
           success: function(data) {
            $('#bill_area').html(data)
            //alert(data);
           }

        });
}

 function bill(url)
 {
    $.ajax({
       url: url,
       type: 'POST',
           error: function(data) {
             alert('Something is wrong'+data);
           },
           success: function(data) {
 
            $('#bill_area').html(data)
           }

        });
}

function invoice(url, user_type_radio, customer)
{
  var sale_type = $('.sale_type:checked').val()
  var about  = $('#about').val()
  var cash_recieved = $('#cash_recieved').val()
  var mode = $('#mode').val()
  var balance_to_pay = $('#balance_to_pay').val()
  var sale_date = $('#sale_date').val()
  var for_cat = $('#for_cat').val()
    $.ajax({
       url: url,
       type: 'POST',
        data: {for_cat: for_cat, sale_date: sale_date, sale_type: sale_type,customer_id: customer, cash_recieved: cash_recieved, customer_type: user_type_radio, mode: mode, balance_to_pay: balance_to_pay, about: about},
           error: function(data) {
             //alert('Something is wrong'+data);
             console.log(data)
           },
           success: function(data) {
            console.log(data)
            location.assign(data); 
           }

        });
} 

function make_invoice(url)
{


  //temp_user_mobile, temp_user_name

  var user_type_radio = $('.user_type_radio:checked').val()
  
  if (user_type_radio == 'old')
  {
    var customer =   $('.old_customers').val()
    if (customer != '')
    {
      invoice(url, user_type_radio, customer)
    }
    else
    {
      showWarningToast('Customer name should not be blank')
    }
  }
  else
  {
    var temp_user_url =  $('#temp_user_url').val();
    var temp_user_name = $('#temp_user_name').val();
    var temp_user_mobile = $('#temp_user_mobile').val()
    if ( temp_user_mobile != '' && temp_user_mobile != '')
    {
    $.ajax({
       url: temp_user_url,
       type: 'POST',
        data: {name: temp_user_name, mobile: temp_user_mobile},
           error: function(data) {
              alert('Something is wrong'+data);
           },
           success: function(data) {
            //location.reload(); 
            invoice(url, user_type_radio, data)
           }

        });
  }
  else
  {
    showWarningToast('Customer name and mobile should not be blank')
  }
}

}

function make_invoice_return(url)
{

  var about  = $('#about').val()
  var cash_refund = $('#cash_refund').val()
  var mode = $('#mode').val()
  var customer_id = $('#customer_id').val()
    $.ajax({
       url: url,
       type: 'POST',
        data: {cash_refund: cash_refund, mode: mode, about: about, customer_id: customer_id},
           error: function(data) {
              //alert('Something is wrong'+data);
           },
           success: function(data) {
            location.assign(data); 
            
           }

        });
}


function update_invoice(url)
{

  var user_type_radio = $('.user_type_radio:checked').val()
  var customer =   $('.old_customers').val()
  var about  = $('#about').val()
  var cash_recieved = $('#cash_recieved').val()
  var mode = $('#mode').val()
  var balance_to_pay = $('#balance_to_pay').val()
  var sale_date = $('#sale_date').val()
  var for_cat = $('#for_cat').val()
    $.ajax({
       url: url,
       type: 'POST',
        data: {for_cat: for_cat, sale_date: sale_date, customer_id: customer, cash_recieved: cash_recieved, customer_type: user_type_radio, mode: mode, balance_to_pay: balance_to_pay, about: about},
           error: function(data) {
             // alert('Something is wrong'+data);
           },
           success: function(data) {
            location.assign(data); 
            //alert(data);
           }

        });
}


function create_estimate(url)
{
  var user_type_radio = $('.user_type_radio:checked').val()
  var customer =   $('.old_customers').val()
  var about  = $('#about').val()
  var cash_recieved = $('#cash_recieved').val()
  var mode = $('#mode').val()
  var balance_to_pay = $('#balance_to_pay').val()
  var sale_type = $('.sale_type:checked').val()
  var sale_date = $('#sale_date').val()
  var for_cat = $('#for_cat').val()

    $.ajax({
       url: url,
       type: 'POST',
        data: {for_cat: for_cat, sale_date: sale_date, sale_type: sale_type, customer_id: customer, cash_recieved: cash_recieved, customer_type: user_type_radio, mode: mode, balance_to_pay: balance_to_pay, about: about},
           error: function(data) {
            console.log(data)
           },
           success: function(data) {
            location.reload(); 
           }

        });
}


function filter(url)
{
      var to_date  = $('#to_date').val()
      var from_date = $('#from_date').val()

        $.ajax({
           url: url,
           type: 'POST',
           data: {from_date: from_date, to_date: to_date},

           error: function(data) {

            $('#sales_invoice').html("Something is wrong!! Try again")

           },

           success: function(data) {
            $('#sales_invoice').html(data)
            //alert(data)
           }


        });

}




function deleteSale(url)
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
            delete_invoice(url)
          }
        }, 2);
      });  
}

function delete_invoice(url)
{
  $.ajax({
       url: url,
       type: 'POST',
           error: function(data) {
              showWarningToast('Something is wrong')
           },
           success: function(data) {           
            $('#sales_invoice_row_'+data.trim()).hide()
            showSuccessToast('The Invoice was canceled')
           }
    }); 
}

function clear_bill(url)
{
   $.ajax({
       url: url,
       type: 'POST',
           success: function(data) {           
            location.reload()
           }
    }); 
}