jQuery(document).ready(function() 
{
    var $a_facebook = $('a#facebook');
    var $a_twitter  = $('a#twitter');
    var $a_google   = $('a#google');
    var $a_whatsapp  = $('a#whatsapp');
    
    $a_facebook.on('click', function(e){
        e.preventDefault();
        let url_actual   = window.location;
        let title        = $('h3.title_show').text();
        let facebookURL = '//www.facebook.com/sharer/sharer.php?u='+url_actual+'&title='+title;
        window.open(facebookURL, "facebook" , "width=500,height=300,scrollbars=NO");
    })

    $a_twitter.on('click', function(e){
        e.preventDefault();
        let url_actual   = window.location;
        let title        = $('h3.title_show').text();
        let twitterURL     = 'https://twitter.com/intent/tweet?text='+title+'&amp;url='+url_actual+'&amp';
        window.open(twitterURL, "twitter" , "width=500,height=300,scrollbars=NO");
    })

    $a_google.on('click', function(e){
        e.preventDefault();
        let url_actual   = window.location;
        let title        = $('h3.title_show').text();
        let googleURL = 'https://plus.google.com/share?url='+url_actual;
        window.open(googleURL, "google" , "width=500,height=300,scrollbars=NO");
    })

    $a_whatsapp.on('click', function(e){
        e.preventDefault();
        let url_actual   = window.location;
        let whatsappURL = 'https://api.whatsapp.com/send?text='+url_actual;
        window.open(whatsappURL, "google" , "width=500,height=300,scrollbars=NO");
    })
});