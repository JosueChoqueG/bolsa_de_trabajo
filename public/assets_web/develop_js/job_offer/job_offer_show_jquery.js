jQuery(document).ready(function() {
   var $btn_postular    = $('button#postular');
   var $frmPostulation  = $('#frmPostulation');


   $btn_postular.on('click', function(e){

      let id    = $('#job_offer_id').val();
      let route = base_url+'/candidate/postulation/'+id+'/search';
      postulationGet(route);

   });
   $frmPostulation.on('submit', function(e){
      e.preventDefault();
      let id    = $('#job_offer_id').val();
      let data  = $frmPostulation.serialize();
      let route = base_url+'/candidate/postulation/'+id+'/create';
      postulationPost(route, data);
   });
});