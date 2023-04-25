<?php

namespace App\Console\Commands;

use App\Services\MonoRateService;
use App\Services\NovaPoshtaService;
use Illuminate\Console\Command;

class Rate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(MonoRateService $service): void
    {
        $service->updateRate();
    }
}
