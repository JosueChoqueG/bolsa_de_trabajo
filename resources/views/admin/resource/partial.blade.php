
<div class="row">
    @foreach ($resources as $resource)
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 id" id="{{$resource->id}}">
            <div class="card mb-4 shadow-sm">
                @if($resource->type == 'image')
                <img src="{{asset('img/resource/image/'.$resource->path)}}" alt="..." class="img-fluid" style="height: 140px" >
                @elseif($resource->type == 'pdf')
                <img src="{{asset('img/resource/pdf/pdf-file.png')}}" alt="..." class="img-fluid" >
                @else
                <img src="{{asset('img/resource/doc/doc-file-format-symbol.png')}}" alt="..." class="img-fluid" >
                @endif
                <div class="card-body" style="padding: 5px;">
                    <div class="mb-2 text-center">
                        <small class="text-success name" id="{{$resource->path}}">{{$resource->name}}</small>
                    </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group div_delete" >
                        <button type="button" class="delete btn btn-sm btn-outline-secondary"><i class="icon-trash text-danger"></i> <span>Eliminar</span></button>
                    {{-- <button type="button" class="btn btn-sm btn-outline-secondary edit"><i class="icon-pencil text-info"></i> <span>Editar</span></button> --}}
                    </div>
                    @php
                        $dt     = new DateTime($resource->created_at);
                        $date   = $dt->format('d/m/Y');  
                    @endphp
                    <small class="text-muted">{{$date}}</small>
                </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="row ">
    <div class="col-md-3"></div>
    <div class="col-md-6 ">
        <div class="row">
            <div class="col-md-5">
                <p class="text-muted mt-3"> Monstrando: {{$resources->total()}} registros</p>
            </div>
            <div class="col-md-7">
                {{$resources->appends(Request::only(['slc_search','type','parameter']))->render()}}  
            </div>
        
        </div>
    </div>
    <div class="col-md-3"></div>
</div>