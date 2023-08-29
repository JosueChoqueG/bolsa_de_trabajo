 <!--::header part start::-->
 @extends('web.layout.template')
    @section('css')
    <link rel="stylesheet" href="{{asset('assets_web/develop_css/job_offer.css')}}">
    @parent
    @endsection
 @section('content')

 <section class="about_part section_padding" id="curriculum">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="left_content">
                @include('web.layout.submenu_employer')
            </div>
            <div class="col-md-10" id="rigth_content">
                <div class="row">
                    <div class="col-md-11" id="sub_right">
                        <div class="row">
                            <nav aria-label="breadcrumb" style="width: 100%;">
                                <ol class="breadcrumb" style="background-color: #ffffff;">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('employers')}}">Mis Ofertas</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Editar({{$job_offer->title}})</li>
                                </ol>
                            </nav>
                            <div class="card" style="width: 100%;">
                                <form id="create_job_offer" action="{{route('employers.edit',$job_offer->id)}}" method="POST">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="ti-clipboard "></i><span class="ml-3">  Nuevo Aviso</span></h5>
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Puesto/Titulo de la oferta laboral*</label>
                                                <input type="text" class="form-control" id="title" placeholder="Nombre del puesto o Título de la oferta laboral" name="title" value="{{old('title',@$job_offer->title)}}" required>
                                                <em id="title-error" class="error invalid-feedback messages"></em> 
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Complemento del titulo</label>
                                                <input type="text" class="form-control" id="title_complement"  name="title_complement" value="{{old('title_complement',@$job_offer->title_complement)}}">
                                                <em id="title_complement-error" class="error invalid-feedback messages"></em> 
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-10">
                                                <label>Introdución*  <small>(Máximo 400 caracteres)</small></label>
                                                <textarea type="text" class="form-control" rows="4" cols="5" id="introduction"  name="introduction" required placeholder="Ingrese una introducción">{{old('description',@$job_offer->introduction)}}</textarea>
                                                <em id="introduction-error" class="error invalid-feedback messages"></em> 
                                            </div>
                                            <div class="form-group col-md-2 text-center" style="">
                                                <div class="card border-secondary mb-3" style="max-width: 10rem;">
                                                    <div class="card-body" style="padding: 10px !important;">
                                                        <p class="card-text">
                                                            <small class="mr-2">¿Cómo llenar la introducción de mi oferta laboral?</small>
                                                        </p>
                                                        <i class="ti-help-alt" id="i_open_modal_introduction" title="Haz Clic"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-10">
                                                <label>Descripción*</label>
                                                <textarea type="text" class="form-control" id="description"  name="description" required>
                                                    {{old('description',@$job_offer->description)}}
                                                </textarea>
                                                <em id="description-error" class="error invalid-feedback messages"></em> 
                                            </div>
                                            <div class="form-group col-md-2 text-center" style=" margin-top: 9%;">
                                                
                                                <div class="card border-secondary mb-3" style="max-width: 10rem;">
                                                    <div class="card-body" style="padding: 10px !important;">
                                                        <p class="card-text">
                                                            <small class="mr-2">¿Cómo llenar la descripción de mi oferta laboral?</small>
                                                            
                                                        </p>
                                                        <i class="ti-help-alt" id="i_open_modal" title="Haz Clic"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Categoría de la oferta*</label>
                                                    <select type="text" class="form-control" id="category"  name="category" required>
                                                        <option value="">--Seleccione--</option>
                                                        <option value="Empleo" {{(@$job_offer->category== 'Empleo')?'selected':''}}>Empleo</option>
                                                        <option value="Prácticas" {{(@$job_offer->category== 'Prácticas')?'selected':''}}>Prácticas</option>
                                                        <option value="Becas/Pasantías" {{(@$job_offer->category== 'Becas/Pasantías')?'selected':''}}>Becas/Pasantías</option>
                                                    </select>
                                                    <em id="category-error" class="error invalid-feedback messages"></em> 

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Area*</label>
                                                    <select class="form-control" id="area_id" name="area_id" required>
                                                        <option value="">--Seleccione--</option>
                                                        @foreach ($areas as $area)
                                                            <option value="{{old('area_id',$area->id)}}"  {{(@$job_offer->area_id == $area->id)?'selected':''}}>{{$area->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <em id="area_id-error" class="error invalid-feedback messages"></em> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Carreras a las que debe pertenecer el postulate*</label>
                                                @foreach ($colleges as $college)
                                                
                                                <div class="form-check" >
                                                    <input class="form-check-input" type="checkbox" value="{{old('college_id',$college->id)}}" class="college_id" id="college_{{$college->id}}" name="college_id[]" 
                                                    @if(isset($job_offer->college_careers)) 
                                                        @foreach ($job_offer->college_careers as $college_career)
                                                        {{(@$college_career->id == $college->id)?'checked':''}}
                                                        @endforeach
                                                    @endif>
                                                    
                                                    <label for="college_{{$college->id}}" class="form-check-label" for="defaultCheck1">
                                                            {{$college->name}}
                                                    </label>
                                                </div>
                                                @endforeach
                                                <em id="college_id-error" style="color: tomato;"></em> 
                                            </div>
                                            <div class="form-group col-md-6">
                                            
                                                
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Pais*</label>
                                                    <select class="form-control" id="countrie_id" name="countrie_id">
                                                        @foreach ($countries as $countrie)
                                                            <option value="{{old('countrie_id',@$countrie->id)}}"  @if(isset($job_offer->countrie_id)){{(@$job_offer->countrie_id == $countrie->id)?'selected':''}} @else {{('173' == $countrie->id)?'selected':''}} @endif>{{$countrie->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <em id="countrie_id-error" class="error invalid-feedback messages"></em> 
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Departamento</label>
                                                    <select class="form-control" id="department_code"  name="department_code">
                                                        <option value=""</option>
                                                        @foreach ($departments as $department)
                                                            <option value="{{old('department_code',@$department->id)}}"  {{(@$department_code == $department->department_code)?'selected':''}}>{{$department->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <em id="departament_code-error" class="error invalid-feedback messages"></em> 
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="">Provincia</label>
                                                <select class="form-control" id="province_code" name="province_code">
                                                    <option value=""></option>
                                                    @foreach ($provinces as $province)
                                                        <option value="{{old('province_code',@$province->id)}}"  {{(@$province_code == $province->province_code)?'selected':''}}>{{$province->name}}</option>
                                                    @endforeach
                                                </select>
                                                <em id="province_code-error" class="error invalid-feedback messages"></em> 
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="">Distrito</label>
                                                <select class="form-control" id="district_code" name="district_code">
                                                     <option value=""</option>
                                                    @foreach ($districts as $district)
                                                        <option value="{{old('district_code',@$district->id)}}"  {{(@$district_code == $district->district_code)?'selected':''}}>{{$district->name}}</option>
                                                    @endforeach
                                                </select>
                                                <em id="district_code-error" class="error invalid-feedback messages"></em>                                     
                                            </div>
                                            
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Jornada laboral*</label>
                                                <select  class="form-control" id="workday"  name="workday" required>
                                                    <option value="">--Seleccione--</option>
                                                    <option value="Tiempo completo" {{(@$job_offer->workday== 'Tiempo completo')?'selected':''}}>Tiempo completo</option>
                                                    <option value="Medio tiempo" {{(@$job_offer->workday== 'Medio tiempo')?'selected':''}}>Medio tiempo</option>
                                                    <option value="Por horas" {{(@$job_offer->workday== 'Por horas')?'selected':''}}>Por horas</option>
                                                </select>
                                                <em id="workday-error" class="error invalid-feedback messages"></em> 

                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Salario*</label>
                                                <select  class="form-control" id="type_salary"  name="type_salary" required>
                                                    <option value="">--Seleccione--</option>
                                                    <option value="A tratar" {{(@$job_offer->type_salary == 'A tratar')?'selected':''}}>A tratar</option>
                                                    <option value="Fijo" {{(@$job_offer->type_salary == 'Fijo')?'selected':''}}>Fijo</option>
                                                    <option value="Rango" {{(@$job_offer->type_salary == 'Rango')?'selected':''}}>Rango</option>
                                                </select>
                                                <em id="type_salary-error" class="error invalid-feedback messages"></em> 
                                                <div class="col-md-12 mt-2">
                                                    <div class="row">
                                                        <div class="form-group col-md-6" id="div_salary_min" style="display:none;">
                                                            <label>Monto Mín.*</label>
                                                            <input type="number" class="form-control " id="salary_min"  name="salary_min"  value="{{old('salary_min',@$job_offer->salary_min)}}">
                                                            <em id="salary_min-error" class="error invalid-feedback messages"></em> 
                                                        </div>
                                                        <div class="form-group col-md-6" id="div_salary_max" style="display:none;">
                                                            <label>Monto Máx.*</label>
                                                            <input type="number" class="form-control " id="salary_max"  name="salary_max" value="{{old('salary_max',@$job_offer->salary_max)}}">
                                                            <em id="salary_max-error" class="error invalid-feedback messages"></em> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Vacantes*</label>
                                                <input type="number" class="form-control" id="vacancies" placeholder="Nro Vacantes" name="vacancies" value="{{old('vacancies',@$job_offer->vacancies)}}" required>
                                                <em id="vacancies-error" class="error invalid-feedback messages"></em> 
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Vigencia del empleo*</label>
                                                <select  class="form-control" id="type_validity"  name="type_validity" required>
                                                    <option value="">--Seleccione--</option>
                                                    <option value="Por definir" {{(@$job_offer->type_validity == 'Por definir')?'selected':''}}>Por definir</option>
                                                    <option value="Definido" {{(@$job_offer->type_validity == 'Definido')?'selected':''}}>Definido</option>
                                                    <option value="Indefinido" {{(@$job_offer->type_validity == 'Indefinido')?'selected':''}}>Indefinido</option>
                                                </select>
                                                <em id="type_validity-error" class="error invalid-feedback messages"></em> 

                                                <input type="number" class="form-control mt-2" id="validity_time" placeholder="Tiempo en Meses" name="validity_time" value="{{old('validity_time',@$job_offer->validity_time)}}" style="display:none;">
                                                <em id="validity_time-error" class="error invalid-feedback messages"></em> 
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Fecha de cierre*</label>
                                                <input type="hidden" name="today" value="{{old('salary',@$today)}}">
                                                <input type="date" class="form-control" id="finish_date"  name="finish_date" value="{{old('finish_date',@$job_offer->finish_date)}}" required>
                                                <em id="finish_date-error" class="error invalid-feedback messages"></em> 
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Postulacion interna?</label>
                                                <select  class="form-control" id="is_postulable"  name="is_postulable" required>
                                                    <option value="0" {{(@$job_offer->is_postulable == '0')?'selected':''}}>No</option>
                                                    <option value="1"  {{(@$job_offer->is_postulable == '1')?'selected':''}}>Si</option>
                                                </select>
                                                <em id="is_postulable-error" class="error invalid-feedback messages"></em> 
                                                <small id="mensaje_publication_date" style="color:#20c997;">NO= la postulacion se realiza por medios externos</small>
                                            </div>
                                        </div>  
                                        
                                    </div>
                                    <div class="card-foot">
                                        <div class="row mt-10">
                                            <div class="col-md-7">

                                            </div>
                                            <div class="col-md-2">
                                                <a type="button"  class="btn btn-inverse"  id="cancel"><i class="fa fa-reply" id="cancel"></i><span class="ml-2">Cancelar</span></a>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-default"><i class="fa fa-save" id="save"></i><span class="ml-2">Guardar Cambios</span></button>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </section>
 <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_example">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Ejemplo para el llenado de la descripción</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    Empresa con 10 años de experiencia relacionada al rubro de telecomunicaciones, socio líder en ventas corporativas, con presencia en 4 ciudades del país, se encuentra en búsqueda de los mejores EJECUTIVOS DE VENTAS CORPORATIVAS TOP.
                </div>
            </div>
            <div class="row">
                <div class="col md-12">
                     <p><strong>REQUISITOS</strong>:</p>
                     <div class="col-md-3">

                     </div>
                     <div class="col-md-9">
                        <ul>
                            <li>3 años de experiencia en el rubro retail, administrando tiendas o agencias, liderando equipos de trabajo de VENTAS y trabajando bajo objetivos y metas.</li>
                            <li>Disponibilidad a tiempo completo para realizar labores de tienda y campo.</li>
                            <li>Experiencia mínima de 1 año en Ventas Corporativas.</li>
                            <li>Actitud Positiva y Alta Capacidad de Negociación.</li>
                            <li>Microsoft Office a nivel intermedio.<br></li>
                        </ul>
                     </div>
                </div>
            </div> 
            <div class="row">
                <div class="col md-12">    
                    <p><strong>FUNCIONES</strong></p>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <ul>
                            <li>Identificar, gestionar, mantener y desarrollar la cartera de nuestros clientes del sector PYME.</li>
                            <li>Ventas de servicios de telecomunicación móvil Movistar dirigido al segmento corporativo (Clientes RUC 20).</li>
                            <li>Planificar y organizar visitas diarias con clientes potenciales.</li>
                            <li>Reporte de gestión CRM en Excel, (Funnel y Cartera).</li>
                            <li>Cumplir con los objetivos de ventas diarios, semanales y mensuales.<br></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col md-12"> 
                    <p><strong>BENEFICIOS/TE OFRECEMOS</strong></p>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <ul>
                            <li>Remuneración competitiva + Comisiones Ilimitadas.</li>
                            <li>Ingreso Directo a Planilla desde el primer día.</li>
                            <li>Todos los beneficios de acuerdo a ley (CTS, gratificaciones, vacaciones, ESSALUD).</li>
                            <li>Proceso de inducción in situ (para generar comisiones desde el primer día).</li>
                            <li>Capacitaciones constantes.<br></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
 
 @endsection
 @section('scripts')
    <script src="{{ asset('assets_web/plugins/ckeditor/ckeditor.js?v1') }}"></script>
    <script src="{{asset('assets_web/develop_js/employer/edit_jquery.js?v1')}}"></script>
    <script src="{{asset('assets_web/develop_js/employer/edit_jscript.js?v1')}}"></script>
@parent
@endsection