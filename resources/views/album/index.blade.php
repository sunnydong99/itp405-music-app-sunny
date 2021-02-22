@extends('layouts.main')

{{-- code from github with blade --}}

@section('title', 'Albums')

@section('content')
    <div class='text-end mb-3'>
        <a href="{{ route('album.create') }}">New Album</a>
    </div>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Album</th>
                <th>Artist</th>
            </tr>
        </thead>
        <tbody>
            @foreach($albums as $album) 
                <tr>
                   <td>
                       {{ $album->title }}
                   </td>
                   <td>
                        {{ $album->artist }}
                    </td>
                    <td>
                        <a href="{{ route('album.edit', ['id' => $album->id]) }}">
                            Edit 
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection