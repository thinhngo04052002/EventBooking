<?php
class CrmController
{
    public function getCRMService($uri, $method = 'GET', $data = [])
    {

        $url = 'http://localhost:8001/crm?uri=' . $uri;
        echo " hàm chuyển url   $url";
        $ch = curl_init();

        // Thêm token CSRF vào header request
        $headers = [
            'Content-Type: application/json'
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Nếu là phương thức POST
        if ($method == 'POST') {
            echo " method   $method";
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        print_r($response);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return json_decode($response, true);
    }
    public function danhGia($portGateway)
    {
        $portGateway;
        // Điều hướng đến view và template
        $VIEW = "./view/khachHang/phanHoiSuKien.php";
        require("./template/template.php");
    }

    public function filterSuKienCuaKH($portGateway)
    {
        $portGateway;
        // Điều hướng đến view và template
        $VIEW = "./view/khachHang/phanHoiSuKien.php";
        require("./template/template.php");
    }
}