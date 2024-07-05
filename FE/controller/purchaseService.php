<?php
require_once ('productService.php');
class PurchaseController
{
    public function getPurchaseService($uri, $method = 'GET', $data = [])
    {

        $url = 'http://localhost:8001/purchase?uri=' . $uri;
        // echo " hàm chuyển url   $url";
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
            // echo " method   $method";
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        // print_r($response);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return json_decode($response, true);
    public function postPurchaseService($uri, $method = 'POST', $data = [])
    {

        $url = 'http://localhost:8001/purchase?uri=' . $uri;
        // echo " hàm chuyển url   $url";
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
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return json_decode($response, true);
    }

    public function getPurchaseService($uri)
    {
        $url = 'http://localhost:8001/purchase?uri=' . urlencode($uri);
        // echo " hàm chuyển url   $url";
        $ch = curl_init();

        // Thêm token CSRF vào header request
        $headers = [
            'Content-Type: application/json'
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return json_decode($response, true);
    }



    public function chuanBiThanhToan($portGateway, $idsuKien, $iddoiTac)
    {
        $productController = new ProductController();
        // Gọi đến API Gateway để lấy dữ liệu
        $sukien = $productController->getProductService2("sukien/getSuKienByIDSuKien-IdDoiTac?IDSuKien=$idsuKien&IDDoiTac=$iddoiTac");
        $uri = "suatdien/getSuatDienByIdSuKien-IdDoiTac?IDSuKien=$idsuKien&IDDoiTac=$iddoiTac";
        $suatdien = $productController->getProductService2($uri);
        $minStartTime = PHP_INT_MAX;
        $maxEndTime = 0;
        if (!$suatdien == null) {
            foreach ($suatdien['suatDienItemDTO'] as $item) {
                // Chuyển đổi định dạng thời gian
                $startTime = date_create_from_format('d/m/Y H:i:s', $item['thoiGianBatDau']);
                $startTime = $startTime->getTimestamp();
                $endTime = date_create_from_format('d/m/Y H:i:s', $item['thoiGianKetThuc']);
                $endTime = $endTime->getTimestamp();

                if ($startTime < $minStartTime) {
                    $minStartTime = $startTime;
                }
                if ($endTime > $maxEndTime) {
                    $maxEndTime = $endTime;
                }
            }
            // Gán các giá trị vào $sukien
            $sukien['thoiGianBatDau'] = date('d/m/Y H:i:s', $minStartTime);
            $sukien['thoiGianKetThuc'] = date('d/m/Y H:i:s', $maxEndTime);
        }
        // Điều hướng đến view và template
        $VIEW = "./view/khachHang/chuanBiThanhToan.php";
        require ("./template/template.php");
    }

    public function goiAPIThanhToan($portGateway, $orderId, $orderinfo, $thanhTien, $makhuyenmai, $idtaikhoan, $danhSachVe)
    {
        $data = [
            'orderId' => $orderId,
            'orderinfo' => $orderinfo,
            'thanhTien' => $thanhTien,
            'makhuyenmai' => $makhuyenmai,
            'idtaikhoan' => $idtaikhoan,
            'danhSachVe' => [
                'idve' => 1,
                'idsuKien' => 1,
                'iddoiTac' => 1
            ]
        ];

        // Gọi đến API Gateway để lấy dữ liệu
        $sukien = $this->postPurchaseService("hoadon/goiAPIThanhToan", $data);

        $VIEW = "./view/trangChu.php";
        require ("./template/template.php");
    }
}