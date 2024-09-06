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
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AcademicExperienceController;
use App\Http\Controllers\ProfessionalExperienceController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;

// User Registration and Login
Route::post('/register', [RegisterControllerUser::class, 'register']);
Route::post('/login', [LoginControllerUser::class, 'login']);
Route::post('/logout', [LoginControllerUser::class, 'logout'])->middleware('auth:sanctum');

// Societe Registration and Login
Route::post('/societe/register', [RegisterControllerSociete::class, 'register']);
Route::post('/societe/login', [LoginControllerSociete::class, 'login']);

// Admin Registration and Login
Route::post('/admin/login', [LoginControllerAdmin::class, 'login']);
Route::post('/admin/register', [RegisterControllerAdmin::class, 'register']);

// OffreController (Job Offers)
// Create a new offer
Route::post('/offre', [OffreController::class, 'store']);
// Get all offers
Route::get('/offre', [OffreController::class, 'index']);
// Update an offer by ID
Route::put('/offre/{id}', [OffreController::class, 'update']);
// Get an offer by ID
Route::get('/offre/{id}', [OffreController::class, 'show']);
// Get offers by Societe ID
Route::get('/offre/societe/{id}', [OffreController::class, 'offreBySociete']);
// Get all internships
Route::get('/onlyinternships', [OffreController::class, 'getAllInterships']);
// Get all jobs
Route::get('/onlyjobs', [OffreController::class, 'getAllJobs']);
// Get internships by Societe ID
Route::get('/offre/internship/societe/{id}', [OffreController::class, 'getInternshipsBySociete']);
// Get jobs by Societe ID
Route::get('/offre/jobs/societe/{id}', [OffreController::class, 'getJobsBySociete']);
// Get a job by ID
Route::get('/offre/job/{id}', [OffreController::class, 'getJobByID']);
// Get a file by job ID
Route::get('/offre/file/{id}', [OffreController::class, 'getFileByJobId']);
// Delete an offer by ID
Route::delete('/offre/{id}', [OffreController::class, 'delete']);

// ProfilController (User Profiles)
// Get the profile index
Route::get('/profil', [ProfilController::class, 'index']);
// Create or update a profile
Route::post('/profil', [ProfilController::class, 'store']);
// Get profile picture by ID
Route::get('/profil/image/{id}', [ProfilController::class, 'getProfilePicture']);
// Get profile by ID
Route::get('/profil/{id}', [ProfilController::class, 'getProfilById']);
// Get profile by User ID
Route::get('/profil/user/{id}', [ProfilController::class, 'getProfilByUserId']);
// Check profile existance by User ID
Route::get('/profile/exists/{id}', [ProfilController::class, 'checkProfileExistance']);



// SocieteController (Companies)
// Create or update company profile by ID
Route::post('/societe/profile/{id}', [SocieteController::class, 'createProfile']);
// Get company profile by ID
Route::get('/societe/profile/{id}', [SocieteController::class, 'getProfile']);
// Get company logo by ID
Route::get('/societe/logo/{id}', [SocieteController::class, 'getLogo']);
// Check Societe Profile existance by ID
Route::get('/societe/profile/exists/{id}', [SocieteController::class, 'checkProfileExistance']);

// PostulationController (Applications)
// Create a new application for an offer
Route::post('/postulation/{offreId}/{userId}', [PostulationController::class, 'store']);
// Get all applications
Route::get('/postulation', [PostulationController::class, 'index']);
// Delete an application by ID
Route::delete('/postulation/{id}', [PostulationController::class, 'delete']);
// Get applications by User ID
Route::get('/postulation/user/{userId}', [PostulationController::class, 'getPostulationsByUser']);
// Get applications by Societe ID
Route::get('/postulation/societe/{societeId}', [PostulationController::class, 'getPosulationsBySociete']);
// Get applications by Offer ID
Route::get('/postulation/offre/{offreId}', [PostulationController::class, 'getPostulationByOffre']);
// Get latest candidates for a Societe
Route::get('/postulation/societe/{societeId}/latest', [PostulationController::class, 'getLatestCandidates']);
// Accept or reject an application
Route::post('/accept/{postulationId}', [PostulationController::class, 'acceptApplication']);
Route::post('/reject/{postulationId}', [PostulationController::class, 'rejectApplication']);


// BlogController
// Create a new blog post
Route::post('/blog/post', [BlogController::class, 'post']);
// Get all blog posts
Route::get('/blogs', [BlogController::class, 'getAllPosts']);
// Get Blog by ID
Route::get('/blogs/{id}', [BlogController::class, 'getBlogByID']);

//AcademicExperience
Route::post('/experience/academic', [AcademicExperienceController::class, 'store']);

//ProfessionalExperience
Route::post('/experience/professional', [ProfessionalExperienceController::class, 'store']);

//UserController
Route::get('/users', [UserController::class, 'getAllUsers']);
Route::post('/users/block/{id}', [UserController::class, 'blockUser']);
Route::post('/users/unblock/{id}', [UserController::class, 'unblockUser']);

//Mail
Route::post('/candidatmail', [MailController::class, 'sendCandidatMail']);
