@extends('adminlte::page')

@section('title', 'Consultar Visita')

@section('content_header')
    <div class="container text-center">
        <h1 style="font-size: 30px;">Consultar Visita</h1>
    </div>
@stop

@section('content')

    <h2 class="title-form">Datos del Visitante:</h2>

    <input type="hidden" name="id_visit" value="{{$info_visitante->id}}">

    <!--Panel 1: Fotografia visiante e inputs (Nombres, Apellidos, Tipo y Numero de documento, Sexo)-->
    <div class="sectionPanel">
        <!--Subestructura 1: Inputs Laterales a Fotografia-->
        <div class="col-md-7">
            <!--Input: Nombres visitante-->
            <div class="col-md-12 input">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control" name="nombres" value="{{$info_visitante->nombres}}" disabled>
            </div>

            <!--Input: Apellidos visitante-->
            <div class="col-md-12 input">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control" name="apellidos" value="{{$info_visitante->apellidos}}" disabled>
            </div>

            <!--Input: Tipo de Documento visitante-->
            <div class="col-md-12 input">
                <label for="tip_doc" class="form-label">Tipo de Documento</label>

                <select class="form-control form-select form-select-lg col-md-12" name="tip_doc" id="tip_doc" disabled>

                    @foreach ($listado_tipo_documentos as $tipo_documento)
                        @if ($info_visitante->tip_doc==$tipo_documento)
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
                <input type="text" class="form-control" name="num_doc" value="{{$info_visitante->num_doc}}" disabled>
            </div>

            <!--Input: Sexo/Genero visitante-->
            <div class="col-md-12 input">
                <label for="sexo" class="form-label">Sexo</label>

                <select class="form-control form-select form-select-lg col-md-12" name="sexo" disabled>
    
                    @foreach ($sexos as $sexo)
                        @if ($sexo==$info_visitante->sexo)
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
                <img src="{{asset($info_visitante->url)}}" class="img-fluid rounded-top col-md-12">   
            </div>
        </div>
    </div>

    <!--Panel 3: Inputs (Numero Telefonico, Correo Electronico)-->
    <div class="sectionPanel">
        <!--Input: Numero Telefonico visitante-->
        <div class="col-md-6 input">
            <label for="num_tel" class="form-label">Numero Telefonico:</label>
            <input type="text" class="form-control" name="num_tel" value="{{$info_visitante->num_tel}}" disabled>
        </div>

        <!--Input: Correo Electronico visitante-->
        <div class="col-md-6 input">
            <label for="correo" class="form-label">Correo Electronico (Opcional):</label>
            <input type="correo" class="form-control" name="correo" value="{{$info_visitante->correo}}">
        </div>
    </div>

    <h2 class="title-form">Datos de la Visita:</h2>

    <!--Panel 3: Inputs (Nombre Trabajador, Serial Equipo)-->
    <div class="sectionPanel">

        <!--Input: Nombre Trabajador-->
        <div class="col-md-6 input">
            <label for="id_trabajador" class="form-label">Trabajador Visitado:</label>

            <select class="form-control form-select form-select-lg col-md-12" name="id_trabajador" disabled>

                @foreach ($listado_trabajadores as $trabajador)

                    @if ($trabajador->id==$info_visita->id_trabajador)
                        <option value="{{$trabajador->id}}" selected>{{$trabajador->name}}</option>
                    @else
                        <option value="{{$trabajador->id}}">{{$trabajador->name}}</option>
                    @endif
                        
                @endforeach
            </select>
        </div>

        <!--Input: Nombre Trabajador-->
        <div class="col-md-6 input">
            <label for="id_equipo" class="form-label">Equipo Ingresado:</label>

            <select class="form-control form-select form-select-lg col-md-12" name="id_equipo" id="lista" disabled>

                @if ($info_visita->id_equipo==null)
                    <option value="" selected>No Ingresa Equipo</option>
                @else
                    <option value="">No Ingresa Equipo</option>
                @endif

                <option value="{{route("equipos.create")}}">Registrar Nuevo Equipo</option>

                @foreach ($listado_equipos as $equipo)
                    @if ($equipo->id==$info_visita->id_equipo)
                        <option value="{{$equipo->id}}" selected>{{$equipo->marca." - ".$equipo->tipo." - ".$equipo->serial}}</option>
                    @else
                        <option value="{{$equipo->id}}">{{$equipo->marca." - ".$equipo->tipo." - ".$equipo->serial}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <!--Panel 4: Inputs (Motivo Visita, Codigo Gafete)-->
    <div class="sectionPanel">

        <!--Input: Motivo Visita-->
        <div class="col-md-6 input">
            <label for="motivo" class="form-label">Motivo Visita:</label>
            <input type="text" class="form-control" name="motivo" disabled value="{{$info_visita->motivo}}">
        </div>

        <!--Input: Codigo Gafete-->
        <div class="col-md-6 input">
            <label for="cod_gafete" class="form-label">Codigo Gafete:</label>
            <input type="text" class="form-control" name="cod_gafete" disabled value="{{$info_visita->cod_gafete}}">
        </div>
    </div>

    <!--Panel 4: Inputs (Observaciones)-->
    <div class="sectionPanel" style="margin-bottom: 5px;">
        <!--Input: Observaciones visita -->
        <div class="col-md-12 input">
            <label for="observaciones" class="form-label">Observaciones:</label>
            <input type="text" class="form-control" name="observaciones" value="{{$info_visita->observaciones}}" disabled>
        </div>
    </div>

    <!--Panel 3: Botones(Codigo Gafete)-->
    <div class="text-center panel_boton">
        <a class="btn btn-primary" href="{{route("visitas.index")}}" role="button">Volver al Menu Principal</a>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @vite(['resources/css/personality.css'])
@stop

@section('js')

    <script>
        document.getElementById("lista").onchange = function() {
            if (this.selectedIndex==1) {
                window.location.href = this.value;
            }        
        };
    </script>

@stop