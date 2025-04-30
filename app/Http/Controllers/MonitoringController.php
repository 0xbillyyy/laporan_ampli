<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\Link;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{

    public function index()
    {
        $monitorings = Monitoring::all();
        return view('components.monitoring.index', compact('monitorings'));
    }

    public function destroy($id)
    {
        $monitoring = Monitoring::findOrFail($id);
        $monitoring->delete();

        return redirect()->route('components.monitoring.index')->with('success', 'Monitoring berhasil dihapus!');
    }

    public function autoSave(Request $request)
    {
        $request->validate([
            'platform_id' => 'required|exists:platforms,id',
            'link' => 'required|url',
            'context' => 'nullable|string',
        ]);
    
        try {
            Monitoring::create([
                'platform_id' => $request->platform_id,
                'user_id' => auth()->id(),
                'link' => $request->link,
                'content' => $request->context,
            ]);
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    

    public function create()
    {
        $links = Link::all(); // Ambil semua platform
        $platforms = Platform::all();
        return view('components.monitoring.create', compact('links', "platforms")); // Kirim data platform ke view
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'platform_id' => 'required|exists:platforms,id',
            'user_id' => 'required|exists:users,id',
            'link' => 'required|url',
            'content' => 'nullable|string',
            // 'author' => 'nullable|string',
            // 'like' => 'nullable|string',
            // 'comment' => 'nullable|string',
            // 'share' => 'nullable|string',
            // 'view' => 'nullable|string',
            // 'published_at' => 'nullable|date',
        ]);

        // Simpan monitoring ke database
        Monitoring::create([
            'platform_id' => $validated['platform_id'],
            'user_id' => Auth::id(), // Ambil ID user yang sedang login
            'link' => $validated['link'],
            'content' => $validated['content'],
            // 'author' => $validated['author'],
            // 'like' => $validated['like'],
            // 'comment' => $validated['comment'],
            // 'share' => $validated['share'],
            // 'view' => $validated['view'],
            // 'published_at' => $validated['published_at'],
        ]);

        // Redirect ke halaman monitoring
        return redirect()->route('monitoring.create')->with('success', 'Monitoring berhasil ditambahkan!');
    }
}
