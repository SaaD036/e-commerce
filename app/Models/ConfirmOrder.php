<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Carts;

class ConfirmOrder extends Model
{
    use HasFactory;

    protected $table = 'confirm_orders';

    public $fillable = [
        'user_id',
        'amount',
        'address',
        'message',
        'is_paid',
        'is_completed',
        'is_shipped',
        'is_seen'
    ];

    public function carts()
    {
        return $this->belongsTo(Carts::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function addCartToOrderObject($orders){
        foreach($orders as $order){
            $order->carts = Carts::with('product', 'product.category')->where('confirm_order_id', $order->id)->get();
        }

        return $orders;
    }
}
