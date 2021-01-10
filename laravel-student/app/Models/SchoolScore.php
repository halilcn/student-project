<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Json;
use Ramsey\Uuid\Type\Integer;

class SchoolScore extends Model
{
    use HasFactory;

    protected $table = 'school_scores';

    protected $fillable = [
        'first_exam_percent', 'second_exam_percent', 'total_average'
    ];

    public function lessons(): HasMany
    {
        return $this->HasMany(Lesson::class);
    }

    public function targets(): MorphMany
    {
        return $this->morphMany(Target::class, 'target');
    }


}
