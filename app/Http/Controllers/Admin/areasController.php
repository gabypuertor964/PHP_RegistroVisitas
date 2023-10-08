<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\areasValidate;
use Illuminate\Http\Request;
use App\Models\areas;
use App\Models\model_has_roles;
use App\Models\role_has_areas;
use App\Models\trabajadores;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Validation\Rule;

class areasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Declarar Arreglo Areas
        $detallado_areas=[];

        //Obtener Listado Areas
        $listado_areas=areas::all('id','nombre','descripcion');

        //Obtener Listado Tabla Intermedia (Rol/Usuario)
        $model_has_roles=model_has_roles::all('role_id','model_id');

        //Obtener Listado Tabla Intermedia (Rol/Area)
        $rol_has_areas=role_has_areas::all('id_rol','id_area');

        foreach($listado_areas as $area){
            $contador_trabajadores=0;

            foreach($rol_has_areas as $rol_area){

                if($rol_area->id_area==$area->id){

                    foreach($model_has_roles as $model_rol){

                        if($model_rol->role_id==$rol_area->id_rol){
                            $contador_trabajadores++;
                        }
                    }
                }
            }
        
            $detallado_areas["$area->nombre"]=$contador_trabajadores;
        }

        return view("admin.areas.index",['listado_areas'=>$listado_areas,'detallado_areas'=>$detallado_areas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $listado_roles=Role::all("id",'name','created_at');
        $model_has_roles=model_has_roles::all('role_id','model_id');
        $detallado_roles=[];

        foreach($listado_roles as $rol){
            foreach($model_has_roles as $model_rol){
                $contador=0;
                if($model_rol->role_id==$rol->id){
                    $contador++;
                }
            }

            array_push($detallado_roles,['name'=>$rol->name,'contador'=>$contador,'id'=>$rol->id,'created_at'=>$rol->created_at]);

        }

        return view("admin.areas.create",['detallado_roles'=>$detallado_roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(areasValidate $request)
    {
        $request->validate([
            'nombre','descripcion'=>Rule::unique("areas")
        ]);

        $nueva_area=areas::create($request->all());
        $listado_roles=Role::all();
        $contador=0;

        foreach($listado_roles as $rol){

            if(isset($request["$rol->id"])){
                role_has_areas::create([
                    'id_rol'=>$rol->id,
                    'id_area'=>$nueva_area->id,
                ]);

                $contador++;
            }    
        }

        if($contador==0){
            return redirect()->route("areas.create");
        }

        return redirect()->route("areas.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $listado_roles=Role::all("id",'name','created_at');
        $info_area=areas::find($id);

        if($info_area==null){
            return redirect()->route("areas.index");
        };

        $contenedor_roles_area=[];
        $contenedor_model_rol=[];
        $contenedor_trabajadores=[];
        $contenedor_model_rol=[];

        $listado_trabajadores=trabajadores::all('id','num_doc','id_usuario','num_tel','sexo');
        $listado_usuarios=User::all('id','name');
        $model_has_roles=model_has_roles::all();
        $roles_has_areas=role_has_areas::all();

        foreach($roles_has_areas as $rol_area){
            if($rol_area->id_area==$info_area->id){
                array_push($contenedor_roles_area,$rol_area->id_rol);
            }
        }

        foreach($model_has_roles as $model_rol){
            foreach ($contenedor_roles_area as $contenedor_rol){
                if($contenedor_rol==$model_rol->role_id){
                    array_push($contenedor_model_rol,$model_rol->model_id);            
                }
            }
        }

        foreach($listado_trabajadores as $trabajador){
            foreach($contenedor_model_rol as $model_rol){
                if($model_rol==$trabajador->id){
                    array_push($contenedor_trabajadores,$trabajador);
                }
            }
        }
        
        return view("admin.areas.show",['info_area'=>$info_area,'contenedor_trabajadores'=>$contenedor_trabajadores,'listado_usuarios'=>$listado_usuarios,'listado_roles'=>$listado_roles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info_area=areas::find($id);

        if($info_area==null){
            return redirect()->route("areas.index");
        }

        $listado_roles=Role::all("id",'name','created_at');
        $model_has_roles=model_has_roles::all('role_id','model_id');
        $rol_has_areas=role_has_areas::all("id_rol",'id_area');

        $detallado_roles=[];

        foreach($listado_roles as $rol){

            $active=0;

            foreach($model_has_roles as $model_rol){
                $contador=0;
                if($model_rol->role_id==$rol->id){
                    $contador++;
                }
            }

            foreach($rol_has_areas as $rol_area){
                if($rol->id==$rol_area->id_rol && $rol_area->id_area==$info_area->id){
                    $active=1;
                }
            }

            array_push($detallado_roles,['name'=>$rol->name,'contador'=>$contador,'id'=>$rol->id,'created_at'=>$rol->created_at,'active'=>$active]);

        }

        return view("admin.areas.edit",['detallado_roles'=>$detallado_roles,'info_area'=>$info_area,'rol_has_area'=>$rol_has_areas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(areasValidate $request, $id)
    {

        $info_area=areas::find($id);

        if($info_area==null){
            return redirect()->route("areas.index");
        }

        FacadesDB::table('role_has_areas')->where('id_area',$info_area->id)->delete();

        $listado_roles=Role::all();
        $contador=0;

        foreach($listado_roles as $rol){

            if(isset($request["$rol->id"])){
                role_has_areas::create([
                    'id_rol'=>$rol->id,
                    'id_area'=>$info_area->id,
                ]);

                $contador++;
            }    
        }

        if($contador==0){
            return redirect()->route("areas.edit",$info_area->id);
        }

        $info_area->fill($request->all());
        $info_area->save();

        return redirect()->route("areas.index");
    }
}
