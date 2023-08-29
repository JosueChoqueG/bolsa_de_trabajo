jQuery(document).ready(function() 
{
    var $frmRegister      = $('#frmRegister');
    var employer_id       = $('#id').val(); 

    findEmployer(employer_id);

    $frmRegister.on("submit", function(e)
    {
        e.preventDefault();
        loadingButton(true);
        
        removeMsgValidation($frmRegister);
        let data   = new FormData($frmRegister[0]);
        var route  = $frmRegister.attr('action');
        submitRegister(route,data);
    });

    $("#logo").change(function(){
        mostrarImagen(this);
    });

});

