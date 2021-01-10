<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\Relation;

class Target extends Model
{
    use HasFactory;

    protected $table = 'targets';
    protected $fillable = [
        'user_id', 'target_type', 'target_id'
    ];

    public function target(): MorphTo
    {
        return $this->morphTo();
    }


}
