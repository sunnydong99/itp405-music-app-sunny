@extends('layouts.main')

@section('title')
    Playlists: {{$playlist->name}}
@endsection

@section('content')
    <a href="{{route('playlist.index')}}" class="d-block mb-3">Back to Playlists</a>
    <p>Total tracks: {{ $playlistTracks->count() }}</p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Track Name</th>
                <th>Album</th>
                <th>Artist</th>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($playlistTracks as $track)
                <tr>
                    <td>
                        {{$track->track}}
                    </td>
                    <td>
                        {{$track->album}}
                    </td>
                    <td>
                        {{$track->artist}}
                    </td>
                    <td>
                        {{$track->genre}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection