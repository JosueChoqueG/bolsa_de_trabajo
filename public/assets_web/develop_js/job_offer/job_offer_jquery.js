
jQuery(document).ready(function() {
   var $card_job_offer     = $('div.card_job_offer');
   var $frmloginEstudent   = $('.frmloginEstudent');
  
   $('a#manual').attr('href',base_url+'/resource/manual/candidato.pdf');
   $('a#manual').addClass('manual_candidate');

   $card_job_offer.on('click', function(e){
      e.preventDefault();
      let slug = $(this).attr('id');
   
      $selected_card = $(this);
      let route = base_url+'/jobOffers/'+slug+'/find';
      jobOfferGet(route);

   });
   $frmloginEstudent.on('submit',function(e){
      e.preventDefault();
      let data = $frmloginEstudent.serialize();
      clean_form();
      let route = base_url+'/jobOffers/authenticate';
      jobOfferPost(route, data);
   });

   $('input:checkbox.filter').on('change', function(){
      $(this).parents('form').submit();
   });

   $('input:radio.filter').on('change', function(){
      $(this).parents('form').submit();
   });


});