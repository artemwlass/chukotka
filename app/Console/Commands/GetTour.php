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
//        $url = 'https://atom-s.com/api/v2/39367-booking-system/search.json'; // Укажи реальный URL API
        $url = 'http://www.atom-s.com/api/v2/17baa4f6-ce6e-4ae6-b97c-42697b0ee9d6-de28ea94181ca693ef3fb39384043def/search.json'; // Укажи реальный URL API

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
