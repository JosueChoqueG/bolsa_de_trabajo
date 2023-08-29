jQuery(document).ready(function() {
    //variables
    var $table           = $('table#tableUser');
    var $modalRegister   = $('div#modalRegister');
    var $btnModalOpen    = $('button#btnModalOpen');
    var $btnSave         = $('button#btnSave');
    var $frmRegister     = $('form#frmRegister');  
    var urlUser          = base_url+'/admin/users';

    //instanciamos
 
   loadDataTable( $table,  urlUser, getColumns() );
    //eventos
    //lanza dialog crud
    $btnModalOpen.on('click', function()
    {
        $btnSave.text('Guardar');
        resetForm($frmRegister);
        $frmRegister.attr( 'action', urlUser+'/create' );
        $modalRegister.modal('show'); 
        removeMsgValidation($frmRegister);
    });
  
    //submit y envia datos al bacjend
    $frmRegister.on("submit", function(e)
    {
      e.preventDefault();
  
      var datos = $frmRegister.serialize();
      var route = $frmRegister.attr('action');
  
      submitRegister( $table, route, datos );
      
    });
  
    $table.on( 'click', 'button.edit', function ()
    {
        var id  = $(this).parents('tr').attr('id');
     
        $frmRegister.attr( 'action', urlUser+'/'+id+'/update' );
        $modalRegister.modal('show');
        editUser( $frmRegister,id);
    });
  
    $table.on( 'click', 'button.delete', function ()
    {
        var $row    = $(this).parents('tr');
        var id      = $row.attr('id');
        let route   = urlUser+'/'+id+'/delete';
        let title   = 'Eliminar registro'
        let type    = 'warning'
        let message = '¿Realmente desea eliminar a este usuario?';
        swal(swalConfirm(title,message,type),
        function(){
            swal.close();
            deleteUser($table ,$row , id, route);
        });
    
       
    });
  
});
  