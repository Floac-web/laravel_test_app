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
use Illuminate\Support\Facades\Http;

class CitiesJob implements ShouldQueue
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
        $cities = $service->getCities($this->page);

        if ($cities) {
            $service->updateCities($cities);

            // if (count($cities)) {
            //     dispatch(new self($this->page + 1));
            // }
        }
    }
}
