<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterControllerAdmin;
use App\Http\Controllers\Auth\LoginControllerAdmin;
use App\Http\Controllers\Auth\RegisterControllerUser;
use App\Http\Controllers\Auth\LoginControllerUser;
use App\Http\Controllers\Auth\LoginControllerSociete;
use App\Http\Controllers\Auth\RegisterControllerSociete;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\SocieteController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PostulationController;


Route::post('/register', [RegisterControllerUser::class, 'register']);
Route::post('/login', [LoginControllerUser::class, 'login']);

Route::post('/societe/register', [RegisterControllerSociete::class, 'register']);
Route::post('/societe/login', [LoginControllerSociete::class, 'login']);

Route::post('/admin/login', [LoginControllerAdmin::class, 'login']);
Route::post('/admin/register', [RegisterControllerAdmin::class, 'register']);

Route::post('/logout', [LoginControllerUser::class, 'logout'])->middleware('auth:sanctum');

//OffreController
Route::post('/offre', [OffreController::class, 'store']);
//get all offers
Route::get('/offre', [OffreController::class, 'index']);
//update offer
Route::put('/offre/{id}', [OffreController::class, 'update']);

//offreBySociete id
Route::get('/offre/societe/{id}', [OffreController::class, 'offreBySociete']);
//getAllIntership
Route::get('/offre/internship', [OffreController::class, 'getAllInterships']);
//getAllJobs
Route::get('/offre/jobs', [OffreController::class, 'getAllJobs']);
//getInternshipBySociete
Route::get('/offre/internship/societe/{id}', [OffreController::class, 'getInternshipsBySociete']);
//getJobsBySociete
Route::get('/offre/jobs/societe/{id}', [OffreController::class, 'getJobsBySociete']);
//getJobByID
Route::get('/offre/job/{id}', [OffreController::class, 'getJobByID']);




Route::get('/profil', [ProfilController::class, 'index']);
Route::post('/profil', [ProfilController::class, 'store']);
Route::get('/profil/image/{id}', [ProfilController::class, 'getProfilePicture']);


//SocieteController
Route::post('/societe/profile/{id}', [SocieteController::class, 'createProfile']);
Route::get('/societe/profile/{id}', [SocieteController::class, 'getProfile']);
Route::get('/societe/logo/{id}', [SocieteController::class, 'getLogo']);


//PostulationController
Route::post('/postulation/{offreId}/{userId}', [PostulationController::class, 'store']);
Route::get('/postulation', [PostulationController::class, 'index']);
Route::delete('/postulation/{id}', [PostulationController::class, 'delete']);
Route::get('/postulation/user/{userId}', [PostulationController::class, 'getPostulationsByUser']);
Route::get('/postulation/societe/{societeId}', [PostulationController::class, 'getPosulationsBySociete']);
Route::get('/postulation/offre/{offreId}', [PostulationController::class, 'getPostulationByOffre']);
Route::get('/postulation/societe/{societeId}/latest', [PostulationController::class, 'getLatestCandidates']);
