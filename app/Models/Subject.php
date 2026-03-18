<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    protected $fillable = ['name', 'teacher'];

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function average(): float
    {
        return round($this->activities()->avg('grade') ?? 0, 1);
    }
}