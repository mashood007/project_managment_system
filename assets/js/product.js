$(document).ready(function(){
  $(".categories_filter").change(function(){
  	var category = $(this).val()
  	 $(".subcategories").show()
  	if (category != '')
  		{
  			$(".subcategories").hide()
  			$(".category_"+category).show()
  		}
  });  
  $(".product_category").change(function(){
  	var category = $(this).val()
  	if (category == ''){category = 0}
  	subcategories(category)	
  });  


  $("#tax_rate").change(function(){
     $("#tax_type").val($(this).find(":selected").data('type'))
  }); 

  $("#convertional_rate").keyup(function(){
      convertionalRate()
  });

});  

function convertionalRate()
{
  var secondary_unit_id = $("#secondary_unit_id").find(":selected").text()
  var base_unit_id = $("#base_unit_id").find(":selected").text()
  var convertional_rate = $("#convertional_rate").val()
  $("#convertional_rate_label").html("<font color='red' size='4'>1&nbsp;" +base_unit_id.trim()+"&nbsp;=&nbsp; "+ convertional_rate +"&nbsp;" + secondary_unit_id.trim() + "</font>") 
}


function subcategories(category)
{		var url = $('#subcategories_url').val()

        $.ajax({
           url: url,
           type: 'POST',
           data: {category_id: category},

           error: function(data) {

              alert('Something is wrong'+data);

           },

           success: function(data) {
           	$('.subcategories').html(data)
           }

        });

}

function history_filter(url)
{
  var from_date = $('#from_date').val()
  var to_date = $('#to_date').val()
        $.ajax({
           url: url,
           type: 'POST',
           data: {from_date: from_date, to_date: to_date},

           error: function(data) {

              alert('Something is wrong'+data);
              console.log(data)

           },

           success: function(data) {
            $('#content_section').html(data)
           }

        });  
}