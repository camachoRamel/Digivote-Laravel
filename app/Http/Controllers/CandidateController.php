<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Party;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
{
    public function saveCandidate(Request $request)
    {
        $validatedData = $request->validate([
            'candidates' => 'required|array',
            'candidates.*.stud_id' => 'required|string|max:10',
            'candidates.*.position_id' => 'required|integer',
            'candidates.*.party_name' => 'nullable|string|max:30',
            'candidates.*.party_img' => 'nullable|string|max:50',
        ]);

        $candidates = $validatedData['candidates'];

        foreach ($candidates as $candidate){
            if($candidates['party_name'] !== null){
                $party = Party::create([
                    'party_name' => $candidate['party_name'],
                    'party_img' => $candidate['party_img']
                ]);
                // $party = Party::select('party_id');
                Candidate::create([
                    'stud_id' => $candidate['stud_id'],
                    'position_id' => $candidate['position_id'],
                    'party_id' => $party->getKey()
                ]);
            }else {
                Candidate::create([
                    'stud_id' => $candidate['stud_id'],
                    'position_id' => $candidate['position_id'],
                ]);
            }
        }

        return response()->json(['redirect_url' => route('admin.index')]);
    }
}


