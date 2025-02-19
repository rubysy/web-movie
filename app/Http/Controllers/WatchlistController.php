<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchlist;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
    public function index()
    {
        $watchlist = Watchlist::where('user_id', Auth::id())->get();
        return view('watchlist.index', compact('watchlist'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tmdb_id' => 'required',
            'title' => 'required',
            'type' => 'required',
            'poster' => 'nullable'
        ]);

        Watchlist::create([
            'user_id' => Auth::id(),
            'tmdb_id' => $request->tmdb_id,
            'title' => $request->title,
            'type' => $request->type,
            'poster' => $request->poster,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $watchlist = Watchlist::where('user_id', Auth::id())->where('id', $id)->first();
        if ($watchlist) {
            $watchlist->delete();
        }

        return response()->json(['success' => true]);
    }


public function check($tmdbId)
{
    $inWatchlist = Watchlist::where('user_id', Auth::id())
        ->where('tmdb_id', $tmdbId)
        ->exists();
    
    return response()->json(['inWatchlist' => $inWatchlist]);
}

public function edit($id)
{
    $item = Watchlist::findOrFail($id); // Pastikan model Watchlist sudah didefinisikan
    return view('watchlist.edit', compact('item'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        // tambahkan validasi sesuai kebutuhan
    ]);

    $item = Watchlist::findOrFail($id);
    $item->update($request->only('title', 'description'));
    
    return redirect()->route('watchlist.index')->with('success', 'Item berhasil diperbarui');
}
}
