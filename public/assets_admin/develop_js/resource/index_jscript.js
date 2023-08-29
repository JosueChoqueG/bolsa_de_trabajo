/*===============================
	=           funciones            =
	===============================*/

    
    function postResource(route, datos)
    {
      $.ajax({
        url         : route,
        headers     : {'X-CSRF-TOKEN'  : csrf_token },
        type        : 'POST',
        datatype    : 'json',
        data        : datos,
        cache       : false,
        contentType : false,
        processData : false,
        timeout     : 10000,
        success     : function(response)
        {       
			
			if(response.action == 'create')
			{
				$('img#foto').attr('src',base_url+'/img/employer/logo/default.JPG');
				resetForm($('#frmResource'));
				msgSuccess(response.message,'Proceso correcto'); 
				$('#'+response.type+'-tab').tab('show');
				getSearch(base_url + '/admin/resources/search_'+response.type);
			}
			if(response.action == 'delete')
			{
				msgSuccess(response.message,'Proceso correcto'); 
				$('#'+response.type+'-tab').tab('show');
				getSearch(base_url + '/admin/resources/search_'+response.type);

			}
			if(response.action == 'not_create')
			{
				msgError(response.message,'Error'); 
			}
			  
      
			
        },
        error: function(xhr, textStatus, thrownError)
        {
          messagesXhr( xhr, textStatus);
          
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
        cache       : false,
        contentType : false,
        processData : false,
        timeout     : 5000,
        success : function (response)
        {
			$('#'+response.type+'-tab').tab('show');
			$('#li_'+response.type).html(response.resources);
          
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
          
        },
        error: function(xhr, textStatus, thrownError)
        {
          messagesXhr( xhr, textStatus );
        }
     });
    }
    
    function mostrarImagen(input) {
      if (input.files && input.files[0]) {
       var reader = new FileReader();
       reader.onload = function (e) {
        $('#foto').attr('src', e.target.result);
       }
       reader.readAsDataURL(input.files[0]);
      }
  }