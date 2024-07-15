<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterControllerUser;
use App\Http\Controllers\Auth\LoginControllerUser;
use App\Http\Controllers\Auth\LoginControllerSociete;
use App\Http\Controllers\Auth\RegisterControllerSociete;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\SocieteController;

Route::post('/register', [RegisterControllerUser::class, 'register']);

Route::post('/login', [LoginControllerUser::class, 'login']);

Route::post('/societe/register', [RegisterControllerSociete::class, 'register']);
Route::post('/societe/login', [LoginControllerSociete::class, 'login']);

Route::post('/logout', [LoginControllerUser::class, 'logout'])->middleware('auth:sanctum');

//OffreController
Route::post('/offre', [OffreController::class, 'store']);

//SocieteController
Route::put('/societe/profile/{id}', [SocieteController::class, 'createProfile']);
