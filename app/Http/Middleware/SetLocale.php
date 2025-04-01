<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // Получаем локаль из URL или сессии
        $locale = $request->segment(1);
        $availableLocales = ['en', 'ru'];

        if (!in_array($locale, $availableLocales)) {
            $locale = 'ru';
        }

        // Устанавливаем локаль
        App::setLocale($locale);
        Session::put('locale', $locale); // Записываем в сессию

        // === Автоматический редирект для правильного URL ===

        // 1. Если локаль `ru`, но в URL есть `/ru` → редирект на чистый URL
        if ($locale === 'ru' && $request->segment(1) === 'ru') {
//            return Redirect::to($this->removeFirstSegment($request));
        }

        return $next($request);
    }

    // Убирает первый сегмент из URL (используется для `ru`)
    private function removeFirstSegment(Request $request)
    {
        $segments = $request->segments();
        array_shift($segments); // Удаляем первый сегмент
        return '/' . implode('/', $segments);
    }
}
