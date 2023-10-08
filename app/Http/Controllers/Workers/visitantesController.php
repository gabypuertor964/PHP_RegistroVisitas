<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use App\Models\visitantes;
use Illuminate\Http\Request;
use App\Http\Requests\visitantesRequest;
use App\Http\Requests\visitasValidate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class visitantesController extends Controller
{

    //Proteccion de rutas especificas en Resource   
    public function __construct()
    {
        $this->middleware("can:visitantes")->only("create","store","edit","update");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listado_visitantes=visitantes::all();
        return view("workers.visitantes.index",['listado_visitantes'=>$listado_visitantes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listado_tipo_documentos=['Tarjeta de Identidad','Cedula de Ciudadania','Pasaporte','Documento de Extranjeria','Salvoconducto'];

        $listado_sexos=['Femenino','Masculino','Otro'];

        return view("workers.visitantes.create",['listado_tipo_documentos'=>$listado_tipo_documentos,'listado_sexos'=>$listado_sexos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(visitasValidate $request)
    {
        $request->validate([
            'num_doc','nombres','apellidos','num_tel'=>[
                Rule::unique("visitantes")
            ],
            'foto'=>'required|image'
        ]);

        $url_original= $request->file('foto')->store('public');
        $url_arreglada=Storage::url($url_original);

        if(isset($request->correo) && (strlen($request->correo)<10)){
            return redirect()->route("visitantes.index");
        }

        $nuevo_visitante=visitantes::create($request->all());
        $nuevo_visitante->url=$url_arreglada;
        $nuevo_visitante->save();
        return redirect()->route("visitantes.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info_visitante=visitantes::find($id);

        if($info_visitante==null){
            return redirect()->route("visitantes.index");
        }

        return view("workers.visitantes.show",['info_visitante'=>$info_visitante]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info_visitante=visitantes::find($id);

        if($info_visitante==null){
            return redirect()->route("visitantes.index");
        }

        $listado_tipo_documentos=['Tarjeta de Identidad','Cedula de Ciudadania','Pasaporte','Documento de Extranjeria','Salvoconducto'];

        $listado_sexos=['Femenino','Masculino','Otro'];

        return view("workers.visitantes.edit",['info_visitante'=>$info_visitante,'listado_tipo_documentos'=>$listado_tipo_documentos,'listado_sexos'=>$listado_sexos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(visitantesRequest $request, $id)
    {
        $info_visitante=visitantes::find($id);

        if($info_visitante==null){
            return redirect()->route("visitantes.index");
        }

        if(isset($request->correo) && (strlen($request->correo)<10)){
            return redirect()->route("visitantes.index");
        }

        $info_visitante->fill($request->all());
        if($request->foto<>null){
            $url_original=$request->file('foto')->store("public");
            $url_arreglada=Storage::url($url_original);

            $info_visitante->url=$url_arreglada;
        }
        $info_visitante->save();

        return redirect()->route("visitantes.index");
    }

}
