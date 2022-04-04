<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class PaymentMethod extends Model{
    protected $table = 'payment_methods';
    protected $fillable = ['id', 'name'];
    const PAYMENT_METHOD = [
        'COD' => 1,
        'MOMO' => 2,
        'VNPAY' => 3
    ];
}
