<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Album;

class NewAlbum extends Mailable
{
    use Queueable, SerializesModels;

    public $album; // need to declare this as public property to access it in the view

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Album $album) // receive in the constructor
    {
        $this->album = $album;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject("{$this->album->artist->name} has a new album!")
            ->view('email.new-album');
    }
}
