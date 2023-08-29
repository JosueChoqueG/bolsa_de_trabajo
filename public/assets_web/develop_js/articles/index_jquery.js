jQuery(document).ready(function() {
   var $card     = $('.card_article');
   $card.on('click', function(e){
      e.preventDefault();
      let slug = $(this).attr('id');
      window.location= base_url+ '/articles_interest/'+slug+'/show';
   });
});