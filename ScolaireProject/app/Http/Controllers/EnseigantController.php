<?php

namespace App\Http\Controllers;

use App\Models\Enseigant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class EnseigantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Enseigant = Enseigant::all();
        return response()->json($Enseigant);
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
                'grade' => 'required',
                'specialite' => 'required'

            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $User = User::SaveUser($request,'Enseigant');
        $dataUser = User::where('email', $request->email)->get();


        $Enseigant = new Enseigant();
        $Enseigant->grade = $request->grade;
        $Enseigant->specialite = $request->specialite;
        $Enseigant->user_id = $dataUser[0]->id;
        $Enseigant->save();
        return response()->json(['Enseigant' => $Enseigant, "user" => $User]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enseigant  $enseigant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Enseigant = Enseigant::find($id);
        return response()->json($Enseigant);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enseigant  $enseigant
     * @return \Illuminate\Http\Response
     */
    public function edit(Enseigant $enseigant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enseigant  $enseigant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
                'grade' => 'required',
                'specialite' => 'required'

            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $Enseigant = Enseigant::find($id);
        $user=User::UpdateUser($Enseigant->user_id, $request);

        $Enseigant->grade = $request->grade;
        $Enseigant->specialite = $request->specialite;
        $Enseigant->save();
        return response()->json(['Enseigant'=>$Enseigant,'user'=>$user]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enseigant  $enseigant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Enseigant = Enseigant::find($id);
        $user = User::find($Enseigant->user_id);
        $Enseigant->delete();
        $user->delete();

        return response()->json($Enseigant);

    }
    public function getEnseigantData($id)
    {
        $Enseigant = User::join('enseigants', 'users.id', '=', 'enseigants.user_id')
            ->where('user_id', $id)
            ->get();
        return response()->json($Enseigant);

    }
    public function getAllEnseigantData(){
        $Enseigant = User::join('Enseigants', 'users.id', '=', 'Enseigants.user_id')
            ->select('Enseigants.id','nom', 'prenom','adress',
                'sexe','email','type','specialite','grade','user_id'
            )

            ->get();
        return response()->json($Enseigant);
    }
}
