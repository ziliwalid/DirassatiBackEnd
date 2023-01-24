<?php

namespace App\Http\Controllers;

use App\Models\groupe;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Group;

class GroupeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Groupe = groupe::all();
        return response()->json($Groupe);

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
        // groupes(id,nom_groupe,#niveaux_id)
        $Groupe = new groupe();
        $Groupe->nom_groupe = $request->nom_groupe;
        $Groupe->niveaux_id = $request->niveaux_id;
        $Groupe->save();
        return response()->json($Groupe);

    


        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\groupe  $groupe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Groupe = groupe::find($id);
        return response()->json($Groupe);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\groupe  $groupe
     * @return \Illuminate\Http\Response
     */
    public function edit(groupe $groupe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\groupe  $groupe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $Groupe = groupe::find($id);
        $Groupe->nom_groupe = $request->nom_groupe;
        $Groupe->niveaux_id = $request->niveaux_id;
        $Groupe->save();
        return response()->json($Groupe);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\groupe  $groupe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Groupe = groupe::find($id);
        $Groupe->delete();
        return response()->json($Groupe);
    }
    public function getGroupeNiveauFormation()
    {
        $Groupe = groupe::join('niveaux', 'niveaux.id', '=', 'niveaux_id')->
            join('formations','formations.id','=','niveaux.formation_id')
            ->select('groupes.id as groupes_id','nom_groupe', 'niveaux_id',
            'designation_niveau','formation_id','designation_Formation','domaine','frais_formation')
            ->get();
            return response()->json($Groupe);


        
    }
}
