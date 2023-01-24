<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NiveauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $niveaux = niveau::all();
        return response()->json($niveaux);
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
        $niveaux = new niveau();
        $niveaux->designation_niveau=$request->designation_niveau;
        $niveaux->designation_niveau=$request->designation_niveau;
        $niveaux->formation_id = $request->formation_id;
        $niveaux->save();
        return response()->json($niveaux);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $niveaux = niveau::find($id);
        return response()->json($niveaux);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function edit(niveau $niveau)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $niveaux = niveau::find($id);
        $niveaux->designation_niveau=$request->designation_niveau;
        $niveaux->designation_niveau=$request->designation_niveau;
        $niveaux->formation_id = $request->formation_id;
        $niveaux->save();
        return response()->json($niveaux);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $niveaux = niveau::find($id);
        $niveaux->delete();
        return response()->json($niveaux);

        
    }
    public function getNiveauWithFormation(){
        $NiveauFormation = niveau::join('formations','formations.id','=','formation_id')
        ->select('niveaux.id as niveau_id','designation_niveau', 'formation_id',
        'designation_Formation','domaine','frais_formation')

        ->get();
        return response()->json($NiveauFormation); 
    }
}
