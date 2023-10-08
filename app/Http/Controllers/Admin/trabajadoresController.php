<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\trabajadoresValidate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\trabajadores;
use Spatie\Permission\Models\Role;
use App\Models\model_has_roles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class trabajadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtener listado Usuarios
        $listado_usuarios=User::all();

        //Obtener listado Trabajadores
        $listado_trabajadores=trabajadores::all();

        //Obtener listado Roles
        $listado_roles=Role::all();

        //Obtener datos tabla relacion (Rol y Usuario)
        $listado_rel_roles=model_has_roles::all();

        return view("admin.trabajadores.index",[
            'listado_usuarios'=>$listado_usuarios,'listado_trabajadores'=>$listado_trabajadores,'listado_roles'=>$listado_roles,'listado_rel_roles'=>$listado_rel_roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Obtener Roles
        $listado_roles=Role::all('name','id');

        //Generar Listado Tipo Documentos
        $listado_tipo_documentos=['Cedula de Ciudadania','Pasaporte','Documento de Extranjeria','Salvoconducto'];
        
        return view('admin.trabajadores.create',[
            'listado_roles'=>$listado_roles,'listado_tipo_documentos'=>$listado_tipo_documentos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(trabajadoresValidate $request)
    {
        $request->validate([
            'name','num_doc','num_tel','email'=>[
                Rule::unique("users")
            ],
            'password'=>'required|max:255|min:8',
            'foto'=>'required|image'
        ]);

        $listado_contraseñas=User::all("password");

        //Generacion Hash de Contraseña
        $contraseña_hash=Hash::make($request->password);

        //Verificacion de contraseña sin repetir
        foreach($listado_contraseñas as $contraseña){
            if($contraseña==$contraseña_hash){
                return redirect()->route("trabajadores.index");
            }
        }

        //Creacion nuevo Usuario
        $nuevo_usuario=User::create($request->all());

        //Creacion Nuevo Trabajador
        $nuevo_trabajador=trabajadores::create($request->all());

        //Guardado de Foto y Generacion de URL
        $url_original= $request->file('foto')->store('public');
        $url_arreglada=Storage::url($url_original);

        //Insercion Ruta de Imagen del trabajador
        $nuevo_trabajador->url=$url_arreglada;
        $nuevo_trabajador->save();

        //Asignacion Contraseña Hasheada
        $nuevo_usuario->password=$contraseña_hash;
        $nuevo_usuario->save();

        //Signacion Rol/Cargo nuevo Usuario
        $nuevo_rol=new model_has_roles;
        $nuevo_rol->role_id=$request->id_rol;
        $nuevo_rol->model_type='App\Models\User';
        $nuevo_rol->model_id=$nuevo_usuario->id;
        $nuevo_rol->save();

        //Insercion id Usuario en Trabajador
        $nuevo_trabajador->id_usuario=$nuevo_usuario->id;
        $nuevo_trabajador->save();

        return redirect()->route("trabajadores.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Obtener Registro Trabajador
        $info_trabajador=trabajadores::find($id);

        //Obtener Registro Usuario (Que concuerde con el campo id_usuario del trabajador)
        $info_usuario=User::find($info_trabajador->id_usuario);
        
        //Obtener Tabla relacional (Rol y Usuario)
        $model_has_roles=model_has_roles::all('role_id','model_id');

        //Obtener Listado Roles
        $roles=Role::all('id','name');

        //Obtener Rol Trabajador (texto)
        foreach($model_has_roles as $model_rol){

            if($model_rol->model_id==$info_trabajador->id){

                foreach($roles as $rol){

                    if($rol->id==$model_rol->role_id){
                        $rol_trabajador=$rol->name;
                    }
                }
            }
        }

        return view("admin.trabajadores.show",[
            'info_trabajador'=>$info_trabajador,'info_usuario'=>$info_usuario,'rol_trabajador'=>$rol_trabajador
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtener Registro Trabajador
        $info_trabajador=trabajadores::find($id);

        //Obtener Registro Usuario (Que concuerde con el campo id_usuario del trabajador)
        $info_usuario=User::find($info_trabajador->id_usuario);

        //Obtener Listado de Roles
        $listado_roles=Role::all('name','id');

        //Generar listado tipo de documentos
        $listado_tipo_documentos=['Cedula de Ciudadania','Pasaporte','Documento de Extranjeria','Salvoconducto'];

        //Generar listado Sexo/genero
        $listado_sexo=['Femenino','Masculino','Otro'];

        //Obtener tabla relacional (Role y Usuario)
        $model_has_roles=model_has_roles::all('role_id','model_id');

        //Obtenner Rol del Trabajador
        foreach($model_has_roles as $model_rol){

            if($model_rol->model_id==$info_trabajador->id){

                foreach($listado_roles as $rol){

                    if($rol->id==$model_rol->role_id){
                        $rol_trabajador=$rol->name;
                    }
                }
            }
        }

        return view("admin.trabajadores.edit",[
            'info_trabajador'=>$info_trabajador,'info_usuario'=>$info_usuario, 'listado_roles'=>$listado_roles,
            'listado_tipo_documentos'=>$listado_tipo_documentos,
            'rol_trabajador'=>$rol_trabajador,
            'listado_sexo'=>$listado_sexo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(trabajadoresValidate $request, $id)
    {
        if(isset($request->password) && (strlen($request->password)<8)){
            return redirect()->route("trabajadores.edit",$id);
        }
        //Obtener Registro Trabajador
        $info_trabajador=trabajadores::find($id);

        //Obtener Registro Usuario
        $info_usuario=User::find($info_trabajador->id_usuario);

        //Obtener Listado Roles
        $roles=Role::all('id','name');


        //Actualizar datos Trabajador
        $info_usuario->name=$request->name;
        $info_usuario->email=$request->email;

        /*
            Caso de Uso: Durante el proceso de actualizacion de la contraseña es posible que el usuario no requiera actualizar la contraseña.

            Por lo cual se realizan dos verificaciones simultaneas:

            1. El campo no puede venir vacio
            2. La contraseña ingresada no puede tener menos de 8 caracteres

            Tip: La funcion strlen retorna el numero de caracteres de una cadena de texto
        */
        if($request->password<>null && (strlen($request->password)>=8)){
            //Generacion Hash de Contraseña
            $contraseña_hash=Hash::make($request->password);

            $info_usuario->password=$contraseña_hash;
        }
        $info_usuario->save();

        //Actualizar Datos Trabajador
        $info_trabajador->tip_doc=$request->tip_doc;
        $info_trabajador->num_doc=$request->num_doc;
        $info_trabajador->num_tel=$request->num_tel;
        $info_trabajador->sexo=$request->sexo;
        $info_trabajador->fech_nac=$request->fech_nac;
        
        if($request->foto<>null){
            $url_original=$request->file('foto')->store("public");
            $url_arreglada=Storage::url($url_original);

            $info_trabajador->url=$url_arreglada;
        }

        $info_trabajador->save();
        
        //Actualizar Rol Usuario
        foreach($roles as $rol){

            //Validar si la informacion ingresada concuerde con un rol existente
            if($rol->id==$request->id_rol){

                /*
                    Antecedente: Se busca actualizar el Rol de un usuario

                    Problemas: El sistema de Roles de Spatie, hace uso de una tabla intermedia (model_has_roles), para conectar los usuarios con sus respectivos roles, sin embargo, los registros de esta tabla intermedia, no cuentan con una PK, por lo cual no existe forma "Sencilla" de seleccionar el registro y cambiar sus valores.

                    Solucion: Eliminar el registro anterior y crear uno nuevo.                        
                */

                FacadesDB::table('model_has_roles')->where('model_id',$id)->delete();
                $info_usuario->assignRole($rol->name);
            }
        }

        return redirect()->route("trabajadores.index");
    }

}

