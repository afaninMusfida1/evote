<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public function index()
    {
        // Cek apakah user adalah admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            $candidates = Candidate::all();
            return view('candidates.index', compact('candidates'));
        }

        // Jika bukan admin, arahkan kembali ke halaman login
        return redirect('/')->with('error', 'You do not have admin access.');
    }

    public function create()
    {
        // Cek apakah user adalah admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('candidates.create');
        }

        // Jika bukan admin, arahkan kembali
        return redirect('/')->with('error', 'You do not have admin access.');
    }

    public function store(Request $request)
    {
        // Cek apakah user adalah admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            $request->validate([
                'name' => 'required',
                'nomor_urut' => 'required|integer',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'visi_misi' => 'required',
            ]);

            // Handle image upload
            $imagePath = $request->file('image')->store('candidate_images', 'public');

            // Create the new candidate
            Candidate::create([
                'name' => $request->name,
                'nomor_urut' => $request->nomor_urut,
                'image' => $imagePath, // store the image path
                'visi_misi' => $request->visi_misi,
            ]);

            return redirect()->route('candidates.index')->with('success', 'Candidate added successfully');
        }

        // Jika bukan admin, arahkan kembali
        return redirect('/')->with('error', 'You do not have admin access.');
    }
}
