jQuery(document).ready(function() 
{
    var $section_list = ('#section_list');

    $section_list.on('click','.card', function(e)
    {
        let id = $(this).attr('id');
        let route = base_url + '/publications/event/'+id+'/show'
        

    });
});