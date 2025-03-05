<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Analytic
{
    public function handle(Request $request, Closure $next)
    {
        $agent = new Agent();
        $geo = $this->ip2Location($request->ip());

        // Проверяем, есть ли данные о геолокации, иначе ставим "Unknown"
        $country = $geo['country_name'] ?? 'Unknown';
        $region = $geo['region_name'] ?? 'Unknown';
        $city = $geo['city'] ?? 'Unknown';

        // Запись в БД только если IP не дублируется за последние 5 минут (защита от спама)
        $recentVisit = DB::table('analytics')
            ->where('ip', $request->ip())
            ->where('created_at', '>=', now()->subMinutes(5))
            ->exists();

        if (!$recentVisit) {
            \App\Models\Analytic::create([
                'ip' => $request->ip(),
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
        }

        return $next($request);
    }

    private function getDeviceType(Agent $agent)
    {
        if ($agent->isMobile()) {
            return 'mobile';
        } elseif ($agent->isTablet()) {
            return 'tablet';
        } else {
            return 'desktop';
        }
    }

    private function ip2Location(string $ip): \Illuminate\Support\Collection
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://iplocation.com/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 5, // Ограничение времени запроса
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
            return collect([
                'country_name' => null,
                'region_name' => null,
                'city' => null,
            ]);
        }

        $geoData = json_decode($response, true);

        if (!is_array($geoData) || !isset($geoData['country_name'])) {
            Log::error("Ошибка декодирования геолокации IP: {$ip}, Ответ: " . $response);
            return collect([
                'country_name' => null,
                'region_name' => null,
                'city' => null,
            ]);
        }

        return collect($geoData);
    }
}
