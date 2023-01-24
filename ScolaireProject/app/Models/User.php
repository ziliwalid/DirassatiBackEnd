<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static  function UpdateUser($id, $data)
    {
        

        $User =User::find($id);
        $User->nom = $data->nom;
        $User->prenom = $data->prenom;
        $User->adress = $data->adress;
        $User->sexe = $data->sexe;
        $User->email =$data->email;
        $User->password = Hash::make($data->password);

        $User->save();

        return response()->json($User);
        

    }
    public static  function SaveUser($data,$type)
    {
        

        $User =new User();
        $User->nom = $data->nom;
        $User->prenom = $data->prenom;
        $User->adress = $data->adress;
        $User->sexe = $data->sexe;
        $User->email =$data->email;
        $User->password = Hash::make($data->password);
        $User->type = $type;

        $User->save();

        return response()->json($User);
        

    }
    
}
