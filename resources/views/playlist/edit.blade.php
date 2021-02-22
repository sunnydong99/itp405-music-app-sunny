@extends('layouts.main')

@section('title')
    Renaming {{ $playlist->name }}
@endsection

@section('content')
    <form action="{{ route('playlist.update', [ 'id' => $playlist->id ]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                class="form-control" 
                value="{{ old('name', $playlist->name) }}" {{-- if 'name' from input doesn't exist default to original name --}}
            > 
            @error('name') 
                <small class="text-danger"> {{ $message }} </small>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection