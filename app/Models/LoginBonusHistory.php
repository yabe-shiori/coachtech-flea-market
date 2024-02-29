<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginBonusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'points_awarded',
        'date_awarded'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
