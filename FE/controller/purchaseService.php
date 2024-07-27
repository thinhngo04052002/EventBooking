<?php
require_once('productService.php');
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
    }
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

    public function getPurchaseService2($uri)
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



    public function chuanBiThanhToan($portGateway, $idsuKien, $iddoiTac, $idsuatDien, $veDaChon)
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
        // Chuyển chuỗi JSON thành mảng PHP
        $loaiVeDaChon = json_decode($veDaChon, true);
        $userController = new UserController();
        $taikhoan = $userController->getUserService2("taikhoan/search/userid=" . $_SESSION['id']);
        $email = $taikhoan['data']['email'];
        $nguoidung = $userController->getUserService2("nguoidung/info/userid=" . $_SESSION['id']);
        $sdt = $nguoidung['data']['sdt'];
        // Điều hướng đến view và template
        $VIEW = "./view/khachHang/chuanBiThanhToan.php";
        require("./template/template.php");
    }

    public function goiAPIThanhToan($portGateway, $orderId, $orderinfo, $idsuKien, $iddoiTac, $thanhTien, $makhuyenmai, $idtaikhoan, $danhSachVe)
    {
        // Chuẩn bị dữ liệu danh sách vé
        $dsv = json_decode($danhSachVe, true);
        $veArray = [];
        foreach ($dsv as $ve) {
            $veArray[] = [
                'idsuKien' => $idsuKien,
                'iddoiTac' => $iddoiTac,
                'idve' => $ve['id']
            ];
        }
        $data = [
            'orderId' => $orderId,
            'orderinfo' => $orderinfo,
            'amount' => $thanhTien,
            'makhuyenmai' => $makhuyenmai,
            'idtaikhoan' => $idtaikhoan,
            'danhSachVe' => $veArray
        ];
        $jdata = json_encode($data);
        // Gọi đến API Gateway để lấy dữ liệu
        $answer = $this->postPurchaseService("hoadon/goiAPIThanhToan", "POST", $data);
        if (isset($answer['error'])) {
            header('Location: index.php?action=home');
        }
        // $VIEW = "./view/trangChu.php";
        // require ("./template/template.php");
    }
}
