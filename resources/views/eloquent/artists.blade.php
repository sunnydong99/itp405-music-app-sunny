@foreach ($artists as $artist)
    <div>
        {{ $artist->name }}
        {{-- accessing the column as a property of Artist class --}}
    </div>
@endforeach