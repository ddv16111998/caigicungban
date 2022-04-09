<?php


namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\Payment\Entities\Contracts\PaymentInterface;

class PaymentController extends Controller{

    public function payment(PaymentInterface $payment){
        return $payment->handle();
    }

    public function paymentCallBack()
    {
        return 'done';
    }
}
