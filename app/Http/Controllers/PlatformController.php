<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platform;


class PlatformController extends Controller
{
    //
    public function index()
    {
        $platforms = Platform::all(); // Ambil semua platform
        return view('components.platform.index', compact('platforms')); // Kirim ke view
    }
    public function create()
    {
        // return view('components.platform.create');
        $platforms = Platform::all(); // Ambil semua platform
        return view('components.platform.create', compact('platforms')); // Kirim ke view
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Simpan platform ke database
        Platform::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        // Redirect ke halaman platform
        return redirect()->route('platform.index')->with('success', 'Platform berhasil ditambahkan!');
    }

    

    public function destroy(Platform $platform)
    {
        $platform->delete(); // Hapus platform dari database
        return redirect()->route('platform.index')->with('success', 'Platform berhasil dihapus!');
    }
}
