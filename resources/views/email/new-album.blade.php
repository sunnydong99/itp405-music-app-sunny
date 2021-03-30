@extends('layouts.email')

@section('content')
    <h1>New album was created!</h1>
    <p>
        {{ $album->artist->name }} has a new albumm called {{ $album->title }}.
    </p>
@endsection