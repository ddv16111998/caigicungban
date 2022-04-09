<?php
namespace Modules\Payment\Services;

use App\Models\PaymentMethod;
use Modules\Payment\Services\Entities\Contracts\CodInterface;
use Modules\Payment\Services\Entities\Contracts\MomoInterface;
use Modules\Payment\Services\Entities\Contracts\PaymentInterface;
use Modules\Payment\Services\Entities\Contracts\VnpayInterface;

class Payment implements PaymentInterface {

    protected $paymentMethodId;
    protected $instancePayment;
    protected $cod;
    protected $momo;
    protected $vnpay;

    public function __construct($paymentMethodId)
    {
        $this->cod = app()->make(CodInterface::class);
        $this->momo = app()->make(MomoInterface::class);
        $this->vnpay = app()->make(VnpayInterface::class);
        $this->paymentMethodId = $paymentMethodId;
    }

    public function handle(){
        switch ($this->paymentMethodId){
            case PaymentMethod::PAYMENT_METHOD['COD']:
                $this->instancePayment = $this->cod;
                break;
            case PaymentMethod::PAYMENT_METHOD['MOMO']:
                $this->instancePayment = $this->momo;
                break;

            case PaymentMethod::PAYMENT_METHOD['VNPAY']:
                $this->instancePayment = $this->vnpay;
                break;
        }

        return $this->instancePayment->handle();
    }
}
