<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class Analytic
{
    public function handle(Request $request, Closure $next)
    {
        $agent = new Agent();
        $ip = $request->ip();

        // Проверяем, есть ли IP в базе
        $existingGeo = DB::table('analytics')
            ->where('ip', $ip)
            ->select('country', 'region', 'city')
            ->first();

        if ($existingGeo) {
            // Берем данные из базы
            $country = $existingGeo->country;
            $region = $existingGeo->region;
            $city = $existingGeo->city;
        } else {
            // Запрашиваем данные, если IP новый
            $geo = $this->ip2Location($ip);
            $country = $geo['country_name'] ?? 'Unknown';
            $region = $geo['region_name'] ?? 'Unknown';
            $city = $geo['city'] ?? 'Unknown';
        }

        // Записываем переход в БД
        \App\Models\Analytic::create([
            'ip' => $ip,
            'country' => $country,
            'region' => $region,
            'city' => $city,
            'user_agent' => $request->header('User-Agent'),
            'url' => $request->fullUrl(),
            'referrer' => $request->header('referer'),
            'device' => $this->getDeviceType($agent),
            'platform' => $agent->platform() ?? 'Unknown',
            'browser' => $agent->browser() ?? 'Unknown',
        ]);

        return $next($request);
    }

    /**
     * Определение типа устройства (ПК, планшет, телефон)
     */
    private function getDeviceType(Agent $agent): string
    {
        if ($agent->isMobile()) {
            return 'mobile';
        } elseif ($agent->isTablet()) {
            return 'tablet';
        }
        return 'desktop';
    }

    /**
     * Получение геолокации по IP
     */
    private function ip2Location(string $ip): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://iplocation.com/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => ['ip' => $ip],
            CURLOPT_HTTPHEADER => [
                'User-Agent: Mozilla/5.0 (Linux; Android 12.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Mobile Safari/537.36',
                'Accept: */*',
                'Connection: keep-alive',
            ],
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlError = curl_error($curl);
        curl_close($curl);

        if ($httpCode !== 200 || empty($response)) {
            Log::error("Ошибка запроса к IP геолокации: HTTP {$httpCode}, cURL Error: {$curlError}");
            return [
                'country_name' => 'Unknown',
                'region_name' => 'Unknown',
                'city' => 'Unknown',
            ];
        }

        $geoData = json_decode($response, true);

        if (!is_array($geoData) || !isset($geoData['country_name'])) {
            Log::error("Ошибка декодирования геолокации IP: {$ip}, Ответ: " . $response);
            return [
                'country_name' => 'Unknown',
                'region_name' => 'Unknown',
                'city' => 'Unknown',
            ];
        }

        return $geoData;
    }
}
