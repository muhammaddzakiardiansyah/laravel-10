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

        if (!$login) {
            return response()->json(['error' => 'Invalid id_card_number or password!'], 401);
        }

        $token = md5($login['id_card_number']);

        // Lakukan tindakan setelah berhasil login, misalnya menyimpan token di sesi atau mengirimkan respons JSON.

        return ApiFormatter::createApi('200', new LoginResource($login));
    }
}
