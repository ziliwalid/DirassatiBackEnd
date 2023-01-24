<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formation = Formation::all();
        return response()->json($formation);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make(
            $request->all(),
            [
                'designation_Formation' => 'required',
                'domaine' => 'required',
                'frais_formation' => 'required'


            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $Formation = new Formation();
        $Formation->designation_Formation = $request->designation_Formation;
        $Formation->domaine = $request->domaine;
        $Formation->frais_formation = $request->frais_formation;
        return response()->json($Formation);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Formation = Formation::find($id);
        return response()->json($Formation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function edit(Formation $formation)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Formation = Formation::find($id);
        $Formation->designation_Formation = $request->designation_Formation;
        $Formation->domaine = $request->domaine;
        $Formation->frais_formation = $request->frais_formation;
        $Formation->save();
        return response()->json($Formation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Formation = Formation::find($id);
        $Formation->delete();
        return response()->json($Formation);



    }
    public function searchWithFormation($nameFormation)
    {
        return Formation::where('designation_Formation', 'like', '%' . $nameFormation . '%')->get();
    }


}