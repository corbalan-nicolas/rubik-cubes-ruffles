<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Raffle extends Model
{
    public function tickets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function sponsor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'sponsor_id');
    }

    public function banners(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Banner::class);
    }

    static public function currentRaffle(): ?\Illuminate\Database\Eloquent\Model
    {
        return self::with(['banners' => function ($query) {
            $query->orderBy('position', 'ASC');
        }])
            ->where('start_date', '<=', Date::now())
            ->where('end_date', '>=', Date::now())
            ->first();
    }
}
