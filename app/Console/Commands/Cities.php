<?php

namespace App\Console\Commands;

use App\Jobs\CitiesJob;
use App\Models\City;
use Illuminate\Console\Command;

class Cities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        for ($page = 1; $page < (City::COUNT / City::PER_PAGE) + 1; $page++) {
            dispatch(new CitiesJob($page));
        }
    }
}
