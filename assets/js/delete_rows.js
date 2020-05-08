function deleteRow(url)
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
            delete_row(url)
          }
        }, 2);
      });  
}

function delete_row(url)
{
  $.ajax({
       url: url,
       type: 'POST',
           error: function(data) {
              showWarningToast('Something is wrong')
           },
           success: function(data) {           
            $('#row_'+data.trim()).hide()
            showSuccessToast('Removed')
           }
    }); 
}