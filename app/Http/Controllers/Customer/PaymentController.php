<?php


namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Services\Payment\Payment;

class PaymentController extends Controller{

    public function payment(){
        $payment = new Payment(PaymentMethod::PAYMENT_METHOD['VNPAY']);
        return $payment->handle();
    }

    public function paymentCallBack()
    {
        return 'done';
    }
}
