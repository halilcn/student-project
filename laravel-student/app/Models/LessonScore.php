<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonScore extends Model
{
    use HasFactory;

    protected $table = 'lessons_scores';
    protected $fillable = [
        'lesson_id', 'first_exam', 'second_exam', 'average', 'character'
    ];

}
