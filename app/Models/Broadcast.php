<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Broadcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
    ];

    public function recipients(): HasMany
    {
        return $this->hasMany(BroadcastRecipient::class);
    }
}
