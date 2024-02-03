<?php

namespace App\Http\Middleware;

use App\Models\IpWhiteList;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WhiteList
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $ipExist = IpWhiteList::where('ip', $ip)->where('is_active', true)->first();
        if (!$ipExist) {
            return response()->json([
                'message' => "Unauthorization",
                'data' => []
            ], 401);
        }
        return $next($request);
    }
}
