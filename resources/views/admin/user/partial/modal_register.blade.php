<div class="modal fade" id="modalRegister"  data-controls-modal="modalRegister"  data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
        <div class="modal-header"> 
            <h5 class="modal-title"> <i class="icon-people icons "></i> Registro de usuarios</h5> 
            <button type="button" class="close" data-dismiss="modal"  aria-label="close"><span aria-hidden="true">x</span></button> 
        </div> 
            <div id='cargador'></div>
            <form role="form"  method="POST" action=""  id="frmRegister"> 
                <div class="modal-body"> 
                    <div class="row"> 
                    <input type="hidden" name="id" id="id">
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="field-2" class="">Nombres</label> 
                                <input type="text" class="form-control " id="name"  name="name" placeholder="Ingrese nombre" required>
                                <em id="name-error" class="error invalid-feedback messages"></em>  
                            </div> 
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="field-1" class="">Apellidos</label> 
                                <input type="text" class="form-control " id="last_name"  name="last_name" placeholder=" Ingrese apellidos " required>
                                <em id="last_name-error" class="error invalid-feedback messages"></em>  
                            </div> 
                        </div>
                    </div>
                    <div class="row"> 
                    
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-1" class="">Correo electrónico</label> 
                                <input type="email" class="form-control " id="email"  name="email" placeholder="Ingrese correo electrónico" required>
                                <em id="email-error" class="error invalid-feedback messages"></em>  
                            </div> 
                        </div> 
                        
                    </div> 
                    <div class="row ">
                        <div class="col-md-6">
                        <div class="form-group">
                            
                            <label for="field-1" class="">Rol</label>  
                            <select name="role_id" class="form-control  form-control-sm" id="role_id" required>
                                <option value="" selected>Seleccione</option>
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach  
                            </select>
                            <em id="role_id-error" class="error invalid-feedback messages"></em> 	 
                        </div>
                            
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="field-2" class="">Estado</label> 
                                <select name="status" id="status" class="form-control form-control-sm" required>
                                    <option value="0">Inactivo</option>
                                    <option value="1">Activo</option>
                                </select>
                                <em id="status-error" class="error invalid-feedback messages"></em>  
                        </div> 
                    </div> 
                    
                    </div>  
                </div> 
                <div class="modal-footer"> 
                    <button  class="btn btn-default btn-sm" data-dismiss="modal"  id="cerrarModalRegistro">Cancelar</button> 
                    <button type="submit" class="btn btn-primary btn-sm" id="btnSave"> <i class=""></i> Guardar</button>  
                </div> 
            </form>
                <div id="mensajes" class="m-t-5"></div> 
        </div>
    </div>
</div><!-- /.modal -->