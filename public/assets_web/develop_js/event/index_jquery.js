jQuery(document).ready(function() {
   var $card     = $('.card_list');
   $card.on('click', function(e){
      e.preventDefault();
      let slug = $(this).attr('id');
      window.location= base_url+ '/events/'+slug+'/show';
   });

});