@extends('layouts.main')

@section('title', 'Playlists')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Playlists</th>
            </tr>
        </thead>
        <tbody>
            @foreach($playlists as $playlist)
                <tr>
                    <td>
                        <a href="{{route('playlist.show', ['id' => $playlist->id])}}">
                            {{$playlist->name}}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection