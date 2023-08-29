jQuery(document).ready(function() {
    $('a#a_list_job_offer').siblings().removeClass('active');
    $('a#a_list_job_offer').addClass('active');
    
    $('input.finalist').on('change',function()
    {
        let candidate_id = $(this).attr('id');
        candidate_id = candidate_id.replace('candidate_','');

        let status = null;
        if($(this).is(':checked')){
            status = 'Finalista'
        }
       
        let job_offer_id = $('#job_offer_id').val();  

        let url = base_url+'/finalistPostulation/'+job_offer_id+'/'+candidate_id+'/'+status;

        updateStatusPostulation(url);
    });

    $('a.link_cv').on('click',function(e){
        e.preventDefault();

        let candidate_id = $(this).attr('value');
        candidate_id = candidate_id.replace('candidate_','');
        let job_offer_id = $('#job_offer_id').val();  

        let url = base_url+'/viewCvPostulation/'+job_offer_id+'/'+candidate_id;

        updateStatusPostulation(url);

        let link_cv = $(this).attr("href");
        window.open(link_cv, '_blank');
        return false;
    });

 });