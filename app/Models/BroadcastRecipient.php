<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BroadcastRecipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'broadcast_id',
        'phone',
        'message_api_id',
        'status',
    ];
}
