//funciones


function submitRegister(route,datos)
{
    $.ajax({
        url      : route,
        headers  : {'X-CSRF-TOKEN': csrf_token },
        type     : 'POST',
        datatype : 'json',
        data     : datos,
        success  : function(response)
        {
            msgSuccess(response.message,'Proceso correcto'); 
            setTimeout(function(){ location.reload(); }, 1200);  
            
        },
        error: function(xhr, textStatus, thrownError)
        {    
            messagesXhr(xhr,textStatus);
        }

    });
}


function submitDelete(route)
{
    $.ajax({
        url      : route,
        headers  : {'X-CSRF-TOKEN': csrf_token },
        type     : 'POST',
        datatype : 'json',
        cache       : false,
        contentType : false,
        processData : false,
        timeout  : 10000,  
        success  : function(response)
        {
            msgSuccess(response.message,'Proceso correcto'); 
            setTimeout(function(){ location.reload(); }, 1000);  
        },
        error: function(xhr, textStatus, thrownError)
        {    
            messagesXhr(xhr,textStatus);
        }

    });
}

function getResource(route, datos)
{
    $.ajax({
    url     	: route,
    headers 	: {'X-CSRF-TOKEN': csrf_token },
    type    	: 'GET',
    datatype    : 'json',
    data        : datos,
    success : function (response)
    {

        $('#'+response.type+'-tab').tab('show');
		$('#li_'+response.type).html(response.resources);
        $('#modal_path_logo').modal('show');
        $('div.id').attr('style','cursor:pointer;');
        
    },
    error: function(xhr, textStatus, thrownError)
    {
        messagesXhr( xhr, textStatus );
    }
    });
}

function getSearch(route)
{
    $.ajax({
    url     	: route,
    headers 	: {'X-CSRF-TOKEN': csrf_token },
    type    	: 'GET',
    datatype    : 'json',
    success : function (response)
    {

        $('#li_'+response.type).html(response.resources);
        $('div.div_delete').hide();
        $('div.id').attr('style','cursor:pointer;');
        
    },
    error: function(xhr, textStatus, thrownError)
    {
        messagesXhr( xhr, textStatus );
    }
    });
}








