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

        $societie = Societie::all();
        $md5 = md5($societie['id_card_number']);
        return response()->json($md5);
        //$validate = Societie::where('id_card_number', $apiToken);


        // if($validate) {
        //     return $next($request);
        // } else {
        //     return response()->json(['message' => 'token is failed']);
        // }
        
    }
}
