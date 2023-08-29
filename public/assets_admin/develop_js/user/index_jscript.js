/*===============================
	=           funciones            =
	===============================*/
    function loadFrmRegister ( $selector, data )
    {
      
      $selector.find("#btnSave").text('Guardar cambios');
      $selector.find("#name").val(data.name);
      $selector.find("#last_name").val(data.last_name);
      $selector.find('#email').val(data.email);
      $selector.find('#role_id').val(data.role_id);
      $selector.find('#status').val(data.status);
       
      removeMsgValidation( $('form#frmRegister'));
      
    }
    
    function submitRegister( $table, route, datos)
    {
      $.ajax({
        url      : route,
        headers  : {'X-CSRF-TOKEN': csrf_token },
        type     : 'POST',
        datatype : 'json',
        data     : datos,
        timeout  : 5000,
        success: function(response)
        {
          addRowTable( $table, response );
          msgSuccess(response.message);
          resetForm( $('form#frmRegister'));
          if (response.action == 'update')
          $('div#modalRegister').modal('toggle');
        },
        error: function(xhr, textStatus, thrownError)
        {
          messagesXhr( xhr, textStatus);
          
        }
      });
    }
    
    function editUser( $frmRegister ,id)
    {
      $.ajax({
        url     : base_url + '/admin/users/'+ id+'/show',
        headers : {'X-CSRF-TOKEN': csrf_token },
        type    : 'GET',
        timeout : 5000,
        success : function (response)
        {
          loadFrmRegister( $frmRegister, response.data);
        },
        error: function(xhr, textStatus, thrownError)
        {
          messagesXhr( xhr, textStatus );
        }
     });
    }
    
    function deleteUser($table ,$row , id, route)
    {
      $.ajax({
        url     :   route,
        headers : {'X-CSRF-TOKEN': csrf_token },
        type    : 'POST',
        timeout : 5000,
        success : function (response)
        {
            if(response.action == 'delete')
            {
                msgSuccess(response.message,'Proceso correcto'); 
                $table.DataTable().row( $row ).remove().draw( false );
            }
            
            else
                msgError(response.message,'Proceso erroneo'); 
          
        },
        error: function( xhr, textStatus, thrownError)
        {
          messagesXhr( xhr, textStatus );
        }
      });
    }
    
    function  addRowTable( $selector, response )
     {
        var data = response.data;
    
        if (response.action == 'insert')
        {
          $selector.DataTable().row.add( data ).draw( false );
        }
        else
        {
          var $row = $selector.find('tr#' + data.id );
          $selector.DataTable().row( $row ).data( data ).draw( false );
        }
     }
    
    //construye actions con jquery para los tr
    
    function getColumns()
    {
      let columns = [
           
            { data: 'name',     className: 'text-left'},
            { data: 'last_name',  className: 'text-left'},
            { data: 'email',  className: 'text-left'},
            { data: 'status',
                "searchable": true,
                "orderable":true,
                "render": function (data, type, row) 
                {   
                    if (row.status == true) 
                        return '<span class="badge badge-success">Activo</span>';
                    else 
                        return '<span class="badge badge-secondary">Inactivo</span>';
                }
            },
            { data: 'created_at',  className: 'text-left'},
            { defaultContent: '<button class="btn btn-xs btn-light edit mr-2"><i class="fa fa-edit"></i> Editar</button><button class="btn btn-xs btn-danger delete"><i class="fa fa-trash"></i> Eliminar</button>' },
        ]
    
      return columns;
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
            if(response.action == 'delete')
            {
                msgSuccess(response.message,'Proceso correcto');
                $('table#tableUser').DataTable().row( $row ).remove().draw( false );
            }
                 
            else
                msgError(response.message,'Proceso erroneo'); 

            
        },
        error: function(xhr, textStatus, thrownError)
        {    
            messagesXhr(xhr,textStatus);
        },

    });
}
    