<?php

namespace App\Http\Controllers;

use App\Models\administratif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdministratifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Administratifs = administratif::all();
        return response()->json($Administratifs);


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
                'fonction'=>'required'
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        


        $User = User::SaveUser($request,'Admin');
        $dataUser = User::where('email',$request->email)->get();
        
        $Administratifs=new administratif();
        $Administratifs->fonction = $request->fonction;
        $Administratifs->user_id =$dataUser[0]->id;
        ;
        $Administratifs->save();
        return response()->json(['Administratifs'=>$Administratifs,"user"=>$User]);


        


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\administratif  $administratif
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Administratifs = administratif::find($id);
        return response()->json($Administratifs);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\administratif  $administratif
     * @return \Illuminate\Http\Response
     */
    public function edit(administratif $administratif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\administratif  $administratif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        
        $Administratifs=administratif::find($id);
        $user=User::UpdateUser($Administratifs->user_id, $request);

        $Administratifs->fonction = $request->fonction;
        $Administratifs->fonction = $request->fonction;
        $Administratifs->save();
        return response()->json($Administratifs);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\administratif  $administratif
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Administratifs = administratif::find($id);
        $User = User::find($Administratifs->user_id);
        $User->delete();
        $Administratifs->delete();
        
        return response()->json($Administratifs);
    }
    public function getAdministratifData($id){
        $Etudiant = User::join('administratifs','users.id','=','administratifs.user_id')
        ->where('user_id',$id)
        ->get();
        return response()->json($Etudiant);

    }
}
