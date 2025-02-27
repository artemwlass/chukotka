<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetTour extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-tour';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = 'https://atom-s.com/api/v2/df152aada6a941b8a7769d1ceb1f4564-booking-system/search.json'; // Укажи реальный URL API

        try {
            $response = Http::get($url);

            if ($response->successful()) {
                $data = $response->json();

                // Логируем ответ
                Log::info('Booking Data:', $data);

                $this->info('Data fetched and logged successfully.');
            } else {
                Log::error('Failed to fetch data. Status: ' . $response->status());
                $this->error('Failed to fetch data. Check logs for details.');
            }
        } catch (\Exception $e) {
            Log::error('Error fetching booking data: ' . $e->getMessage());
            $this->error('An error occurred while fetching data. Check logs.');
        }
    }
}
