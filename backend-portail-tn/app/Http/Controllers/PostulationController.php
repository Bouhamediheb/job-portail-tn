<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postulation;

class PostulationController extends Controller
{

    public function index()
    {
        $postulations = Postulation::all();
        return $postulations;
    }


    public function store($offreId, $userId)
    {
        $postulation = new Postulation();
        $postulation->etat = 'demande';
        $postulation->offre_id = $offreId;
        $postulation->user_id = $userId;
        $postulation->save();

        return response()->json([
            'status' => true,
            'message' => 'Postulation Created Successfully',
        ], 200);
    }

    public function delete($id)
    {
        $postulation = Postulation::find($id);

        $postulation->delete();
        return response()->json([
            'status' => true,
            'message' => 'Postulation Deleted Successfully',
        ], 200);
    }

    public function getPostulationsByUser($userId)
    {
        $postulations = Postulation::where('user_id', $userId)->with('offre')->get();
        return $postulations;
    }

    public function getPosulationsBySociete($societeId)
    {
        $postulations = Postulation::whereHas('offre', function ($query) use ($societeId) {
            $query->where('societe_id', $societeId);
        })->with('user', 'user.profil')->get();
        return $postulations;
    }

    public function getPostulationByOffre($offreId)
    {
        $offres = Postulation::where('offre_id', $offreId)->with('user', 'user.profil')->get();
        return $offres;
    }

    public function getLatestCandidates($societeId)
    {
        $postulations = Postulation::whereHas('offre', function ($query) use ($societeId) {
            $query->where('societe_id', $societeId);
        })->with('user', 'user.profil')->latest()->take(5)->get();
        return $postulations;
    }

    public function acceptApplication($postulationId)
    {
        $postulation = Postulation::where('id', $postulationId)->first();
        $postulation->etat = 'acceptee';
        $postulation->save();
        return response()->json([
            'status' => true,
            'message' => 'Postulation Accepted Successfully',
            'postulation' => $postulation
        ]);
    }

    public function rejectApplication($postulationId)
    {
        $postulation = Postulation::where('id', $postulationId)->first();
        $postulation->etat = 'refusee';
        $postulation->save();
        return response()->json([
            'status' => true,
            'message' => 'Postulation Rejected Successfully',
            'postulation' => $postulation
        ]);
    }
}
