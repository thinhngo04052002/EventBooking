<?php
require_once ("sendUrlthanhtoan.php");
class callMoMoAPI
{
    public function processPostData($data)
    {
        // Validate dữ liệu
        $validatedData = $this->validatePostData($data);

        // $tenncc = NhaCungCapModel::getTenNhaCungCap($_REQUEST["mancc"]);
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        //Thông tin của 1 đối tác Momo, đây là thông tin của tài khoản test
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = $validatedData['orderInfo'];
        //Tính toán lại số tiền cần thanh toán, trừ đi chiết khấu khuyến mãi
        $amount = $validatedData['amount'];
        $redirectUrl = "http://localhost/php-practice/UDPT_API/index.php?action=xuLyThanhToanThanhCong&masp=";
        // $masp . "&menhGia=" . $_REQUEST["menhGia"] . "&emailNhanThe=" . $_REQUEST["emailNhanThe"];
        $ipnUrl = "http://napthe.great-site.net/08_ThanhToanDienTuAPI/";
        $extraData = "";
        $orderId = $validatedData['orderId']; // Mã đơn hàng
        $extraData = $validatedData['extraData'];

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
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
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        // $jsonResult['payUrl'] là url giao diện thanh toán
        // return $jsonResult;

        $controller = new sendUrlthanhtoan($jsonResult);
        $controller->sendUrlthanhtoan($jsonResult);
    }

    /**
     * Validate dữ liệu POST
     *
     * @param array $data
     * @return array
     */
    protected function validatePostData($data)
    {
        // Implement your validation logic here
        return $data;
    }

    //Gửi POST request đến endpoint của MoMo
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //Show error if exist
        if ($result === false) {
            $error_msg = curl_error($ch);
            echo "Curl error: " . $error_msg;
        }
        //close connection
        curl_close($ch);
        return $result;
    }
}