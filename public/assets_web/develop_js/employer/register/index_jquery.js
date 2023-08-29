jQuery(document).ready(function() 
{
    var $frmRegister      = $('#frmRegister');
    var $frmSearch        = $('#frmSearch');
    var $slcSearch        = $('select#slc_search');
    
    $slcSearch.on('change',function()
    {
        let input = $(this).val();
        $('#parameter').attr('name',input);
    });

    $frmRegister.on("submit", function(e)
    {
        e.preventDefault();
        loadingButton(true);
        
        removeMsgValidation($frmRegister);
        let data   = new FormData($frmRegister[0]);
        var route  = $frmRegister.attr('action');
        submitRegister(route,data);
    });

    $('#frmQueryRuc').on('submit',function(e){
        e.preventDefault();
        let data = $(this).serialize();
        queryRuc(data);
    });

    $frmSearch.on('submit',function(e)
    {
        e.preventDefault();

        let route = $(this).attr('action');
        let data = $(this).serialize();
        
        listEmployers(route, data);
    });

    $("#logo").change(function(){
        mostrarImagen(this);
    });

});

