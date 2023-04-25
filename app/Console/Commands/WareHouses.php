<?php

namespace App\Console\Commands;

use App\Jobs\WareHousesJob;
use App\Models\CityWarehouse;
use Illuminate\Console\Command;

class WareHouses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ware-houses';

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
        for ($page = 1; $page < (CityWarehouse::COUNT / CityWarehouse::PER_PAGE) + 1; $page++) {
            dispatch(new WareHousesJob($page));
        }
    }
}
