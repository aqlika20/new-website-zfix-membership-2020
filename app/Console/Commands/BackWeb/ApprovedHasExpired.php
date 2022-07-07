<?php

namespace App\Console\Commands\BackWeb;

use App\BackWeb\Process\Process;
use Illuminate\Console\Command;
use Carbon\Carbon;

class ApprovedHasExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:ApprovedHasExpired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if Approved Has Expired or not';

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
        $approved = Process::where('status', 1)->get();

        foreach ($approved as $process) {
            if ($process['expired_at'] <= Carbon::now()) {
                $data = Process::where('id', $process['id'])->first();
                $data->status = -2;
                $data->save();
            }
        }
        // return 0;

    }
}
