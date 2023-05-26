<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Http\Resources\LoginResource;
use App\Models\Societie;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function authenticate() {
        $credentials = request()->only('id_card_number', 'password');

        $login = Societie::with('regional:id,province,district')->where($credentials)->first();

        $credentials = request()->only('id_card_number', 'password');
        $login = Societie::where($credentials)->first();
        $token = md5($login['id_card_number']);

        $user = Societie::where('id_card_number', '=', $login['id_card_number'])->first()->update(['login_tokens' => $token]);

        return response()->json($user);

        // if (!$login) {
        //     return response()->json(['error' => 'Invalid id_card_number or password!'], 401);
        // }

        // return ApiFormatter::createApi('200', new LoginResource($login));
    }

    public function logout() {
        return response()->json(['message' => 'success']);
    }
}
