<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class LastTarget extends Model
{
    use HasFactory;

    protected $table = 'last_targets';
    protected $fillable = [
        'user_id', 'last_targetable_type', 'last_targetable_id'
    ];

    public function lastTargetable(): MorphTo
    {
        return $this->morphTo();
    }
}
