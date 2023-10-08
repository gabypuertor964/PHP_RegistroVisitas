@extends('adminlte::page')

@section('title', 'Editar Area')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    <form action="{{route("areas.update",$info_area->id)}}" method="POST">

        @csrf
        @method('PUT')

        <!--Seccion 1: Input(Nombre y Descripcion Area)-->
        <div class="sectionPanel">

            <!--Input: Nombre Area-->
            <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre Area</label>
            <input type="text"
                class="form-control" name="nombre" value="{{$info_area->nombre}}">
            </div>

            <!--Input: Descripcion Area-->
            <div class="col-md-6">
                <label for="descripcion" class="form-label">Descripcion Area</label>
                <input type="text"
                class="form-control" name="descripcion" value="{{$info_area->descripcion}}">
            </div>

        </div>

        <!--Seccion 2: Seleccion Roles del Area-->
        <div class="text-center sectionPanel2"> 

            <h2>¿Que cargos pertenen a esta area?</h2>

            @foreach ($detallado_roles as $rol)

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
                            <tr>
                                <td>
                                    <p class="text_cargo_area">
                                        <strong>Num. Trabajadores:</strong>
                                    </p>
                                    <p class="text_cargo_area">{{$rol['contador']}}</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer text-muted">

                        <div class="form-check form-switch">

                            @if ($rol['active']==1)
                                <input class="form-check-input" type="checkbox" name="{{$rol['id']}}" id="{{$rol['id']}}" checked="checked" value="">
                            @else
                                <input class="form-check-input" type="checkbox" name="{{$rol['id']}}" value="" id="{{$rol['id']}}">
                            @endif

                            <label class="form-check-label" for="{{$rol['id']}}">
                                Seleccionar
                            </label>

                        </div>

                    </div>
                </div>

            @endforeach

        </div>

        <!--Panel 3: Botones(Envio Y cancelacion)-->
        <div class="text-center">
            <button type="submit" class="btn btn-primary buttonForm">Guardar</button>

            <a class="btn btn-danger buttonForm" href="{{route("areas.index")}}" role="button">Cancelar</a>
        </div>

    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @vite(['resources/css/personality.css'])
@stop

@section('js')
    
@stop