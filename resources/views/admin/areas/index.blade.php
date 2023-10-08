@extends('adminlte::page')

@section('title', 'Areas')

@section('content_header')
    <h1>Listado Areas</h1>
    <a class="btn btn-primary float-right" href="{{route("areas.create")}}" role="button">Crear nueva Area</a>
@stop

@section('content')

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="align-middle">Nombre Area</th>
                <th class="align-middle">Descripcion</th>
                <th class="align-middle">Numero Trabajadores</th>
                <th class="align-middle">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listado_areas as $area)
                <tr>
                    <td>{{$area->nombre}}</td>
                    <td>{{$area->descripcion}}</td>
                    <td>{{$detallado_areas["$area->nombre"]}}</td>
                    <td>
                        <a class="btn btn-info" href="{{route("areas.show",$area->id)}}" role="button">Ver Detallado</a>

                        <a class="btn btn-warning" href="{{route("areas.edit",$area->id)}}" role="button">Editar Registro</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @vite(['resources/css/personality.css'])
@stop

@section('js')
    
@stop