<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'product_id',
        'amount',
        'address',
        'message',
        'is_paid',
        'is_completed',
        'is_shipped',
        'is_seen'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
