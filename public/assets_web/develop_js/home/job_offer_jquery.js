jQuery(document).ready(function() {
   var $card_job_offer     = $('div.card_job_offer');
   var $frmloginEstudent   = $('.frmloginEstudent');
   var $tab_estudiante     = $('#pills-home-tab');
   var $tab_empleador      = $('#pills-profile-tab');
   var $login              = $('#link_login');

   // $('#modal_aviso').modal('show');
   $('a#manual').attr('href',base_url+'/resource/manual/candidato.pdf');
   $('a#manual').addClass('manual_candidate');

   $card_job_offer.on('click', function(e){
      let slug = $(this).attr('id');
      let route = base_url+'/jobOffers/'+slug+'/find';
      jobOfferGet(route);
   });

   $login.on('click', function(e){
      e.preventDefault();
      $('#pills-profile-tab').parents('li').show();
   });
   
   $frmloginEstudent.on('submit',function(e){
      e.preventDefault();
      let data = $frmloginEstudent.serialize();
      clean_form();
      let route = base_url+'/jobOffers/authenticate';
      jobOfferPost(route, data);
   });
   
   $tab_estudiante.on('click', function(e){
      $('a#manual').attr('href',base_url+'/resource/manual/candidato.pdf');
      $('a#manual').removeClass('manual_employer');
      $('a#manual').addClass('manual_candidate');
      
   });
   
   $tab_empleador.on('click', function(e){
      $('a#manual').attr('href',base_url+'/resource/manual/empleador.pdf');
      $('a#manual').removeClass('manual_candidate');
      $('a#manual').addClass('manual_employer');
   });
});