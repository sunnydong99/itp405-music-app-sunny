@extends('layouts.main')

@section('title')
    Editing {{ $album->title }}
@endsection

@section('content')
    <form action="{{ route('album.update', [ 'id' => $album->id ]) }}" method="POST">
        {{-- to avoid 419 page expired error --}}
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                class="form-control" 
                value="{{ old('title', $album->title) }}"
            > {{-- keep old title if it's new, otherwise default to saved title --}}
            @error('title') {{-- name of the function call, the require rule has a message template--}}
                <small class="text-danger"> {{ $message }} </small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="artist" class="form-label">Artist</label>
            <select name="artist" id="artist" class="form-select">
                <option value="">-- Select Artist --</option>
                @foreach($artists as $artist)
                    <option 
                        value="{{$artist->id}}"
                        {{ $artist->id === (int) old('artist', $album->artist_id) ? "selected" : "" }}
                    >
                        {{$artist->name}}
                    </option>
                @endforeach
            </select>
            @error('artist') {{-- name of the function call--}}
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection