<?php

namespace App\Jobs;

use App\Models\CityWarehouse;
use App\Services\NovaPoshtaService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class WareHousesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $page;

    /**
     * Create a new job instance.
     */
    public function __construct($page)
    {
        $this->page = $page;
    }

    /**
     * Execute the job.
     */
    public function handle(NovaPoshtaService $service): void
    {
        $wareHouses = $service->getWareHouses($this->page);

        if ($wareHouses) {
            $service->updateWareHouses($wareHouses);
        }
    }
}
