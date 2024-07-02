<?php
class ProductController
{
    public function getProductService($uri, $method = 'GET', $data = [])
    {

        $url = 'http://localhost:8001/product?uri=' . $uri;
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


    public function postDataToGateway($uri, $postData)
    {
        $ch = curl_init();
        $url = 'http://localhost:8001/product?uri=' . $uri;
        // Thiết lập các tùy chọn cho yêu cầu cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Thực thi yêu cầu cURL và lấy kết quả
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Lỗi khi thực hiện yêu cầu cURL: ' . curl_error($ch);
        }

        curl_close($ch);

        return $response;
    }
    public function getAllSuKien($uri)
    {
        // Gọi đến API Gateway để lấy dữ liệu
        $data = $this->getProductService($uri);

        // Điều hướng đến view và template
        $VIEW = "./view/trangchu.php";
        require("./template/template.php");
    }
    public function testTaoVe($portGateway)
    {
        $portGateway;
        // Điều hướng đến view và template
        $VIEW = "./view/adminSuKien/testTaoVe.php";
        require("./template/template.php");
    }

    public function testTaoVeClick($uri)
    {
        $data = [
            'idve' => $_REQUEST["idve"],
            'idloaiVe' => $_REQUEST["idloaiVe"],
            'idSuatDien' => $_REQUEST["idSuatDien"],
            'idDoiTac' => $_REQUEST["idDoiTac"],
            'trangThaiBan' => $_REQUEST["trangThaiBan"],
            'soSeri' => $_REQUEST["soSeri"],
            'trangThaiDung' => $_REQUEST["trangThaiDung"],
            'idsuKien' => $_REQUEST["idsuKien"]
        ];
        echo "hàm tạo vé  ";
        print_r($data);
        $answer = $this->getProductService($uri, 'POST', $data);

        // Điều hướng đến view và template
        $VIEW = "./view/adminSuKien/testTaoVe.php";
        require("./template/template.php");
    }
}
