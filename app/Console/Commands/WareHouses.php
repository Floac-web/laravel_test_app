<?php

namespace App\Console\Commands;

use App\Jobs\StartWarehouseJob;
use App\Jobs\WarehousesJob;
use App\Models\CityWarehouse;
use Illuminate\Console\Command;

class Warehouses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:warehouses';

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
        dispatch(new StartWarehouseJob());
    }
}
