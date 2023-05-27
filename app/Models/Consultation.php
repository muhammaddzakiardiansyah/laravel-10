<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Medical;
use App\Models\Societie;

class Consultation extends Model
{
    use HasFactory;

    protected $table = 'consultations';
    protected $fillable = [
        'disease_history', 'current_symptoms'
    ];

    /**
     * Get the user that owns the Consultation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Medical::class, 'doctor_id', 'id');
    }

    /**
     * Get the user that owns the Consultation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function society(): BelongsTo
    {
        return $this->belongsTo(Societie::class, 'society_id', 'id');
    }
}
