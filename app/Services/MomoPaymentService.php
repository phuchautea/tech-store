<?php

namespace App\Services;

use App\Interfaces\IMomoPaymentService;

class MomoPaymentService implements IMomoPaymentService
{

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public function process($amount)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = env('MOMO_partnerCode');
        $accessKey = env('MOMO_accessKey');
        $secretKey = env('MOMO_secretKey');
        $orderInfo = "Thanh toán qua MoMo";
        $orderId = time() . "";
        $redirectUrl = env('MOMO_redirectUrl');
        $ipnUrl = env('MOMO_ipnUrl');
        $extraData = "";

        $requestId = time() . "";
        $requestType = "captureWallet";
        $extraData = "";
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            'storeId' => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = self::execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);
        if($jsonResult['resultCode'] == 0) {
            return redirect($jsonResult['payUrl']);
        } else {
            return redirect()->back();
        }
    }

}
