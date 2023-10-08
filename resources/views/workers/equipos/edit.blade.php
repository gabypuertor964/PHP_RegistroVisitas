@extends('adminlte::page')

@section('title', 'Editar Equipo')

@section('content_header')
    <h1>Editar Equipo</h1>
@stop

@section('content')
    <form action="{{route("equipos.update",$info_equipo->id)}}" method="post">

        @csrf
        @method("PUT")
        
        <!--Panel 1: Input´s (Serial y Marca Dispositivo)-->
        <div class="sectionPanel">

            <!--Input: Serial Equipo-->
            <div class="col-md-6">
              <label for="serial" class="form-label">Serial</label>
              <input type="text"
                class="form-control" name="serial" value="{{$info_equipo->serial}}">
            </div>

            <!--Input: Marca Equipo-->
            <div class="col-md-6">
              <label for="marca" class="form-label">Marca</label>
              <input type="text"
                class="form-control" name="marca" value="{{$info_equipo->marca}}">
            </div>
        </div>

        <!--Panel 1: Input´s (Tipo y Observaciones Dispositivo)-->
        <div class="sectionPanel">

            <!--Input: Serial Equipo-->
            <div class="col-md-6">
              <label for="tipo" class="form-label">Tipo</label>
              <input type="text"
                class="form-control" name="tipo" value="{{$info_equipo->tipo}}">
            </div>

            <!--Input: Observaciones Equipo-->
            <div class="col-md-6">
              <label for="observaciones" class="form-label">Observaciones</label>
              <input type="text"
                class="form-control" name="observaciones" value="{{$info_equipo->observaciones}}">
            </div>
        </div>        

        <!--Panel 3: Botones(Envio Y cancelacion)-->
        <div class="text-center">
            <button type="submit" class="btn btn-primary buttonForm">Guardar</button>

            <a class="btn btn-warning buttonForm" href="{{route("equipos.index")}}" role="button">Cancelar</a>
        </div>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @vite(['resources/css/personality.css'])
@stop

@section('js')
    
@stop