<?php

namespace App\Jobs;

use App\Models\City;
use App\Services\NovaPoshtaService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StartCityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(NovaPoshtaService $service): void
    {
        $cityCount = $service->getCities(1,0)['info']['totalCount'];

        for ($page = 1; $page < ($cityCount/ City::PER_PAGE) + 1; $page++) {
            dispatch(new CitiesJob($page, City::PER_PAGE));
        }
    }
}
