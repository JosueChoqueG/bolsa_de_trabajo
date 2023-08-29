<!-- Modal -->
<div class="modal fade" id="modalLoginGeneral" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title w-100 ">INICIO DE SESIÓN</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <ul class="nav nav-pills nav-justified " id="pills-tab" role="tablist" >
            <li class="nav-item ">
                <a class="nav-link active btn-flat" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Estudiantes/Egresados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-flat" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Empresas y/o Entidades</a>
            </li>
           
        </ul>
        <div class="modal-body">
            <div class="tab-content pt-0" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <form action="{{  url('authenticateCandidate')}}" class="login" id="form-candidate" method="POST">
                        @csrf
                        <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                </div>
                            <input name="email" id="email" class="form-control" placeholder="email" type="email"  required>
                        </div> <!-- input-group.// -->
                        </div> <!-- form-group// -->
                        <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                            <input class="form-control" placeholder="contraseña" type="password" name="password" required>
                        </div> <!-- input-group.// -->
                        </div> <!-- form-group// -->
                        <div class="form-group">
                        <button type="submit" class="btn btn-secondary btn-block btn-login">Ingresar <i class="lni lni-enter"></i>  </button>
                        </div> <!-- form-group// -->
                        <div class="mt-4">
                            <div class="d-flex justify-content-center links">
                                ¿No tienes una cuenta?
                                <a href="{{ route('registerCandidate') }}" class="ml-2" target="_blank"> Regístrate aquí </a>
                            </div>
                            <div class="d-flex justify-content-center links">
                                
                                <a href="{{ url('recoverPassword/candidate') }}" target="_blank" class="ml-2">¿Olvidaste tu contraseña?</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <form action="{{ url('authenticateEmployer')}}" class="login" id="form-employer" method="POST">
                        @csrf
                        <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                </div>
                            <input name="email" class="form-control" placeholder="email" type="email" required>
                        </div> <!-- input-group.// -->
                        </div> <!-- form-group// -->
                        <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                            <input class="form-control" placeholder="contraseña" type="password" name="password" required>
                        </div> <!-- input-group.// -->
                        </div> <!-- form-group// -->
                        <div class="form-group">
                        <button type="submit" class="btn btn-secondary btn-block btn-login"> Ingresar <i class="lni lni-enter"></i> </button>
                        </div> <!-- form-group// -->
                        <div class="mt-4">
                            <div class="d-flex justify-content-center links">
                                ¿No tienes una cuenta?
                                <a href="{{ route('registerEmployer') }}" class="ml-2" target="_blank"> Regístrate aquí</a>
                            </div>
                            <div class="d-flex justify-content-center links">
                                <a href="{{ url('recoverPassword/employer') }}" target="_blank" class="ml-2">¿Olvidaste tu contraseña?</a>
                            </div>
                        </div>
                     
                    </form>
                </div>
                <div  class="text-center message_login" style="color: tomato;">
                  
                </div>
            </div>    
        </div>
        <div class="modal-footer" id="footer-login">
            <div class="list-group mt-3 text-center">
                <a href="#" class="list-group-item list-group-item-action" id="manual" target="_blank"><i class="ti-import"></i> Descargar manual de usuario</a>
            </div>
        </div>
    </div>
  </div>
</div>