@extends('adminlte::page')

@section('title', 'Detallado Visitante')

@section('content_header')
    <h1>Listado Visitantes Registrados</h1>
@stop

@section('content')
    
    <!--Panel 1: Fotografia visiante e inputs (Nombres, Apellidos, Tipo y Numero de documento, Sexo)-->
    <div class="sectionPanel">
        <!--Subestructura 1: Inputs Laterales a Fotografia-->
        <div class="col-md-7">
            <!--Input: Nombres visitante-->
            <div class="col-md-12 input">
                <label class="form-label">Nombres:</label>
                <input type="text" class="form-control" value="{{$info_visitante->nombres}}" readonly>
            </div>

            <!--Input: Apellidos visitante-->
            <div class="col-md-12 input">
                <label class="form-label">Apellidos:</label>
                <input type="text" class="form-control" value="{{$info_visitante->apellidos}}" readonly>
            </div>

            <!--Input: Tipo de Documento visitante-->
            <div class="col-md-12 input">
                <label class="form-label">Tipo de Documento:</label>
                <input type="text" class="form-control" value="{{$info_visitante->tip_doc}}">
            </div>

            <!--Input: Numero de Documento visitante-->
            <div class="col-md-12 input">
                <label class="form-label">Numero de documento:</label>
                <input type="text" class="form-control" value="{{$info_visitante->num_doc}}" readonly>
            </div>

            <!--Input: Sexo/Genero visitante-->
            <div class="col-md-12 input">
                <label class="form-label">Sexo Visitante:</label>
                <input type="text" class="form-control" value="{{$info_visitante->sexo}}" readonly>
            </div>
        </div>

        <!--Subestructura 2: Toma fotografia Nuevo visitante-->
        <div class="card col-md-5 text-center">
            <div class="card-header text-center tituloFotografia">
                Fotografia
            </div>
            <div class="card-body">
                <img src="{{asset("$info_visitante->url")}}" class="img-fluid rounded-top col-md-12">  
            </div>
        </div>
    </div>

    <!--Panel 2: Inputs (Numero Telefonico, Correo Electronico)-->
    <div class="sectionPanel">
        <!--Input: Numero Telefonico visitante-->
        <div class="col-md-6 input">
            <label class="form-label">Numero Telefonico:</label>
            <input type="text" class="form-control" value="{{$info_visitante->num_tel}}" readonly>
        </div>

        <!--Input: Correo Electronico visitante-->
        <div class="col-md-6 input">
            <label class="form-label">Correo Electronico:</label>
            <input type="text" class="form-control" value="{{$info_visitante->correo}}" readonly>
        </div>
    </div>

    <div class="text-center">
        <a class="btn btn-info" href="{{route("visitantes.index")}}" role="button">Ver Listado General</a>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @vite(['resources/css/personality.css'])
@stop

@section('js')

@stop