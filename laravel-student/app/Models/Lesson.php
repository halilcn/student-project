<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Uuid\Type\Integer;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lessons';
    protected $fillable = [
        'school_score_id', 'name', 'credit'
    ];

    public function score(): HasOne
    {
        return $this->hasOne(LessonScore::class);
    }


    // Deleting Relationship
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($lesson) {
            $lesson->score->delete();
        });
    }

}
