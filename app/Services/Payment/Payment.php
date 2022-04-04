<?php
namespace App\Services\Payment;

use App\Models\PaymentMethod;
use App\Services\Payment\Entities\Cod;
use App\Services\Payment\Entities\Momo;
use App\Services\Payment\Entities\Vnpay;

class Payment{

    protected $paymentMethodId;
    protected $instancePayment;

    public function __construct($paymentMethodId)
    {
        $this->paymentMethodId = $paymentMethodId;
    }

    public function handle(){
        switch ($this->paymentMethodId){
            case PaymentMethod::PAYMENT_METHOD['COD']:
                $this->instancePayment =  new Cod();
                break;
            case PaymentMethod::PAYMENT_METHOD['MOMO']:
                $this->instancePayment = new Momo();
                break;

            case PaymentMethod::PAYMENT_METHOD['VNPAY']:
                $this->instancePayment = new Vnpay();
                break;
        }

        return $this->instancePayment->handle();
    }
}
