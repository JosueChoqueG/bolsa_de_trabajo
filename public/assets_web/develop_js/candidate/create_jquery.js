jQuery(document).ready(function() 
{
    var $frmRegister        = $('#frmRegister');
    var $btnSearch          = $('#btnSearch');
    
    $frmRegister.on("submit", function(e)
    {
        e.preventDefault();
      
        removeMsgValidation($frmRegister);
        $('#alert_college').hide();
        $('#message_college').html();
    
        let data   = $frmRegister.serialize();
        var route = $frmRegister.attr('action');
        console.log(data,route);
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

