@extends('adminlte::page')

@section('title', 'Trabajadores')

@section('content_header')
    <h1>Listado Trabajadores</h1>
    <a class="btn btn-primary float-right" href="{{route("trabajadores.create")}}" role="button">Crear nuevo Trabajador</a>
@stop

@section('content')
    
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="align-middle text-center">Nombre</th>
                <th class="align-middle text-center">Tipo Documento</th>
                <th class="align-middle text-center">Numero Documento</th>
                <th class="align-middle text-center">Numero Telefonico</th>
                <th class="align-middle text-center">Fecha de Nacimiento</th>
                <th class="align-middle text-center">Correo</th>
                <th class="align-middle text-center">Rol</th>
                <th class="align-middle text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listado_usuarios as $usuario)
                @if ((auth()->user()->id)<>$usuario->id)
                    <tr>
                        <td class="align-middle text-center">{{$usuario->name}}</td>

                        @foreach ($listado_trabajadores as $trabajador)
                            @if ($trabajador->id_usuario==$usuario->id)
                                <td class="align-middle text-center">{{$trabajador->tip_doc}}</td>

                                <td class="align-middle text-center">{{$trabajador->num_doc}}</td>

                                <td class="align-middle text-center">{{$trabajador->num_tel}}</td>
                                
                                <td class="align-middle text-center">{{$trabajador->fech_nac}}</td>
                            @endif
                        @endforeach

                        <td class="align-middle text-center">{{$usuario->email}}</td>

                        @foreach ($listado_rel_roles as $rel_rol)
                            @if ($rel_rol->model_id==$usuario->id)
                                @foreach ($listado_roles as $rol)
                                    @if ($rol->id==$rel_rol->role_id)
                                        <td class="align-middle text-center">{{$rol->name}}</td>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        <td class="align-middle text-center">

                            <a class="btn btn-primary botones_enlace" href="{{route("trabajadores.show",$usuario->id)}}" role="button">Ver Detallado</a>

                            <a class="btn btn-warning botones_enlace" href="{{route("trabajadores.edit",$usuario->id)}}" role="button">Editar Registro</a>

                        </td>
                    </tr>
                @endif
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