<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use App\Models\equipos;
use Illuminate\Http\Request;
use App\Http\Requests\equiposValidate;
use Illuminate\Validation\Rule;

class equiposController extends Controller
{

    //Proteccion de rutas especificas en Resource   
    public function __construct()
    {
        $this->middleware("can:equipos")->only("create","store","edit","update");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listado_equipos=equipos::all();
        return view("workers.equipos.index",['listado_equipos'=>$listado_equipos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("workers.equipos.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(equiposValidate $request)
    {
        $request->validate([
            'serial'=>Rule::unique("equipos")
        ]); 

        if(isset($request->observaciones) && (strlen($request->observaciones)<11)){
            return redirect()->route("equipos.index");
        }

        equipos::create($request->all());
        return redirect()->route("equipos.index");           
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info_equipo=equipos::find($id);

        if($info_equipo==null){
            return redirect()->route("equipos.index");
        }

        return view("workers.equipos.edit",['info_equipo'=>$info_equipo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(equiposValidate $request, $id)
    {
        $info_equipo=equipos::find($id);

        if($info_equipo==null){
            return redirect()->route("equipos.index");
        }

        if(isset($request->observaciones) && (strlen($request->observaciones)<11)){
            return redirect()->route("equipos.index");
        }

        $info_equipo->fill($request->all());
        $info_equipo->save();
        return redirect()->route("equipos.index");
    }

}
