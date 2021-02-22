<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = DB::table('tracks')
            ->join('albums', 'tracks.album_id', '=', 'albums.id')
            ->join('artists', 'artists.id', '=', 'albums.artist_id')
            ->join('media_types', 'tracks.media_type_id', '=', 'media_types.id')
            ->join('genres', 'tracks.genre_id', '=', 'genres.id')
            ->orderBy('artist')
            ->orderBy('title')
            ->get([
                'tracks.name',
                'albums.title',
                'artists.name AS artist',
                'media_types.name AS media_type',
                'genres.name AS genre',
                'tracks.unit_price'
            ]);
        return view('track.index', [
            'tracks' => $tracks,
        ]);
    }
    public function create()
    {
        $albums = DB::table('albums')
            ->orderBy('title')
            ->get();
        $media_types = DB::table('media_types')
            ->get();
        $genres = DB::table('genres')
            ->get();
        return view('track.create', [
            'albums' => $albums,
            'media_types'=>$media_types,
            'genres' => $genres,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'album' => 'required|exists:albums,id',
            'media' => 'required|exists:media_types,id',
            'genre' => 'required|exists:genres,id',
            'price' => 'required|numeric'
        ]);

        // dd($request->input('artist')); // $_POST['artist]

        DB::table('tracks')->insert([
            'name' => $request->input('name'),
            'album_id' => $request->input('album'),
            'media_type_id' => $request->input('media'),
            'genre_id' => $request->input('genre'),
            'unit_price' => $request->input('price'),
        ]);

        $artist = DB::table('artists')
            ->where('id', '=', $request->input('artist'))
            ->first();

        return redirect()
            ->route('track.index')
            ->with('success', "The track {$request->input('name')} was successfully created");
    }
}
