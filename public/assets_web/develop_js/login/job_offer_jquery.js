jQuery(document).ready(function() {
   var $card_job_offer     = $('div.card_job_offer');
   var $frmloginEstudent   = $('#frmloginEstudent');

   $card_job_offer.on('click', function(e){
      //   $(this).find('a.title').trigger('click');
      let id = $(this).attr('id');
      let route = base_url+'/jobOffers/'+id+'/show';
      jobOfferGet(route);

   });
   
   $frmloginEstudent.on('submit',function(e){
      e.preventDefault();
      let data = $frmloginEstudent.serialize();
      let route = base_url+'/jobOffers/'+id+'/show';
      jobOfferPost(route, data);
   });
   
    

});