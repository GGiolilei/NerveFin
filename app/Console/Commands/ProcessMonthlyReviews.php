<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:process-monthly-reviews')]
#[Description('Command description')]
class ProcessMonthlyReviews extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
