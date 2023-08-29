jQuery(document).ready(function() 
{
    $('#miTabla').dataTable(
        {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
        }
    );

    $('#btn_volver').click(function(){
        window.history.back();
    });
});