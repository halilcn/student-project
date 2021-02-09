<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class LastSchoolScore extends Model
{
    use HasFactory;

    protected $table = 'last_school_scores';

    protected $fillable = [
        'last_target_created_at', 'lessons_count', 'success_rate'
    ];

    public function lastTarget(): MorphOne
    {
        return $this->MorphOne(LastTarget::class, 'last_targetable');
    }
}
