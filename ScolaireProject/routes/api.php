<?php

use App\Http\Controllers\AdministratifController;
use App\Http\Controllers\CourController;
use App\Http\Controllers\EnseigantController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\UserController;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => 'auth:api'], function () {

/////////Formation
Route::get('getAllFormation',[FormationController::class,'index']);
Route::post('addFormation', [FormationController::class, 'store']);
Route::get('showFormation/{id}',[FormationController::class,'show']);
Route::delete('deleteFormation/{id}',[FormationController::class,'destroy']);
Route::put('updateFormation/{id}',[FormationController::class,'update']);
Route::get('searchWithFormation/{name}',[FormationController::class,'searchWithFormation']);


////////niveaux
Route::get('getAllNiveau',[NiveauController::class,'index']);
Route::post('addNiveau', [NiveauController::class, 'store']);
Route::get('showNiveau/{id}',[NiveauController::class,'show']);
Route::delete('deleteNiveau/{id}',[NiveauController::class,'destroy']);
Route::put('updateNiveau/{id}',[NiveauController::class,'update']);
Route::get('Niveau/getNiveauWithFormation',[NiveauController::class,'getNiveauWithFormation']);




///////////modules
Route::get('getAllModule',[ModuleController::class,'index']);
Route::post('addModule', [ModuleController::class, 'store']);
Route::get('showModule/{id}',[ModuleController::class,'show']);
Route::delete('deleteModule/{id}',[ModuleController::class,'destroy']);
Route::put('updateModule/{id}',[ModuleController::class,'update']);
Route::get('Module/getModuleWithFormation',[ModuleController::class,'getModuleWithFormation']);




////////Etudiant
Route::get('getAllEtudiant',[EtudiantController::class,'index']);
Route::post('addEtudiant', [EtudiantController::class, 'store']);
Route::get('showEtudiant/{id}',[EtudiantController::class,'show']);
Route::delete('deleteEtudiant/{id}',[EtudiantController::class,'destroy']);
Route::put('updateEtudiant/{id}',[EtudiantController::class,'update']);
Route::get('getEtudiantData/{id}',[EtudiantController::class,'getEtudiantData']);
Route::get('getAllEtudiantData',[EtudiantController::class,'getAllEtudiantData']);



////////Enseigant

Route::get('getAllEnseigant',[EnseigantController::class,'index']);
Route::post('addEnseigant', [EnseigantController::class, 'store']);
Route::get('showEnseigant/{id}',[EnseigantController::class,'show']);
Route::delete('deleteEnseigant/{id}',[EnseigantController::class,'destroy']);
Route::put('updateEnseigant/{id}',[EnseigantController::class,'update']);
Route::get('getEnseigantData/{id}',[EnseigantController::class,'getEnseigantData']);
Route::get('getAllEnseigantData',[EnseigantController::class,'getAllEnseigantData']);




//////Groupe

Route::get('getAllGroupe',[GroupeController::class,'index']);
Route::post('addGroupe', [GroupeController::class, 'store']);
Route::get('showGroupe/{id}',[GroupeController::class,'show']);
Route::delete('deleteGroupe/{id}',[GroupeController::class,'destroy']);
Route::put('updateGroupe/{id}',[GroupeController::class,'update']);
Route::get('Group/getGroupeNiveauFormation',[GroupeController::class,'getGroupeNiveauFormation']);





////cour

Route::get('getAllCour',[CourController::class,'index']);
Route::post('addCour', [CourController::class, 'store']);
Route::get('showCour/{id}',[CourController::class,'show']);
Route::delete('deleteCour/{id}',[CourController::class,'destroy']);
Route::put('updateCour/{id}',[CourController::class,'update']);
Route::get('Cour/getCourModuleEnseignant',[CourController::class,'getCourModuleEnseignant']);




//////Administratif
Route::get('getAllAdministratif',[AdministratifController::class,'index']);
Route::post('addAdministratif', [AdministratifController::class, 'store']);
Route::get('showAdministratif/{id}',[AdministratifController::class,'show']);
Route::delete('deleteAdministratif/{id}',[AdministratifController::class,'destroy']);
Route::put('updateAdministratif/{id}',[AdministratifController::class,'update']);
Route::get('getAdministratifData/{id}',[AdministratifController::class,'getAdministratifData']);
Route::get('getAllAdministratifData',[AdministratifController::class,'getAllAdministratifData']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});





Route::get('userData',[UserController::class,'userData']);
});
Route::post('logine',[UserController::class,'userLogin']);
Route::post('RegisterLogin',[UserController::class,'RegisterLogin']);
Route::get('logout',[UserController::class,'logout']);

