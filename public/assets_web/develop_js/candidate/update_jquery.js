jQuery(document).ready(function() 
{
    var $frmRegister = $('#frmRegister');
    var $btnSearch   = $('#btnSearch');
    var document     = $('#document').val();
     //menu active
     $('a#a_perfil').siblings().removeClass('active');
     $('a#a_perfil').addClass('active');
     
 
    findCandidate(document);

    $frmRegister.on("submit", function(e)
    {
        e.preventDefault();
        removeMsgValidation($frmRegister);
        $('#alert_college').hide();
        $('#message_college').html();

        let data   = new FormData($frmRegister[0]);
        var route = $frmRegister.attr('action');
       
            submitRegister(route,data);
    });
  

    $btnSearch.on('click',function(e)
    {
        e.preventDefault();
        let document = $('#document').val();
        
        findCandidate(document);
    });

    
    $("#photo").change(function(){
        mostrarImagen(this);
    });
});

