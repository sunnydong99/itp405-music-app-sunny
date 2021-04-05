@extends('layouts.email')

@section('content')
    <div class="container-fluid montserrat">
        <h1 class="text-left my-3 oswald">Music App Today</h1>
        <p class="montserrat my-3">Thank you for supporting Music App! Here are the latest stats from our app:</p>
        <div class="row px-3 d-flex flex-row justify-content-around">
            <div class="card col-12 col-md-4">
                <img src="https://atwoodmagazine.com/wp-content/uploads/2020/01/Atwood-Magazines-2020-Artists-to-Watch.jpg" class="card-img-top" alt="Musicians" >
                <div class="card-body">
                    <h3 class="card-title text-info oswald">{{ $numArtists }}</h3>
                    <p class="card-text">That's the number of artists we have stored over the years!</p>
                </div>
            </div>
            <div class="card col-12 col-md-4">
                <img src="https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/123251265/original/b57b452ead0ff43df7042973f06bbc9c002efbeb/design-your-music-playlist-cover-artwork.png" class="card-img-top" alt="Musicians" style="">
                <div class="card-body">
                    <h3 class="card-title text-info oswald">{{ $numPlaylists }}</h3>
                    <p class="card-text">Thanks for creating and enjoying {{ $numPlaylists }} playlists with us.</p>
                </div>
            </div>
            <div class="card col-12 col-md-4">
                <img src="https://axerosolutions.com/assets/Uploaded-CMS-Files/1c3bc747-fef3-4ce9-a3ae-dc94f44fbcb1.jpg" class="card-img-top" alt="Musicians" style="height:100%;">
                <div class="card-body">
                    <h3 class="card-title text-info oswald">{{ $tracksDuration }}</h3>
                    <p class="card-text">If you listened to every track we have stored in Music App, you would spend {{ $tracksDuration }} minutes enjoying some great music.</p>
                </div>
            </div>
        </div>
    </div>

@endsection