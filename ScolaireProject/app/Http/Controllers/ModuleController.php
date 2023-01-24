<?php

namespace App\Http\Controllers;

use App\Models\module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = module::all();
        return response()->json($modules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //modules(id,nom_modules,volume_horaire,#formation_id)
        $modules = new module();
        $modules->nom_modules = $request->nom_modules;
        $modules->volume_horaire = $request->volume_horaire;
        $modules->formation_id = $request->formation_id;
        $modules->save();
        return response()->json($modules);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\module  $module
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modules = module::find($id);
        return response()->json($modules);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $modules = module::find($id);
        $modules->nom_modules = $request->nom_modules;
        $modules->volume_horaire = $request->volume_horaire;
        $modules->formation_id = $request->formation_id;
        $modules->save();
        return response()->json($modules);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modules = module::find($id);
        $modules->delete();

        return response()->json($modules);


    }
    public function getModuleWithFormation(){
        $ModuleFormation = module::join('formations','formations.id','=','formation_id')
        ->select('modules.id as module_id','nom_modules', 'volume_horaire',
        'formation_id','designation_Formation','domaine','frais_formation')

        ->get();
        return response()->json($ModuleFormation); 
    }
}
