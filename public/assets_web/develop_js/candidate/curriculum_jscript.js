function curriculumPost(route , row)
{
    $.ajax({
        url      : route,
        headers  : {'X-CSRF-TOKEN': csrf_token },
        type     : 'POST',
        datatype : 'json',
        timeout  : 10000,  
        success: function(response)
        {
            if(response.action == 'no_delete')
            {
                msgError(response.message);
            }
            else
            {
                msgSuccess(response.message);
                row.remove();
            }
        },
        error: function(xhr, textStatus, thrownError)
        {
            messagesXhr( xhr, textStatus);
        }
    })
}