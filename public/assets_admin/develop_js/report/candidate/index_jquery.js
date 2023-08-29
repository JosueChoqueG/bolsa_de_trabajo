jQuery(document).ready(function() 
{
    var $frmBuscar      = $('#frmBuscar');
    var url             = base_url+'/admin/registeredUsers';

    $("#generate_report").click(function(e)
    {
        e.preventDefault();
        let route       = base_url+'/admin/registeredUsers';
        let data        = $frmBuscar.serialize();
        submitRegister(route,data);
    });

});