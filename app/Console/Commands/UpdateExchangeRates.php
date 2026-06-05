<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateExchangeRates extends Command
{
    protected $signature = 'rates:update';
    protected $description = 'Update exchange rates daily';

    public function handle()
    {
        \App\Services\ExchangeRateService::updateRates();

        $this->info('Exchange rates updated successfully');
    }
}
