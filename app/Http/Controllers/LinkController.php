<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Platform;

class LinkController extends Controller
{
    //

    public function index()
    {
        $links = Link::with('platform')->latest()->get();
        return view('components.link.index', compact('links'));

    }


    public function create()
    {
        $platforms = Platform::all(); // ambil semua platform untuk dropdown
        return view('components.link.create', compact('platforms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_platform' => 'required|exists:platforms,id',
            'link' => 'required|url',
            'context' => 'nullable|string',
        ]);

        Link::create($request->all());

        return redirect()->route('link.create')->with('success', 'Link berhasil ditambahkan!');
    }


    public function destroy(Link $link)
    {
        $link->delete();
        return redirect()->route('link.index')->with('success', 'Link berhasil dihapus.');
    }
}
