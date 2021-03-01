<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Artist;

class NewAlbumController extends Controller
{
    public function index()
    { 
        $albums = Album::with(['artist'])
            ->join('artists', 'artists.id', '=', 'albums.artist_id')
            ->orderBy('artists.name')
            ->get();
        return view('new-album.index', [
            'albums' => $albums,
        ]);
    }

    public function create()
    {
        $artists = Artist::orderBy('name')->get();
        return view('new-album.create', [
            'artists' => $artists,
        ]);
    }

    public function store(Request $request) // laravel injects request method with all the data from request (what we typed in form)
    {
        $request->validate([
            'title' => 'required|max:50', // title is the name
            'artist' => 'required|exists:artists,id',
        ]);

        $album = new Album();
        $album->title = $request->input('title');
        $album->artist_id = $request->input('artist');
        $album->save(); // this does the insert

        // $artist = Artist::find($request->input('artist'));

        return redirect()
            ->route('new-album.index')
            ->with('success', "Successfully created {$album->artist->name} - {$album->title}");
    }

    public function edit($id)
    {
        $artists = Artist::orderBy('name')->get();
        $album = Album::find($id);

        return view('new-album.edit', [
            'artists' => $artists,
            'album' => $album
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required|max:50', 
            'artist' => 'required|exists:artists,id',
        ]);

        $album = Album::where('id', '=', $id)->first();
        $album->title = $request->input('title');
        $album->artist_id = $request->input('artist');
        $album->save();

        return redirect()
            ->route('new-album.edit', [ 'id' => $id ])
            ->with('success', "Successfully updated {$album->artist->name} - {$album->title}");
    }
}
