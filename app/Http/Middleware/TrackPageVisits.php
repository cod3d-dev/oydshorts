<?php

namespace App\Http\Middleware;

use App\Models\PageVisits;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        dd($request->path());
        $requestUrl = $request->path();
        if (!Str::startsWith($requestUrl, 'admin') && $requestUrl != 'visitas') {


        $ipAddress = request()->ip();
//        $location = geoip('8.8.8.8');
        Log::info('Page visited', [
            'url' => $request->fullUrl(),
            'ip' => $ipAddress,
            'agent' => request()->header('User-Agent'),
            'locations' => "{}",
        ]);

        PageVisits::create([
            'url' => $request->fullUrl(),
            'ip' => $ipAddress,
            'agent' => request()->header('User-Agent'),
            'locations' => "{}",
        ]);
        }

        return $next($request);
    }
}
