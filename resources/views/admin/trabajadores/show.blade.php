@extends('adminlte::page')

@section('title', 'Detallado Trabajador')

@section('content_header')
    <h1>Detallado Trabajador</h1>
@stop

@section('content')
    <form>

        <!--Panel 1: Fotografia visiante e inputs (Nombres, Apellidos, Tipo y Numero de documento, Sexo)-->
        <div class="sectionPanel">

            <!--Subestructura 1: Inputs Laterales a Fotografia-->
            <div class="col-md-7">

                <!--Input: Nombre completo trabajador-->
                <div class="col-md-12 input">
                    <label for="name" class="form-label">Nombre Completo:</label>

                    <input type="text" class="form-control" value="{{$info_usuario->name}}" disabled>
                </div>

                <!--Input: Tipo de Documento trabajador-->
                <div class="col-md-12 input">
                    <label class="form-label">Tipo de Documento</label>

                    <input type="text" class="form-control" value="{{$info_trabajador->tip_doc}}" disabled>
                </div>

                <!--Input: Numero de Documento trabajador-->
                <div class="col-md-12 input">
                    <label class="form-label">Numero de documento:</label>

                    <input type="text" class="form-control" value="{{$info_trabajador->num_doc}}" disabled>
                </div>

                <!--Input: fecha de nacimiento trabajador-->
                <div class="col-md-12 input">
                    <label class="form-label">Fecha de Nacimiento:</label>

                    <input type="date" class="form-control" value="{{$info_trabajador->fech_nac}}" disabled>
                </div>

                <!--Input: Sexo/Genero visitante-->
                <div class="col-md-12 input">
                    <label for="sexo" class="form-label">Sexo</label>

                    <input type="text" class="form-control" value="{{$info_trabajador->sexo}}" disabled>
                </div>
            </div>

            <!--Subestructura 2: Toma fotografia Nuevo visitante-->
            <div class="card col-md-5 text-center">
                <div class="card-header text-center tituloFotografia">
                    Fotografia
                </div>
                <div class="card-body">
                    <img src="{{asset($info_trabajador->url)}}" class="img-fluid rounded-top col-md-12">
                </div>
            </div>
        </div>

        <!--Panel 2: Inputs (Numero Telefonico, Correo Electronico)-->
        <div class="sectionPanel sectionPanel2">

            <!--Input: Cargo/Rol visitante-->
            <div class="col-md-6 input">
                <label for="id_rol" class="form-label">Cargo</label>

                <input type="text" class="form-control" value="{{$rol_trabajador}}" disabled>
            </div>

            <!--Input: Numero Telefonico trabajador-->
            <div class="col-md-6 input">
                <label for="num_tel" class="form-label">Numero Telefonico:</label>

                <input type="text" class="form-control" value="{{$info_trabajador->num_tel}}" disabled>
            </div>

        </div>

        <!--Panel 3: Inputs (Contraseña)-->
        <div class="sectionPanel sectionPanel2 justify-content-center">
            
            <!--Input: Correo Electronico trabajador-->
            <div class="col-md-6 input">
                <label for="email" class="form-label">Correo Electronico:</label>
                <input type="text" class="form-control" value="{{$info_usuario->email}}" disabled>
            </div>

        </div>

        <!--Panel 3: Botones(Envio Y cancelacion)-->
        <div class="text-center">
            <a class="btn btn-info" href="{{route("trabajadores.index")}}" role="button">Ver Listado General</a>
        </div>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @vite(['resources/css/personality.css'])
@stop

@section('js')
    
@stop