<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Validation\Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function userLogin(Request $request)
    {
        $validator = \Validator::make($request->all(), ['email' => 'required|email', 'password' => 'required']);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('tokenName')->accessToken;
            $message="login done";
            return response()->json([
                'state' => 1,
                'token' => $token,
                'message' => $message
            ]);
        }


    }
    public function RegisterLogin(Request $request)
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
                'type' => 'required'
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $User = new User();
        $User->nom = $request->nom;
        $User->prenom = $request->prenom;
        $User->adress = $request->adress;
        $User->sexe = $request->sexe;
        $User->email =$request->email;
        $User->password = Hash::make($request->password);
        $User->type = $request->type;

        $User->save();
        $token = $User->createToken('tokenName')->accessToken;

        return response()->json(['user'=>$User,'token'=>$token]);


    }
    public function userData()
    {
        $User = Auth::guard('api')->user();
        return response()->json(['data' => $User]);


    }
    public function logout(){
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
         }
        return response()->json(['success'=>"logout"]);
    }



}
