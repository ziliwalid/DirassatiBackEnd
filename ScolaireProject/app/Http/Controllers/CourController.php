<?php

namespace App\Http\Controllers;

use App\Models\cour;
use Illuminate\Http\Request;

class CourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Cour = cour::all();
        return response()->json($Cour);
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
        // cours(id,nom_cours,anne, #groupe_id, #module_id, #enseigant_id)
        $Cour = new cour();
        $Cour->nom_cours = $request->nom_cours;
        $Cour->anne = $request->anne;

        $Cour->groupe_id = $request->groupe_id;

        $Cour->Module = $request->Module;
        $Cour->enseigant_id = $request->enseigant_id;
        $Cour->save();



        return response()->json($Cour);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cour  $cour
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Cour = cour::find($id);
        return response()->json($Cour);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cour  $cour
     * @return \Illuminate\Http\Response
     */
    public function edit(cour $cour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cour  $cour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $Cour = cour::find($id);

        $Cour->nom_cours = $request->nom_cours;
        $Cour->anne = $request->anne;

        $Cour->groupe_id = $request->groupe_id;

        $Cour->Module = $request->Module;
        $Cour->enseigant_id = $request->enseigant_id;
        $Cour->save();
        return response()->json($Cour);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cour  $cour
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Cour = cour::find($id);
        $Cour->delete();
        return response()->json($Cour);
    }
    public function getCourModuleEnseignant(){
        $Cour = cour::join('enseigants','enseigants.id','=','enseigant_id')
            ->join('groupes','groupes.id','=','groupe_id')
            ->join('niveaux', 'niveaux.id', '=', 'niveaux_id')

            ->join('formations','formations.id','=','formation_id')
            ->select('cours.id as cours_id','nom_cours', 'anne',
                'groupe_id','enseigant_id',
                'formation_id','grade','specialite','user_id','nom_groupe','niveaux_id',
                'designation_Formation','domaine','frais_formation','Module')

            ->get();
        return response()->json($Cour);
    }
}
