<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ConfirmOrder;

class Carts extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'product_id',
        'confirm_order_id',
        'amount',
        'is_ordered',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->hasMany(ConfirmOrder::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
