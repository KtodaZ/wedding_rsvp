<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class CheckAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authorziation = $request->header('Authorization');
        $apiKey = config('auth.ApiKey');

        if ($authorziation == $apiKey) {
            \Log::debug('Authenticated');

            return $next($request);
        }

        \Log::debug('Bad Authorization');

        return new JsonResponse('Bad Authorization');
    }
}
