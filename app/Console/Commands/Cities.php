<?php

namespace App\Console\Commands;

use App\Jobs\CitiesJob;
use App\Jobs\StartCityJob;
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
        dispatch(new StartCityJob());
    }
}
