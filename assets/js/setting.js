var imported = document.createElement('toastDemo');
imported.src = 'toastDemo';
document.head.appendChild(imported);

function edit_tax(id) {
   $("#edit_tax_modal_"+id).show()
   $("#edit_tax_modal_"+id).css({'opacity' : '1', "background" : "rgba(53, 53, 53, 0.3) none repeat scroll 0% 0%"});

}


 function close_modal(){$(".modal").hide()}

 function update_tax(url,id)
 {
 	var name = $("#edit_tax_modal_"+id).find("#tax_name").val()
 	var tax = $("#edit_tax_modal_"+id).find("#tax_rate").val()	
 	if (name != "" && tax != "")
 	{
 	        $.ajax({
           url: url,
           type: 'POST',
           data: {id: id, name: name, tax: tax},

           error: function(data) {

              alert('Something is wrong');

           },

           success: function(data) {
               // alert("Record added successfully"+data);
                location.reload();  

           }

        });
 	 }
 	 else{showWarningToast('Tax Rate and Name should not be blank')}    
 }

function edit_cess(id) {
   $("#edit_cess_modal_"+id).show()
   $("#edit_cess_modal_"+id).css({'opacity' : '1', "background" : "rgba(53, 53, 53, 0.3) none repeat scroll 0% 0%"});

}


 function update_cess(url,id)
 {
 	var name = $("#edit_cess_modal_"+id).find("#cess_name").val()
 	var cess = $("#edit_cess_modal_"+id).find("#cess_rate").val()	
 	if (name != "" && cess != "")
 	{
 	        $.ajax({
           url: url,
           type: 'POST',
           data: {id: id, name: name, cess: cess},

           error: function(data) {

              alert('Something is wrong');

           },

           success: function(data) {
               // alert("Record added successfully"+data);
                location.reload();  

           }

        });
 	 }
 	 else{showWarningToast('Cess Rate and Name should not be blank')}    
 }



  function enableGst()
{
  if ($('.enable_gst_check_box').is(':checked'))
  {
    $('#enable_gst').val('yes')
  }
  else
  {
    $('#enable_gst').val('no')
  }
}

 function updateRole(url,id)
 {
  var designation = $("#edit_tax_modal_"+id).find("#designation").val()
  if (designation != "")
  {
          $.ajax({
           url: url+id,
           type: 'POST',
           data: {designation: designation},

           error: function(data) {

              alert('Something is wrong');

           },

           success: function(data) {
              location.reload();  
           }

        });
   }
   else{showWarningToast('Designation should not be blank')}    
 }


 function updateSkill(url,id)
 {
  var skill = $("#edit_tax_modal_"+id).find("#skill").val()
  if (skill != "")
  {
          $.ajax({
           url: url+id,
           type: 'POST',
           data: {skill: skill},

           error: function(data) {

              alert('Something is wrong');

           },

           success: function(data) {
              location.reload();  
           }

        });
   }
   else{showWarningToast('Skill should not be blank')}    
 }

function change_order(_this, id)
{
  var base_url = $('#base_url').val()
  $.ajax({
    url: base_url+"settings/status/change_order/"+id,
    type: 'POST',
    data: {order_number: _this.val()},
    error: function(data) {
      alert('Something is wrong');
      console.log(data)
    },
    success: function(data) {
      showSuccessToast('Order Number Changed')  
    }
        });

}