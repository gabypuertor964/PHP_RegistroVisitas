@extends('adminlte::page')

@section('title', 'Visitantes')

@section('content_header')
    <h1>Listado Visitantes Registrados</h1>

    @can('visitantes')
        <a class="btn btn-info float-right" href="{{route("visitantes.create")}}" role="button">Registrar Nuevo Visitante</a>    
    @endcan
@stop

@section('content')
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="align-middle">Nombres</th>
                <th class="align-middle">Apellidos</th>
                <th class="align-middle">Tipo Documento</th>
                <th class="align-middle">Numero de Documento</th>
                <th class="align-middle">Sexo</th>
                <th class="align-middle">Numero Telefonico</th>
                <th class="align-middle">Correo</th>
                <th class="align-middle">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listado_visitantes as $visitante)
                <tr>
                    <td class="align-middle">{{$visitante->nombres}}</td>
                    <td class="align-middle">{{$visitante->apellidos}}</td>
                    <td class="align-middle">{{$visitante->tip_doc}}</td>
                    <td class="align-middle">{{$visitante->num_doc}}</td>
                    <td class="align-middle">{{$visitante->sexo}}</td>
                    <td class="align-middle">{{$visitante->num_tel}}</td>
                    @if ($visitante->correo<>null)
                        <td class="align-middle">{{$visitante->correo}}</td>
                    @else
                        <td class="align-middle">No</td>
                    @endif
                    
                    <td class="align-middle">

                        <a class="btn btn-primary botones_enlace" href="{{route("visitantes.show",$visitante->id)}}" role="button">Ver Detallado</a>

                        @can('visitantes')
                            <a class="btn btn-warning botones_enlace" href="{{route("visitantes.edit",$visitante->id)}}" role="button">Editar Datos</a>
                        @endcan
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