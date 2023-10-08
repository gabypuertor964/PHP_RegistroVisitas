@extends('adminlte::page')

@section('title', 'Visitas')

@section('content_header')
    <h1 class="text-center">Listado Visitas Activas</h1>

    @can('visitas')    

        <nav class="float-right visit_search">
            <form class="form-inline" action="{{route("visitas.create")}}" method="POST">
                @csrf
                <input class="form-control mr-sm-2" placeholder="Numero de Documento" name="num_doc">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Registrar Visita</button>
            </form>
        </nav>
          
    @endcan
@stop

@section('content')
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="align-middle text-center">Nombre Visitante</th>
                <th class="align-middle text-center">Fecha Ingreso</th>
                <th class="align-middle text-center">Trabajador Visitado</th>
                <th class="align-middle text-center">Area Visitada</th>
                <th class="align-middle text-center">¿Ingreso Equipo?</th>
                <th class="align-middle text-center">Motivo Visita</th>
                <th class="align-middle text-center">Observaciones</th>
                <th class="align-middle text-center">Cod. Gafete</th>
                <th class="align-middle text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registros as $registro)
                <tr>
                    <td class="align-middle text-center">
                        {{$registro[0]["nombre_visitante"]}}
                    </td>

                    <td class="align-middle text-center">
                        {{$registro[1]["fecha_ingreso"]}}
                    </td>

                    <td class="align-middle text-center">
                        {{$registro[2]["nombre_trabajador"]}}
                    </td>

                    <td class="align-middle text-center">
                        {{$registro[3]["area_visitada"]}}
                    </td>

                    <td class="align-middle text-center">
                        {{$registro[4]["serial_equipo"]}}
                    </td>

                    <td class="align-middle text-center">
                        {{$registro[5]["motivo_visita"]}}
                    </td>

                    <td class="align-middle text-center">
                        @if ($registro[6]["observaciones"]==null)
                            Ninguna
                        @endif
                    </td>

                    <td class="align-middle text-center">
                        {{$registro[7]["cod_gafete"]}}
                    </td>

                    <td>
                        @can('visitas')
                            
                            <form action="{{route("visitas.salida",$registro[8]['id_visita'])}}" method="get" class="boton_salida">
                                @csrf
                                <button type="submit" class="btn btn-success">Registrar Salida</button>
                            </form>

                            <a class="btn btn-warning botones_enlace" href="{{route("visitas.edit",$registro[8]['id_visita'])}}" role="button">Editar Registro</a>
                        @endcan

                        <a class="btn btn-info" href="{{route("visitas.show",$registro[8]['id_visita'])}}" role="button">Ver Detallado</a>
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