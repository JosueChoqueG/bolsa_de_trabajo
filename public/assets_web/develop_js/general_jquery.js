
jQuery(document).ready(function() {
    var $link_modal     = $('a#link_login');
    var $modalLogin     = $('#modalLoginGeneral');
    

    $link_modal.on('click',function(e)
    {
        e.preventDefault();
        $modalLogin.modal('show');
    });

    $('form.login').on('submit',function(e)
    {
        e.preventDefault();
        let url  = $(this).attr('action');
        let data = $(this).serialize();
        
        loginWeb(url,data);
    });

 });