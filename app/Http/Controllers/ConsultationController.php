<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\Consultation;
use App\Models\Societie;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function createConsultation() {
        $apiToken = request()->input('token');

        $diseaseHistory = request()->input('disease_history');
        $currentSymptoms = request()->input('current_symptoms');
        $society = Societie::where('login_tokens', '=', $apiToken)->first();
        $consultation = Consultation::where('society_id', '=', $society['id'])->first()->update([
            'disease_history' => $diseaseHistory,
            'current_symptoms' => $currentSymptoms
        ]);

        //return response()->json([$diseaseHistory, $currentSymptoms]);

        if(!$consultation) {
            return response()->json(['error' => 'pokonya error!']);
        }

        $body = ['message' => 'Request consultation sent successful'];

        return ApiFormatter::createApi('200', $body);
    }
}
