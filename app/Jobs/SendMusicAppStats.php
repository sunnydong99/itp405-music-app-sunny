<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\MusicAppStats;
use App\Models\User;
use Exception;

class SendMusicAppStats implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $numArtists;
    protected $numPlaylists;
    protected $tracksDuration;
    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();
        foreach($users as $user) {
            if ($user->email) {
                Mail::to($user->email)
                    ->send(new MusicAppStats($this->numArtists, $this->numPlaylists, $this->tracksDuration));
            } else {
                throw new Exception("User {$user->id} is missing an email");
            }
        }
    }
}
