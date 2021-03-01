@extends('layouts.main')

{{-- code from album/index.blade.php  --}}

@section('title', 'Albums')

@section('content')
    <div class='text-end mb-3'>
        <a href="{{ route('new-album.create') }}">New Album</a>
    </div>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Album</th>
                <th>Artist</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($albums as $album) 
                <tr>
                   <td>
                       {{ $album->title }}
                       {{ $album->id }}
                   </td>
                   <td>
                        {{ $album->artist->name }} 
                        {{ $album->artist->id }}
                    </td>
                    <td>
                        <a href="{{ route('new-album.edit', ['id' => $album->id]) }}">
                            Edit 
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection