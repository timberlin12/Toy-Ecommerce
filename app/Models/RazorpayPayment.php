<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RazorpayPayment extends Model
{

    protected $fillable = [
        'order_id',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'payment_status',
        'response_payload',
    ];

    /**
     * Get the order associated with this payment.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
