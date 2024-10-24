<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        return view('vote.index', compact('candidates'));
    }

    public function store(Request $request)
{
    $request->validate([
        'candidate_id' => 'required|exists:candidates,id',
    ]);

    // Check if the user has already voted
    $existingVote = Vote::where('voter_id', Auth::id())
                        ->where('candidate_id', $request->candidate_id)
                        ->first();

    if ($existingVote) {
        return redirect()->route('vote.index')->with('error', 'You have already voted.'); // Notify user
    }

    // Store the vote if not already voted
    Vote::create([
        'candidate_id' => $request->candidate_id,
        'voter_id' => Auth::id(),
    ]);

    return redirect()->route('vote.index')->with('success', 'Vote submitted successfully!');
}


    public function results()
    {
        // Get voting results
        $results = DB::table('votes')
            ->select('candidate_id', DB::raw('count(*) as total_votes'))
            ->groupBy('candidate_id')
            ->get();

        // Get all candidates to display names
        $candidates = Candidate::all();

        return view('result', compact('results', 'candidates'));
    }
}
