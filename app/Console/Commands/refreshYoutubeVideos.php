<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class refreshYoutubeVideos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtubeVideo:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check for new videos on chanels, load them, link appropriate playlist';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->youTubeVideo->allVideosToMiscellaneous();
        $this->youTubeVideo->setPlaylists();
        $this->youTubeVideo->checkForEmptyPlaylists();
    }
}
