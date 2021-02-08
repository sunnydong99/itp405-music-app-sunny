<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = DB::table('playlists')
            // ->join()
            ->get();
        return view('playlist.index', [
            'playlists' => $playlists, // pass variable into the view
        ]);
    }
    public function show($id)
    {
        // dd($id);
        $playlist = DB::table('playlists')
            ->where('id', '=', $id)
            ->first();
        // dd($playlist);
        $playlistTracks = DB::table('playlist_track')
            ->where('playlist_id','=',$id)
            ->join('tracks', 'playlist_track.track_id', '=','tracks.id')
            ->join('genres', 'tracks.genre_id', '=', 'genres.id')
            ->join('albums', 'tracks.album_id', '=', 'albums.id')
            ->join('artists', 'albums.artist_id', '=', 'artists.id')
            ->get([
                'tracks.name AS track',
                'albums.title AS album',
                'artists.name AS artist',
                'genres.name AS genre',
            ]);
        // dd($playlistTracks);

        return view('playlist.show',[
            'playlist' => $playlist,
            'playlistTracks' => $playlistTracks,
        ]);
    }
}
