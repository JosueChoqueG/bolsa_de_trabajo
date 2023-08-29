function submitRegister(route,datos)
{
    $.ajax({
        url         : route,
        headers     : {'X-CSRF-TOKEN'  : csrf_token },
        type        : 'GET',
        datatype    : 'json',
        data        : datos, 
        success     : function(response)
        {
            $('#content_table').html(response);	
        },
        error: function(xhr, textStatus, thrownError)
        {    
            messagesXhr(xhr,textStatus);
        },
    });
}