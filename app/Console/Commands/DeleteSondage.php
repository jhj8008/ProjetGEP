<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Poll;
use Carbon\Carbon;

class DeleteSondage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sondage_delete:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that deletes all the polls if they reach their deadlines';

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
        $polls = Poll::where('deadline', '<', Carbon::now()->toDateTimeString())->get();
        foreach($polls as $poll){
            $poll->candidates()->delete();
            $poll->employes()->detach();
            $poll->delete();
        }
        //return 0;
    }
}
