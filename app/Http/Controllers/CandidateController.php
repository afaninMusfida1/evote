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

    public function edit($id)
{
    $candidate = Candidate::findOrFail($id);
    return view('candidates.edit', compact('candidate'));
}

public function update(Request $request, $id)
{
    $candidate = Candidate::findOrFail($id);

    // Validasi data
    $request->validate([
        'name' => 'required|string|max:255',
        'nomor_urut' => 'required|integer',
        'visi_misi' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
    ]);

    // Cek apakah ada gambar yang diunggah
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('candidate_images', 'public');
    
        // Hapus gambar lama jika ada
        if ($candidate->image) { // Ganti image_url dengan image
            Storage::disk('public')->delete($candidate->image);
        }
    
        // Simpan jalur gambar baru
        $candidate->image = $imagePath; // Ganti image_url dengan image
    }
    
    $candidate->update($request->except(['image'])); // Simpan perubahan
     // Jangan update field 'image', karena sudah dihandle di atas

    return redirect()->route('candidates.index')->with('success', 'Candidate updated successfully');
}

}
