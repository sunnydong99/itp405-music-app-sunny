<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MusicAppStats extends Mailable
{
    use Queueable, SerializesModels;

    public $numArtists;
    public $numPlaylists;
    public $tracksDuration;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $numArtists, int $numPlaylists, int $tracksDuration)
    {
        $this->numArtists = $numArtists;
        $this->numPlaylists = $numPlaylists;
        $this->tracksDuration = $tracksDuration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject("Music App Stats")
            ->view('email.stats');
    }
}
