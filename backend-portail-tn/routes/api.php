<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterControllerUser;
use App\Http\Controllers\Auth\LoginControllerUser;
use App\Http\Controllers\OffreController;

Route::post('/register', [RegisterControllerUser::class, 'register']);

Route::post('/login', [LoginControllerUser::class, 'login']);

Route::post('/logout', [LoginControllerUser::class, 'logout'])->middleware('auth:sanctum');

//OffreController
Route::post('/offre', [OffreController::class, 'store']);
