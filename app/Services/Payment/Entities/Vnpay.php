<?php

namespace App\Services\Payment\Entities;

use function redirect;

class Vnpay{
    public $vnpUrl = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    public $vnpReturnUrl = "http://localhost:8000/vnpay_callback";
    public $vnp_TmnCode = "UDOPNWS1"; //Mã website tại VNPAY
    public $vnp_HashSecret = "EBAHADUGCOEWYXCMYZRMTMLSHGKNRPBN"; //Chuỗi bí mật
    public $vnp_TxnRef = 'OD55553333333444';
    public $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
    public $vnp_OrderType = 'billpayment';
    public $vnp_Amount = 10000000;
    public $vnp_Locale = 'vn';
    public $vnp_IpAddr = '127.0.0.1';

    public function handle()
    {
        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_Amount" => $this->vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $this->vnp_IpAddr,
            "vnp_Locale" => $this->vnp_Locale,
            "vnp_OrderInfo" => $this->vnp_OrderInfo,
            "vnp_OrderType" => $this->vnp_OrderType,
            "vnp_ReturnUrl" => $this->vnpReturnUrl,
            "vnp_TxnRef" => $this->vnp_TxnRef,
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . $key . "=" . $value;
            } else {
                $hashData .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnpUrl = $this->vnpUrl . "?" . $query;
        if (isset($this->vnp_HashSecret)) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashData);
            $vnpSecureHash = hash('sha256', $this->vnp_HashSecret . $hashData);
            $vnpUrl .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnpUrl);
    }
}
