<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platform;

class CategoryPlatformController extends Controller
{
    //

    public function create(){
        return view("components/new/platform/create");
    }
        // Menampilkan semua platform
    public function index()
    {
        $platforms = Platform::all(); // Mengambil semua data platform
        return view('platform.index', compact('platforms'));
    }

    // Menyimpan platform baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Platform::create($validated);
        return redirect()->route('platform.index');
    }

    // Menampilkan detail platform
    public function show($id)
    {
        $platform = Platform::findOrFail($id);
        return view('platform.show', compact('platform'));
    }

    // Menampilkan form untuk mengedit platform
    public function edit($id)
    {
        $platform = Platform::findOrFail($id);
        return view('platform.edit', compact('platform'));
    }

    // Menyimpan perubahan platform
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $platform = Platform::findOrFail($id);
        $platform->update($validated);

        return redirect()->route('platform.index');
    }

    // Menghapus platform
    public function destroy($id)
    {
        $platform = Platform::findOrFail($id);
        $platform->delete();

        return redirect()->route('platform.index');
    }
}
