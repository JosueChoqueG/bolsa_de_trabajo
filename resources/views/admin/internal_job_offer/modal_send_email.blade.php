<div class="modal fade" id="modalEmail"  data-controls-modal="modalEmail"  data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title"> <i class="fa fa-envelope-o"></i> Correo masivo</h5> 
                <button type="button" class="close" data-dismiss="modal"  aria-label="close"><span aria-hidden="true">x</span></button> 
            </div> 
            <div class="modal-body text-center" >
                <input type="hidden" id="selected_job_offer_id">
                <h5 id="title_job_offer" ></h5>
                <form action="" id="formSendEmail" method="POST">
                    @csrf
                    <button  class="btn btn-success btn-block mb-2 btnSave" id="btnSendEmails"><i class=""></i> Enviar correos</button>
                </form>
                <span> <b>Envios anteriores</b></span>
                <table class="table table-sm table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Cantidad</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>
                    <tbody id="body_emails">

                    </tbody>
                    <tfoot hidden id="foot_emails">
                        <tr>
                            <td class="date"></td>
                            <td class="quantity"></td>
                            <td class="user"></td>
                        </tr>
                    </tfoot>
                </table>
                
            </div>
            <div id="messages" class="m-t-5"></div> 
        </div>
    </div>
</div><!-- /.modal -->