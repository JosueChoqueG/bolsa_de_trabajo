function updateStatusPostulation(url)
{
    $.ajax({
        url      : url,
        headers  : {'X-CSRF-TOKEN': csrf_token },
        type     : 'POST',
        datatype : 'json',
        timeout  : 10000,  
        success: function(response)
        {
           
        },
        error: function(xhr, textStatus, thrownError)
        {
            messagesXhr( xhr, textStatus);
        }
    })
}