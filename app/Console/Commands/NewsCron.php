<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use DB;
class NewsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
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
     * @return int
     */
    public function handle()
    {
        info("Cron Job running at ". now());
        $news =News::whereDate( 'created_at', '<=', now()->subDays(14))->delete();
    }
}
