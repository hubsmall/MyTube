<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class youtubeVideoLoad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtubeVideo:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'load videos';

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
        $this->youTubeVideo->refresh();
    }
}
