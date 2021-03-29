@extends('layouts.main')

{{-- code from album/index.blade.php  --}}

@section('title', 'Albums')

@section('content')
    @if (Auth::check())
        <div class='text-end mb-3'>
            <a href="{{ route('new-album.create') }}">New Album</a>
        </div>
    @endif
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Album</th>
                <th>Artist</th>
                <th>Created By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($albums as $album) 
                <tr>
                   <td>
                       {{ $album->title }}
                   </td>
                   <td>
                        {{ $album->artist->name }}
                    </td>
                    <td>
                        {{ $album->user->name }}
                    </td>
                    <td>
                        @can('update', $album)
                            <a href="{{ route('new-album.edit', ['id' => $album->album_id]) }}">
                                Edit 
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection