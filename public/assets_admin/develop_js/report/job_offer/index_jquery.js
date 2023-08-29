jQuery(document).ready(function() 
{
    var $frmBuscar      = $('#frmBuscar');

    $("#generate_report").click(function(e)
    {
        e.preventDefault();
        let route       = base_url+'/admin/registeredJobOffers';
        let data        = $frmBuscar.serialize();
        submitRegister(route,data);
    });

});