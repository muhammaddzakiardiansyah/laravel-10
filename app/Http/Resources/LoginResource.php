<?php

namespace App\Http\Resources;

use App\Models\Societie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $credentials = request()->only('id_card_number', 'password');
        $login = Societie::where($credentials)->first();
        $token = md5($login['id_card_number']);


        return [
            'id' => $this->id,
            'name' => $this->name,
            'born_date' => $this->born_date,
            'gander' => $this->gender,
            'address' => $this->address,
            'token' => $token,
            'regional' => $this->regional,
        ];
    }
}
