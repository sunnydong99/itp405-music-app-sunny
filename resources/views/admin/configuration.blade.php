@extends('layouts.main')

@section('title', 'System Configurations')

@section('content')
    <form method="post" action="{{ route('admin.update') }}">
        @csrf
        <div class="my-3">
            <input 
                type="checkbox" 
                id="maintenance" 
                name="maintenance" 
                value="maintenance" 
                {{ $maintenance->value === true ? "checked" : "" }}
            />
            <label class="form-label" for="maintenance">
                Maintenance Mode
            </label>
            <br/>
            <small class="text-secondary">
                @if ( $maintenance->value === false )
                    Check to enable maintenance mode
                @else 
                    Uncheck to disable maintenance mode
                @endif
            </small>
            
        </div>
        <input type="submit" value="Save" class="btn btn-primary">
    </form>
@endsection