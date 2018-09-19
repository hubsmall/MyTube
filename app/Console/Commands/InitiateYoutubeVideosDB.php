<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitiateYoutubeVideosDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtubeVideo:initiate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'initiate chosen chanels with miscellaneous playlists for each. Load all videos from the chanel and add them to miscellaneous playlist';

    protected $youTubeVideo;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(YouTubeVideo $yTv)
    {
        parent::__construct();
        $this->youTubeVideo = $yTv;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->youTubeVideo->initialChanels();
        $this->youTubeVideo->allVideosToMiscellaneous();
    }
}
