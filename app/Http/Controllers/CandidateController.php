<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Party;
use App\Models\Student;
use App\Models\Position;

class CandidateController extends Controller
{
    public function index()
    {
        $parties = Party::select('party_id', 'party_name', 'party_img')->get();
        $candidates = Candidate::select('candidate_id', 'position_id', 'stud_id', 'party_id', 'vote')->get();

        // Assuming you want to associate each candidate with a student
        $compiledData = [];
        foreach ($candidates as $candidate) {
            $student = Student::where('stud_id', $candidate->stud_id)->first();
            $compiledData[] = [
                'candidate' => $candidate,
                'party' => $parties->where('party_id', $candidate->party_id)->first(),
                'student' => $student
            ];
        }
        return view('pages.admin.index', compact('compiledData'));
    }

    public function saveCandidate(Request $request)
    {
        $validatedData = $request->validate([
            'candidates' => 'required|array',
            'candidates.*.party_name' => 'nullable|string|max:30|unique:parties,party_name',
            'candidates.*.party_img' => 'nullable|string|max:50|required_unless:candidates.*.party_name,null',
            'candidates.*.stud_id' => 'required|string|max:10',
            'candidates.*.position_id' => 'required|integer'
        ]);

        $candidates = $validatedData['candidates'];

        if ($candidates[0]['party_name'] !== null) {
            $party = Party::create([
                'party_name' => $candidates[0]['party_name'],
                'party_img' => $candidates[0]['party_img']
            ]);
        }
        foreach ($candidates as $candidate) {
            if($candidate['party_name'] !== null){
                Candidate::create([
                    'stud_id' => $candidate['stud_id'],
                    'position_id' => $candidate['position_id'],
                    'party_id' => $party->getKey()
                ]);
            } else {
                Candidate::create([
                    'stud_id' => $candidate['stud_id'],
                    'position_id' => $candidate['position_id'],
                ]);
            }
        }
        return response()->json(['redirect_url' => route('admin.index')]);
    }

    public function getCandidate(int $id)
    {
        $candidate = Candidate::find($id);
        $student = Student::where('stud_id', $candidate->stud_id)->first();
        $party = Party::where('party_id', $candidate->party_id)->first();


        $compiledData = [
            'candidate' => $candidate,
            'party' => $party,
            'student' => $student
        ];

        return view('pages.admin.candidate-view', compact('compiledData'));
    }

    public function editCandidate(int $id)
    {
        $candidate = Candidate::find($id);
        $student = Student::where('stud_id', $candidate->stud_id)->first();

        $compiledData = [
            'candidate' => $candidate,
            'student' => $student
        ];
        return view('pages.admin.candidate-edit', compact('compiledData'));
    }

    public function updateCandidate(Request $request, int $id)
    {
        $candidate = Candidate::find($id);
        $validatedStudent = $request->validate([
            'stud_id' => "required|string|max:10|unique:students,stud_id,$candidate->stud_id,stud_id",
            'stud_firstname' => 'required|string',
            'stud_middlename' => 'required|string',
            'stud_lastname' => 'required|string'
        ]);
        $validatedCandidate = $request->validate([
            'stud_id' => 'required|string|max:10'
        ]);

        $student = Student::where('stud_id', $candidate->stud_id)->first();

        $student->update($validatedStudent);
        $candidate->update($validatedCandidate);

        return redirect()->route('admin.index')->with('success', 'Candidate record updated successfully');
    }

    public function deleteCandidate(int $id)
    {
        $candidate = Candidate::find($id);
        $party = Party::where('party_id', $candidate->party_id)->first();

        $candidate->delete();

        return redirect()->route('admin.index')->with('danger', 'Candidate record deleted successfully');
    }

    public function displayPoll()
    {
        $candidates = Candidate::select('candidate_id', 'position_id', 'stud_id', 'party_id', 'vote')->get();

        // Assuming you want to associate each candidate with a student
        $compiledData = [];
        foreach ($candidates as $candidate) {
            $student = Student::where('stud_id', $candidate->stud_id)->first();
            $compiledData[] = [
                'candidate' => $candidate,
                'student' => $student
            ];
        }
        return view('pages.admin.candidate-poll', compact('compiledData'));
    }

    public function displayCandidates()
    {
        $parties = Party::select('party_id', 'party_name', 'party_img')->get();
        $candidates = Candidate::select('candidate_id', 'position_id', 'stud_id', 'party_id', 'vote')->get();

        // Assuming you want to associate each candidate with a student
        $compiledData = [];
        foreach ($candidates as $candidate) {
            $student = Student::where('stud_id', $candidate->stud_id)->first();
            $compiledData[] = [
                'candidate' => $candidate,
                'party' => $parties->where('party_id', $candidate->party_id)->first(),
                'student' => $student
            ];
        }
        return view('pages.admin.candidate-list', compact('compiledData'));
    }

    public function displayVoters()
    {
        $students = Student::select('stud_id', 'stud_firstname', 'stud_middlename', 'stud_lastname', 'stud_course', 'stud_year', 'stud_cp_num')->get();

        return view('pages.admin.voters', compact('students'));
    }

    public function displayBallotSheet()
    {
        $candidates = Candidate::select('candidate_id', 'position_id', 'stud_id', 'party_id', 'vote')->get();

        return view('pages.user.index', compact('candidates'));
    }
}
