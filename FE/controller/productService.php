<?php
class ProductController
{
    public function getProductService($uri, $method = 'GET', $data = [])
    {

        $url = 'http://localhost:8001/api/product?uri=' . $uri;
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

    public function getProductService2($uri)
    {
        $url = 'http://localhost:8001/api/product?uri=' . urlencode($uri);
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
        // print_r($response);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return json_decode($response, true);
    }
    public function getUserService($uri, $method = 'GET', $data = [])
    {

        $url = 'http://localhost:8001/user?uri=' . $uri;
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
        // print_r($response);
        if (curl_errno($ch)) {
            printf($response);
        }
        curl_close($ch);


        return json_decode($response, true);
    }
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
    public function taoSuKien()
    {
        $iddoitac = $this->getUserService('doitac/info/idtaikhoan=' . $_SESSION['id']);
        $uri = "khuyenmai/GetKhuyenMaiChuaSuDungByIDDoiTac/$iddoitac";
        $dataKhuyenMai = $this->getPurchaseService($uri);
        // Điều hướng đến view và template
        $VIEW = "./view/adminSuKien/taoSuKien.php";
        require("./template/template.php");
    }

    public function taoSuKienClick($uri)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        //lưu thông tin
        $_SESSION["eventImageInput"] = $_FILES['eventImageInput'];
        $_SESSION["TenSuKien"] = $_POST["TenSuKien"];
        $_SESSION["TheLoai"] = $_POST["TheLoai"];
        $_SESSION["QuocGia"] = $_POST["QuocGia"];
        $_SESSION["ThanhPho"] = $_POST["ThanhPho"];
        $_SESSION["DiaChi"] = $_POST["soNhaTenDuong"] . ', ' . $_POST["PhuongXa"] . ', ' . $_POST["QuanHuyen"] . ', ' . $_POST["ThanhPho"] . ', ' . $_POST["QuocGia"];
        $_SESSION["NoiToChuc"] = $_POST["NoiToChuc"];
        $_SESSION["ThongTinSuKien"] = $_POST["ThongTinSuKien"];

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
        $answer = $this->getProductService($uri, 'POST', $data);

        // Điều hướng đến view và template
        $VIEW = "./view/adminSuKien/testTaoVe.php";
        require("./template/template.php");
        // Điều hướng đến view và template
        $VIEW = "./view/adminSuKien/taoSuKien2.php";
        require("./template/template.php");
    }


    public function quanLySuKien()
    {
        // Điều hướng đến view và template
        $VIEW = "./view/adminSuKien/quanLySuKien.php";
        require("./template/template.php");
    }

    public function getAllSuKien($uri)
    {
        // Gọi đến API Gateway để lấy dữ liệu
        $data = $this->getProductService($uri);

        // Điều hướng đến view và template
        $VIEW = "./view/trangchu.php";
        require("./template/template.php");
    }

    public function getSuKien($uri) {
         
        $data = $this->getProductService($uri);
        $VIEW = "./view/khachHang/phanHoiSuKien.php";
        require("./template/template.php");
    }

    public function getdsVe($uri) {
         
        $data = $this->getProductService($uri);
        $VIEW = "./view/khachHang/xemDSVe.php";
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
        // echo "hàm tạo vé  ";
        // print_r($data);
        $answer = $this->getProductService($uri, 'POST', $data);

        // Điều hướng đến view và template
        $VIEW = "./view/adminSuKien/testTaoVe.php";
        require("./template/template.php");
    }
    public function getAllSuKienSuatDien()
    {
        // Gọi đến API Gateway để lấy dữ liệu
        $sukien = $this->getProductService("sukien/getAllSuKien");
        $suatDien = [];
        foreach ($sukien as &$sk) {
            $uri = "suatdien/getSuatDienByIdSuKien-IdDoiTac?IDSuKien=" . $sk['idsuKien'] . "&IDDoiTac=" . $sk['iddoiTac'];
            $suatdien = $this->getProductService2($uri);

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
                // Gán các giá trị vào mảng $sukien
                $sk['thoiGianBatDau'] = date('d/m/Y H:i:s', $minStartTime);
                $sk['thoiGianKetThuc'] = date('d/m/Y H:i:s', $maxEndTime);
            }
        }
        // Điều hướng đến view và template
        $VIEW = "./view/trangchu.php";
        require("./template/template.php");
    }
}
