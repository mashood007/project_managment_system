function activeClient(url, id)
{
    $.ajax({
        url: url,
        type: 'POST',
        error: function(data) {
            alert('Something is wrong');
        },
        success: function(data) {
          $('#row_'+id).html(data)
        }
        });
}