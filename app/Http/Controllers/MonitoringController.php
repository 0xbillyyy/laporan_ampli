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
        $data = $request->validate([
            'platform_id' => 'required|exists:platforms,id',
            'link' => 'required|url',
            "identity" => "required",
            // "platformId" => "required"
            // 'content' => 'required|string',
        ]);
    
        // $monitoring = Monitoring::where('user_id', auth()->id())
        //     ->where('platform_id', $data['platform_id'])
        //     // ->where('content', $data['content'])
        //     ->first();

        $link = Link::all();  // Mengambil semua data Link

        $monitoring = Monitoring::where('user_id', auth()->id())  // Mengambil link pertama dari koleksi
            ->where('content', $data["identity"])  // Mengambil link pertama dari koleksi
            ->where('platform_id', $data["platform_id"])  // Mengambil link pertama dari koleksi
            // ->where('platform_id', $data['platform_id'])
            // ->where('content', $data['content'])
            ->first();


        if ($monitoring) {
            $monitoring->update(['link' => $data['link']]);
        } else {
            $monitoring = Monitoring::create([
                'user_id' => auth()->id(),
                'platform_id' => $data['platform_id'],
                'link' => $data['link'],
                'content' => $data["identity"],
                // 'content' => $data['content'],
            ]);
        }
    
        return response()->json(['message' => 'Success', 'id' => $monitoring->id]);
    }
    


    public function create()
    {
        $links = Link::all();
        $platforms = Platform::all();
        $userId = auth()->id();
    
        // Membuat array: [context][platform_id] => monitoring
        $monitorings_by_platform = [];
    
        foreach ($links as $link) {
            foreach ($platforms as $platform) {
                $monitoring = Monitoring::where('platform_id', $platform->id)
                    ->where('user_id', $userId)
                    ->where('content', $link->link)
                    ->first();
    
                $monitorings_by_platform[$link->context][$platform->id] = $monitoring;
            }
        }
    
        return view('components.monitoring.create', compact(
            'links',
            'platforms',
            'monitorings_by_platform'
        ));
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
