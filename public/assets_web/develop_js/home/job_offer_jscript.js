function jobOfferGet(route)
{
    $.ajax({
        url      : route,
        type     : 'GET',
        datatype : 'json',
        timeout  : 5000,
       
        success: function(response)
        {
            if(response.action == 'show')
            {
               window.location.href = base_url+'/jobOffers/'+response.slug+'/show';
            }
            else
            {
                $('#modalLoginGeneral').modal('show');
                $('#pills-profile-tab').parents('li').hide();
            }
        },
        error: function(xhr, textStatus, thrownError)
        {
            messagesXhr( xhr, textStatus);

        }
    })
}

function jobOfferPost(route,data)
{
    $.ajax({
        url      : route,
        headers  : {'X-CSRF-TOKEN': csrf_token },
        type     : 'POST',
        data     : data,
        datatype : 'json',
        timeout  : 10000,  
        success: function(response)
        {
            location.reload();
            msgSuccess(response.message);
            clean_form();
        },
        error: function(xhr, textStatus, thrownError)
        {
            messagesXhr( xhr, textStatus);
        }
    })
}

function clean_form()
{
    $('.frmloginEstudent')[0].reset();
}