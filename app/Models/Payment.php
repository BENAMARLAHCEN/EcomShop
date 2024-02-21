<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_id',
        'numero_serie',
        'quantity',
        'amount',
        'currency',
        'payment_status',
        'payment_method',
        'user_id',
    ];
}
