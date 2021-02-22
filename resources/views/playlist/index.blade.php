@extends('layouts.main')

@section('title', 'Playlists')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>Playlists</th>
            </tr>
        </thead>
        <tbody>
            @foreach($playlists as $playlist)
                <tr>
                    <td>
                        <a href="{{route('playlist.edit', ['id' => $playlist->id])}}">
                            Rename
                        </a>
                    </td>
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