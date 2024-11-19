<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $fillable = [
        'cabinet_user_id',
        'access_token',
        'access_token_end_time',
        'refresh_token',
        'refresh_token_end_time',
    ];
}
