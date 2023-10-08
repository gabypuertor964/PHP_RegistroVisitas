@extends('adminlte::page')

@section('title', 'Equipos')

@section('content_header')
    <h1>Listado Equipos</h1>

    @can('equipos')
        <a class="btn btn-info float-right" href="{{route("equipos.create")}}" role="button">Registrar Nuevo Visitante</a>
    @endcan 
@stop

@section('content')
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Observaciones</th>
                @can('equipos')
                    <th>Acciones</th>    
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($listado_equipos as $equipo)
                <tr>
                    <td>{{$equipo->serial}}</td>
                    <td>{{$equipo->marca}}</td>
                    <td>{{$equipo->tipo}}</td>
                    <td>
                        @if ($equipo->observaciones==null)
                            Ninguna
                        @else
                            {{$equipo->observaciones}}
                        @endif
                    </td>

                    @can('equipos')
                        <td>
                            <a class="btn btn-warning" href="{{route("equipos.edit",$equipo->id)}}" role="button">Editar Registro</a>
                        </td> 
                    @endcan
                    
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