@extends('adminlte::page')

@section('title', 'Detallado Areas')

@section('content_header')
    <div class="text-center">
        <h1>Detallado Area</h1>    
    </div>
@stop

@section('content')
    <form>

        <!--Seccion 1: Input(Nombre y Descripcion Area)-->
        <div class="sectionPanel">

            <!--Input: Nombre Area-->
            <div class="col-md-6">
            <label class="form-label">Nombre Area</label>
            <input type="text"
                class="form-control" value="{{$info_area->nombre}}" disabled>
            </div>

            <!--Input: Descripcion Area-->
            <div class="col-md-6">
                <label class="form-label">Descripcion Area</label>
                <input type="text"
                class="form-control" value="{{$info_area->descripcion}}" disabled>
            </div>

        </div>

        <!--Seccion 2: Seleccion Roles del Area-->
        <div class="text-center sectionPanel2"> 
            <h2>¿Que trabajadores pertenecen a esta Area?</h2>

            <table class="table table-dark table-bordered table-striped">

                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Numero de Documento</th>
                        <th>Numero Telefonico</th>
                        <th>Sexo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listado_usuarios as $usuario)
                        <tr>
                            <td>{{$usuario->name}}</td>
            
                            @foreach ($contenedor_trabajadores as $trabajador)
                                @if ($trabajador->id_usuario==$usuario->id)
                                    <td>{{$trabajador->num_doc}}</td>
                                    <td>{{$trabajador->num_tel}}</td>
                                    <td>{{$trabajador->sexo}}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{route("trabajadores.show",$usuario->id)}}" role="button">Revisar</a>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

        <!--Seccion 2: Seleccion Roles del Area-->
        <div class="text-center sectionPanel2"> 

            <h2>¿Que cargos pertenen a esta area?</h2>

            @foreach ($listado_roles as $rol)

                <div class="card col-md-3 col-lg-3 col-xl-3 col-sm-12 col-12 card_cargo">
                    <div class="card-header">
                        @php
                            echo e(ucfirst($rol['name']));
                        @endphp
                    </div>
                    <div class="card-body">
                        
                        <table class="table">

                            <tr>
                                <td>
                                    <p class="text_cargo_area">
                                        <strong>Fecha de Creacion:</strong>
                                    </p>
                                    <p class="text_cargo_area">{{$rol['created_at']}}</p>
                                </td>
                            </tr>
                            
                        </table>
                    </div>
                </div>

            @endforeach

        <!--Panel 3: Botones(Envio Y cancelacion)-->
        <div class="text-center">

            <a class="btn btn-info buttonForm" href="{{route("areas.index")}}" role="button">Volver al listado Principal</a>

        </div>

    </form>

@stop

@section('css')
    @vite(['resources/css/personality.css'])
@stop

@section('js')
    
@stop