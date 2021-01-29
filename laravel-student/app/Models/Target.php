<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\Relation;
use PhpParser\Node\Scalar\String_;

class Target extends Model
{
    use HasFactory;

    protected $table = 'targets';
    protected $fillable = [
        'user_id', 'target_type', 'target_id'
    ];

    // $cast date time not working :/
    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)->isoFormat('D MMMM Y');
    }

    public function target(): MorphTo
    {
        return $this->morphTo();
    }


}
