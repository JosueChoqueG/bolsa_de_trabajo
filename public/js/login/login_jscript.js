function postItem( action,route,data)
{
    $.ajax({
    url      : route,
    headers  : {'X-CSRF-TOKEN': csrf_token },
    type     : action,
    datatype : 'json',
    data     : data,
    timeout  : 5000,
    success  : function(response)
    {
        
    },
    error: function(xhr, textStatus, thrownError)
    {
        messagesXhr( xhr, textStatus);
        
    }
    });
}