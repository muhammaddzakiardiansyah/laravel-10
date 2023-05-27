<?php

namespace App\Http\Middleware;

use App\Models\Societie;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiToken = $request->input('token');

        if(!$apiToken) {
            return response()->json(['error' => 'token has required!']);
        }

        $user = Societie::where('login_tokens', '=', $apiToken)->first();
        if(!$user) {
            return response()->json(['error' => 'token is invalid!']);
        } else {
            return $next($request);
        }
        
    }
}
