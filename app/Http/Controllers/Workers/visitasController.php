<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use App\Http\Requests\visitasValidate;
use App\Models\areas;
use App\Models\equipos;
use App\Models\model_has_roles;
use App\Models\role_has_areas;
use App\Models\trabajadores;
use App\Models\User;
use App\Models\visitantes;
use App\Models\visitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class visitasController extends Controller
{
    //Proteccion de rutas especificas en Resource   
    public function __construct()
    {
        $this->middleware("can:visitas")->only("create","store","edit","update","search");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //Obtener listado visitas (Consulta Personalizada)
        $listado_visitas=visitas::all();

        //Obtener listado visitantes (Consulta Personalizada)
        $listado_visitantes=visitantes::all("id","nombres","apellidos");

        //Obtener listado equipos (Consulta Personalizada)
        $listado_equipos=equipos::all("id","serial");

        //Obtener listado usuarios (Consulta Personalizada)
        $listado_usuarios=User::all("id","name");

        //Obtener listado trabajadores (Consulta Personalizada)
        $listado_trabajadores=trabajadores::all("id","id_usuario");
        
        //Obtener listado role_has_areas (Consulta Personalizada)
        $listado_role_has_areas=role_has_areas::all("id_rol","id_area");

        //Obtener listado model_has_roles (Consulta Personalizada)
        $listado_model_has_roles=model_has_roles::all("role_id","model_id");

        //Obtener listado areas (Consulta Personalizada)
        $listado_areas=areas::all("id","nombre");

        $registros=[];
        foreach($listado_visitas as $visita){

            if($visita->fech_salida==null){
                //Incializar Variable contenedora registro individual
                $registro_individual=[]; 

                //Obtener Nombre completo Visitante
                foreach($listado_visitantes as $visitante){

                    if($visitante->id==$visita->id_visit){
                        $nombre_visitante=($visitante->nombres." ".$visitante->apellidos);

                        array_push($registro_individual,['nombre_visitante'=>$nombre_visitante]);
                        
                    }
                }

                //Obtener Fecha de ingreso
                array_push($registro_individual,['fecha_ingreso'=>$visita->fech_ingreso]);

                //Obtener Nombre completo Trabajador Visitado
                foreach($listado_trabajadores as $trabajador){

                    if($trabajador->id==$visita->id_trabajador){

                        foreach($listado_usuarios as $usuario){

                            if($usuario->id==$trabajador->id_usuario){
                                $id_usuario=$usuario->id;
                                $nombre_trabajador=$usuario->name;

                                array_push($registro_individual,['nombre_trabajador'=>$nombre_trabajador]);
                            }
                        }
                    }
                }

                //Obtener Area Visitada:

                //Acceder a los registros tabla: model_has_roles (Funcion: Permite indicar que rol ocupa cada cuent de usuario)
                foreach($listado_model_has_roles as $model_has_roles){

                    //Se revisa si en el campo "model_id" del registro, se encuentra el id del usuario/Trabajador que se obtuvo al averiguar su nombre completo
                    if($model_has_roles->model_id==$id_usuario){

                        //Una vez identificado el registro, deberemos acceder a los registros de la tabla: role_has_area (Funcion: Permite indicar que area o espacio esta determinado para ese rol)
                        foreach($listado_role_has_areas as $role_has_area){

                            //Se revisa si el codigo del rol del usuario (role_id), concuerda en algun registro con el campo "id_rol" de la tabla "rol_has area)
                            if($role_has_area->id_rol==$model_has_roles->role_id){

                                //Se accede a la tabla areas
                                foreach($listado_areas as $area){

                                    //Una vez obtenido el registro especifico de la tabla "role_has_area", se compara el valor de su columna "id_area", con el "id" de todos los registros de areas
                                    if($area->id==$role_has_area->id_area){

                                        //Una vez identificado el Registro se guarda el valor de su nombre
                                        $area_visitada=$area->nombre;

                                        array_push($registro_individual,['area_visitada'=>$area_visitada]);
                                    }
                                }
                            }
                        }
                    }
                }

                //Obtener Serial Equipo (Si es posible)
                if($visita->id_equipo==null){
                    $serial_equipo=("No");
                }else{
                    foreach($listado_equipos as $equipo){
                        if($visita->id_equipo==$equipo->id){  
                            $serial_equipo=("Si, Serial: ".$equipo->serial);
                        }
                    }
                }
                array_push($registro_individual,['serial_equipo'=>$serial_equipo]);

                //Obtener Motivo Visita
                array_push($registro_individual,['motivo_visita'=>$visita->motivo]);

                //Obtener Observaciones Visita
                array_push($registro_individual,['observaciones'=>$visita->observaciones]);

                //Obtener Codigo Gafete
                array_push($registro_individual,['cod_gafete'=>$visita->cod_gafete]);

                //Adjuntar Identificador Visita
                array_push($registro_individual,['id_visita'=>$visita->id]);

                array_push($registros,$registro_individual);
            }
        }

        return view("workers.visitas.index",['registros'=>$registros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'num_doc'=>'required|min:7'
        ]);

        //Consulta busqueda Id visitante
        $info_visitante=DB::select('select * from visitantes where num_doc = ?', [$request->num_doc]);

        if($info_visitante==null){
            return redirect()->route("visitantes.create");
        }

        $listado_trabajadores=User::all();
        $listado_equipos=equipos::all();
        $sexos=['Femenino','Masculino','otro'];
        $listado_tipo_documentos=['Tarjeta de Identidad','Cedula de Ciudadania','Pasaporte','Documento de Extranjeria','Salvoconducto'];

        return view("workers.visitas.create",['info_visitante'=>$info_visitante,'listado_tipo_documentos'=>$listado_tipo_documentos,'sexos'=>$sexos,'listado_trabajadores'=>$listado_trabajadores,'listado_equipos'=>$listado_equipos]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info_visitante=visitantes::find($request->id_visit);
        
        if($info_visitante==null){
            return redirect()->route("visitas.index");
        }

        $info_visitante->fill($request->all());

        if($request->foto<>null){
            $url_original=$request->file('foto')->store("public");
            $url_arreglada=Storage::url($url_original);

            $info_visitante->url=$url_arreglada;
        }

        $info_visitante->save();

        visitas::create([
            'id_visit'=>$request->id_visit,
            'fech_ingreso'=>date("Y-m-d H:i:s"),
            'id_trabajador'=>$request->id_trabajador,
            'id_equipo'=>$request->id_equipo,
            'motivo'=>$request->motivo,
            'observaciones'=>$request->observaciones,
            'cod_gafete'=>$request->cod_gafete
        ]);

        return redirect()->route("visitas.index");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info_visita=visitas::find($id);

        $info_visitante=visitantes::find($info_visita->id_visit);

        if($info_visitante==null){
            return redirect()->route("visitantes.create");
        }

        $listado_trabajadores=User::all();
        $listado_equipos=equipos::all();
        $sexos=['Femenino','Masculino','otro'];
        $listado_tipo_documentos=['Tarjeta de Identidad','Cedula de Ciudadania','Pasaporte','Documento de Extranjeria','Salvoconducto'];

        return view("workers.visitas.show",['info_visitante'=>$info_visitante,'listado_tipo_documentos'=>$listado_tipo_documentos,'sexos'=>$sexos,'listado_trabajadores'=>$listado_trabajadores,'listado_equipos'=>$listado_equipos,'info_visita'=>$info_visita]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $info_visita=visitas::find($id);

        $info_visitante=visitantes::find($info_visita->id_visit);

        if($info_visitante==null){
            return redirect()->route("visitantes.create");
        }

        $listado_trabajadores=User::all();
        $listado_equipos=equipos::all();
        $sexos=['Femenino','Masculino','otro'];
        $listado_tipo_documentos=['Tarjeta de Identidad','Cedula de Ciudadania','Pasaporte','Documento de Extranjeria','Salvoconducto'];

        return view("workers.visitas.edit",['info_visitante'=>$info_visitante,'listado_tipo_documentos'=>$listado_tipo_documentos,'sexos'=>$sexos,'listado_trabajadores'=>$listado_trabajadores,'listado_equipos'=>$listado_equipos,'info_visita'=>$info_visita]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $info_visita=visitas::find($id);

        $info_visitante=visitantes::find($request->id_visit);
        
        if($info_visitante==null){
            return redirect()->route("visitas.index");
        }

        $info_visitante->fill($request->all());
        $info_visitante->save();

        $info_visita->fill($request->all());
        $info_visita->save();

        return redirect()->route("visitas.index");
    }

    public function registrar_salida($id){
        $visita=visitas::find($id);
        $visita->fech_salida=date("Y-m-d H:i:s");
        $visita->save();

        return redirect()->route("visitas.index");
    }

}
