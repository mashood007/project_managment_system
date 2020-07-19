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
              console.log(data)
           },
           success: function(data) {           
            $('#row_'+data.trim()).hide()
            $('#row_1_'+data.trim()).attr("style", "display: none !important");
            showSuccessToast('Removed')
           }
    }); 
}


function deleteItem(url)
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
            delete_item(url)
          }
        }, 2);
      });  
}

function delete_item(url)
{
  $.ajax({
       url: url,
       type: 'POST',
           error: function(data) {
              showWarningToast('Something is wrong')
           },
           success: function(data) {           
            $('.item_'+data.trim()).hide()
            showSuccessToast('Removed')
           }
    }); 
}

