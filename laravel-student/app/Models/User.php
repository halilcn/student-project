<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use phpDocumentor\Reflection\Types\String_;
use Ramsey\Uuid\Type\Integer;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTargets(): HasMany
    {
        return $this->hasMany(Target::class);
    }

    public function targets(): HasMany
    {
        return $this->getTargets()
            ->with('targetable', function (MorphTo $query) {
                $query->morphWith([
                    SchoolScore::class => ['lessons', 'lessons.score']
                ]);
            })
            ->orderByDesc('id');
    }

    public function profileActiveTargets(): HasMany
    {
        return $this->getTargets()
            ->with('targetable', function (MorphTo $query) {
                $query->morphWithCount([
                    SchoolScore::class => ['lessons']
                ]);
            })
            ->orderByDesc('id');
    }

    public function getLastTargets(): HasMany
    {
        return $this->hasMany(LastTarget::class);
    }

    public function lastTargets(): HasMany
    {
        return $this->getLastTargets()->with('lastTargetable')->orderByDesc('id');
    }

    public function profileLastTargets(): HasMany
    {
        return $this->lastTargets()->with('lastTargetable');
    }

    public function getCountTargets(): String
    {
        return $this->getTargets()->count() + $this->getLastTargets()->count();
    }

}
