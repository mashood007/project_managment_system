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

function sortTable(table) {
    // var asc   = order === 'asc',
         tbody = table.find('tbody');

    // tbody.find('tr').sort(function(a, b) {
    //     if (asc) {
    //        // return $('td:first', a).text().localeCompare($('td:first', b).text());
    //         return $('td:first', a).data('stamp').localeCompare($('td:first', b)..data('stamp'));
    //     } else {
    //         return $('td:first', b).text().localeCompare($('td:first', a).text());
    //     }
    // }).appendTo(tbody);

$('tr.Entries').each(function() {
     var t = $(this).attr('data-stamp') //.split('-');
     $(this).data('_ts', new Date(t).getTime());
}).sort(function (a, b) {
    return $(a).data('_ts') < $(b).data('_ts');
}).appendTo(tbody);


}