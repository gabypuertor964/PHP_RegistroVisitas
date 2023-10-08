@extends('adminlte::page')

@section('title', 'Editar Visitante')

@section('content_header')
    <h1>Actualizar Informacion Visitante</h1>
@stop

@section('content')
    <form action="{{route("visitantes.update",$info_visitante->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <!--Panel 1: Fotografia visiante e inputs (Nombres, Apellidos, Tipo y Numero de documento, Sexo)-->
        <div class="sectionPanel">
            <!--Subestructura 1: Inputs Laterales a Fotografia-->
            <div class="col-md-7">
                <!--Input: Nombres visitante-->
                <div class="col-md-12 input">
                    <label for="nombres" class="form-label">Nombres:</label>
                    <input type="text" class="form-control" name="nombres" value="{{$info_visitante->nombres}}">
                </div>

                <!--Input: Apellidos visitante-->
                <div class="col-md-12 input">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" value="{{$info_visitante->apellidos}}">
                </div>

                <!--Input: Tipo de Documento visitante-->
                <div class="col-md-12 input">
                    <label for="tip_doc" class="form-label">Tipo de Documento</label>

                    <select class="form-control form-select form-select-lg col-md-12" name="tip_doc" id="tip_doc">
                        <option value="" selected>Seleccione</option>

                        @foreach ($listado_tipo_documentos as $tipo_documento)

                            @if ($tipo_documento==$info_visitante->tip_doc)
                                <option value="{{$tipo_documento}}" selected>{{$tipo_documento}}</option>
                            @else
                                <option value="{{$tipo_documento}}">{{$tipo_documento}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!--Input: Numero de Documento visitante-->
                <div class="col-md-12 input">
                    <label for="num_doc" class="form-label">Numero de documento:</label>
                    <input type="text" class="form-control" name="num_doc" value="{{$info_visitante->num_doc}}">
                </div>

                <!--Input: Sexo/Genero visitante-->
                <div class="col-md-12 input">
                    <label for="sexo" class="form-label">Sexo</label>

                    <select class="form-control form-select form-select-lg col-md-12" name="sexo">
                        <option value="" selected>Seleccione</option>

                        @foreach ($listado_sexos as $sexo)
                            @if($sexo==$info_visitante->sexo)
                                <option value="{{$sexo}}" selected>{{$sexo}}</option>
                            @else
                                <option value="{{$sexo}}">{{$sexo}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <!--Subestructura 2: Toma fotografia Nuevo visitante-->
            <div class="card col-md-5 text-center">
                <div class="card-header text-center tituloFotografia">
                    Fotografia
                </div>
                <div class="card-body">
                    <img src="{{asset("$info_visitante->url")}}" class="img-fluid rounded-top col-md-12">  
                    <input type="file" name="foto" id="" accept="image/*">
                </div>
            </div>
        </div>

        <!--Panel 2: Inputs (Numero Telefonico, Correo Electronico)-->
        <div class="sectionPanel">
            <!--Input: Numero Telefonico visitante-->
            <div class="col-md-6 input">
                <label for="num_tel" class="form-label">Numero Telefonico:</label>
                <input type="text" class="form-control" name="num_tel" value="{{$info_visitante->num_tel}}">
            </div>

            <!--Input: Correo Electronico visitante-->
            <div class="col-md-6 input">
                <label for="correo" class="form-label">Correo Electronico (Opcional):</label>
                <input type="email" class="form-control" name="correo" value="{{$info_visitante->correo}}">
            </div>
        </div>

        <!--Panel 3: Botones(Envio Y cancelacion)-->
        <div class="text-center">
            <button type="submit" class="btn btn-primary buttonForm">Guardar</button>

            <a class="btn btn-danger buttonForm" href="{{route("visitantes.index")}}" role="button">Cancelar</a>
        </div>

    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @vite(['resources/css/personality.css'])
@stop

@section('js')
    
@stop