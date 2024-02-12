<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'recipient_name',
        'postal_code',
        'address',
        'building_name',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

}
