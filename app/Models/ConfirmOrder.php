<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Carts;
use App\Models\Payment;

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

    public function carts(){
        return $this->hasMany(Carts::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }

    public static function countTotalPayment($orders){
        $totalPayment = 0;

        foreach($orders as $order){
            $totalPayment = $totalPayment + $order->amount;
        }

        return $totalPayment;
    }
}
