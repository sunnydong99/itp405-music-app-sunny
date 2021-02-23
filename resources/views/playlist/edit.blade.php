@extends('layouts.main')

@section('title')
    Renaming {{ $playlist->name }}
@endsection

@section('content')
    <form action="{{ route('playlist.update', [ 'id' => $playlist->id ]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="playlist" class="form-label">Name</label>
            <input 
                type="text" 
                name="playlist" 
                id="playlist" 
                class="form-control" 
                value="{{ old('playlist', $playlist->name) }}" {{-- if 'playlist' from input doesn't exist default to original name --}}
            > 
            @error('playlist') 
                <small class="text-danger"> {{ $message }} </small>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection