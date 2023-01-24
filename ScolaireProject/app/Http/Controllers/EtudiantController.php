<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Etudiant = Etudiant::all();
        return response()->json($Etudiant);

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
        $validator = \Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
                'nom' => 'required',
                'prenom' => 'required',
                'adress' => 'required',
                'sexe' => 'required',
                'cne' => 'required'
            ]
        );
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        $User = User::SaveUser($request, 'Etudiant');
        $dataUser = User::where('email', $request->email)->get();

        $Etudiant = new Etudiant();
        $Etudiant->cne = $request->cne;
        $Etudiant->user_id = $dataUser[0]->id;
        $Etudiant->save();
        return response()->json(['etudiant' => $Etudiant, "user" => $User]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Etudiant = Etudiant::find($id);
        return response()->json($Etudiant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /////validation

        $validator = \Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
                'nom' => 'required',
                'prenom' => 'required',
                'adress' => 'required',
                'sexe' => 'required',
                'cne' => 'required'
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        /////update

        $Etudiant = Etudiant::find($id);
        $user = User::UpdateUser($Etudiant->user_id, $request);
        $Etudiant->cne = $request->cne;
        $Etudiant->save();
        return response()->json(['Etudiant' => $Etudiant, 'user' => $user]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Etudiant = Etudiant::find($id);
        $User = User::find($Etudiant->user_id);
        $Etudiant->delete();
        $User->delete();

        return response()->json($Etudiant);
    }


    public function getEtudiantData($id)
    {
        $Etudiant = User::join('etudiants', 'users.id', '=', 'etudiants.user_id')
            ->where('user_id', $id)
            ->get();
        return response()->json($Etudiant);

    }
    public function getAllEtudiantData(){
        $Etudiant = User::join('etudiants', 'users.id', '=', 'etudiants.user_id')
            ->select('etudiants.id','nom', 'prenom','adress',
                'sexe','email','type','cne','user_id'
            )

            ->get();
        return response()->json($Etudiant);

}

}
