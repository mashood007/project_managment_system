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
