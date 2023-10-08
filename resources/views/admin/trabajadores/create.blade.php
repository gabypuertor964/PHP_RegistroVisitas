@extends('adminlte::page')

@section('title', 'Registrar Trabajador')

@section('content_header')
    <h1>Registro Nuevo Trabajador</h1>
@stop

@section('content')
    <form action="{{route("trabajadores.store")}}" method="post" enctype="multipart/form-data">
        @csrf

        <!--Panel 1: Fotografia visiante e inputs (Nombres, Apellidos, Tipo y Numero de documento, Sexo)-->
        <div class="sectionPanel">

            <!--Subestructura 1: Inputs Laterales a Fotografia-->
            <div class="col-md-7">

                <!--Input: Nombre completo trabajador-->
                <div class="col-md-12 input">
                    <label for="name" class="form-label">Nombre Completo:</label>
                    <input type="text" class="form-control" name="name">
                </div>

                <!--Input: Tipo de Documento trabajador-->
                <div class="col-md-12 input">
                    <label for="tip_doc" class="form-label">Tipo de Documento</label>

                    <select class="form-control form-select form-select-lg col-md-12" name="tip_doc" id="tip_doc">
                        <option value="" selected>Seleccione</option>

                        @foreach ($listado_tipo_documentos as $tipo_documento)
                            <option value="{{$tipo_documento}}">{{$tipo_documento}}</option>
                        @endforeach

                    </select>
                </div>

                <!--Input: Numero de Documento trabajador-->
                <div class="col-md-12 input">
                    <label for="num_doc" class="form-label">Numero de documento:</label>
                    <input type="text" class="form-control" name="num_doc">
                </div>

                <!--Input: fecha de nacimiento trabajador-->
                <div class="col-md-12 input">
                    <label for="fech_nac" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" name="fech_nac">
                </div>

                <!--Input: Sexo/Genero visitante-->
                <div class="col-md-12 input">
                    <label for="sexo" class="form-label">Sexo</label>

                    <select class="form-control form-select form-select-lg col-md-12" name="sexo">
                        <option value="" selected>Seleccione</option>

                        <option value="Masculino">Masculino</option>
                        <option value="Masculino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
            </div>

            <!--Subestructura 2: Toma fotografia Nuevo visitante-->
            <div class="card col-md-5 text-center">
                <div class="card-header text-center tituloFotografia">
                    Fotografia
                </div>
                <div class="card-body">
                    <input type="file" name="foto" id="" accept="image/*" required>
                </div>
            </div>
        </div>

        <!--Panel 2: Inputs (Numero Telefonico, Correo Electronico)-->
        <div class="sectionPanel sectionPanel2">

            <!--Input: Cargo/Rol visitante-->
            <div class="col-md-6 input">
                <label for="id_rol" class="form-label">Cargo</label>

                <select class="form-control form-select form-select-lg col-md-12" name="id_rol">
                    <option value="" selected>Seleccione</option>

                    @foreach ($listado_roles as $rol)
                        <option value="{{$rol->id}}">{{$rol->name}}</option>
                    @endforeach
                </select>
            </div>

            <!--Input: Numero Telefonico trabajador-->
            <div class="col-md-6 input">
                <label for="num_tel" class="form-label">Numero Telefonico:</label>
                <input type="text" class="form-control" name="num_tel">
            </div>

        </div>

        <!--Panel 3: Inputs (Contraseña)-->
        <div class="sectionPanel sectionPanel2">
            
            <!--Input: Correo Electronico trabajador-->
            <div class="col-md-6 input">
                <label for="email" class="form-label">Correo Electronico:</label>
                <input type="email" class="form-control" name="email">
            </div>

            <!--Input: Contraseña trabajador-->
            <div class="col-md-6 input">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="password">
            </div>

        </div>

        <!--Panel 3: Botones(Envio Y cancelacion)-->
        <div class="text-center">
            <button type="submit" class="btn btn-primary buttonForm">Guardar</button>

            <a class="btn btn-danger buttonForm" href="{{route("trabajadores.index")}}" role="button">Cancelar</a>
        </div>
    </form>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @vite(['resources/css/personality.css'])
@stop

@section('js')

@stop