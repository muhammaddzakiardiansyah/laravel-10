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

        Societie::where('id_card_number', '=', $login['id_card_number'])->first()->update(['login_tokens' => $token]);

        if (!$login) {
            return response()->json(['error' => 'Invalid id_card_number or password!'], 401);
        }

        request()->session()->regenerate();

        return ApiFormatter::createApi('200', new LoginResource($login));
    }

    public function logout() {
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return response()->json(['message' => 'success']);
    }
}
