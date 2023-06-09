<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Regional;

class Societie extends Model
{
    use HasFactory;

    protected $table = 'societies';

    protected $fillable = ['login_tokens'];

    
    public function regional(): BelongsTo
    {
        return $this->belongsTo(Regional::class, 'regional_id', 'id');
    }
}
