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
        $url = 'http://localhost:8001/api/product?uri=' . urlencode($uri);
        // echo " hàm chuyển url   $url";
        $ch = curl_init();

        // Thêm token CSRF vào header request
        $headers = [
            'Content-Type: application/json'
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Thêm token CSRF vào header request
        $headers = [
            'Content-Type: application/json'
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        // print_r($response);
        // print_r($response);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return json_decode($response, true);
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
        $doitac = $this->getUserService('doitac/info/idtaikhoan=' . $_SESSION['id']);
        // print_r($iddoitac);
        $iddoitac = $doitac["id"];
        $uri = "khuyenmai/GetKhuyenMaiChuaSuDungByIDDoiTac/$iddoitac";
        $dataKhuyenMai = $this->getPurchaseService($uri);
        // Điều hướng đến view và template
        $VIEW = "./view/adminSuKien/taoSuKien.php";
        require("./template/template.php");
    }

    public function taoSuKienClick($uri)
    {
        $doitac = $this->getUserService('doitac/info/idtaikhoan=' . $_SESSION['id']);
        //lưu thông tin
        $iddoitac = $doitac["id"];
        // // echo 
        // $file = $_FILES['anhNenSuKien'];
        // $file_name_nen = $file['name'];
        // $file_tmp_nen = $file['tmp_name'];
        // $file_size_nen = $file['size'];
        // $file_type_nen = $file['type'];

        // // Đọc dữ liệu file ảnh
        // $file_data_nen = file_get_contents($file_tmp_nen);


        // $file2 = $_FILES['anhSoDoGhe'];
        // $file_name_2 = $file2['name'];
        // $file_tmp_2 = $file2['tmp_name'];
        // $file_size_2 = $file2['size'];
        // $file_type_2 = $file2['type'];

        // // Đọc dữ liệu file ảnh
        // $file_data_2 = file_get_contents($file_tmp_2);

        $nguoiThamGia = $_POST["nguoiThamGia"];
        $nguoiThamGiaArray = explode(", ", $nguoiThamGia);
        $data = [
            "anhNenSuKien" => "gsfdgfdg",
            "diaChi" => $_POST["soNhaTenDuong"] . ', ' . $_POST["PhuongXa"] . ', ' . $_POST["QuanHuyen"] . ', ' . $_POST["ThanhPho"] . ', ' . $_POST["QuocGia"],
            "thongTinSuKien" => $_POST["ThongTinSuKien"],
            "tenSuKien" => $_POST["TenSuKien"],
            "diaDiem" => [
                "noiToChuc" => $_POST["NoiToChuc"],
                "quocGia" => $_POST["QuocGia"],
                "thanhPho" => $_POST["ThanhPho"]
            ],
            "iddoiTac" => $iddoitac,
            "duongDan" => "khongcoduongdan",
            "loiCamOn" => $_POST["loiCamOn"],
            "theLoai" => $_POST["TheLoai"],
            "suatDienItemDTO" => [
                [
                    "thoiGianBatDau" => $_POST["date_bd"] . ' ' . $_POST["time_bd"],
                    "thoiGianKetThuc" => $_POST["date_kt"] . ' ' . $_POST["time_kt"],
                    "agenda" => [
                        $_POST["agendaList"]
                    ],
                    "loaiVe" => [
                        $_POST["loaiVeList"]

                    ],
                    "nguoiThamGia" => [
                        $nguoiThamGiaArray
                    ],
                    "nhanSu" => [
                        $_POST["NhanSuList"]
                    ]
                ]
            ],
            "anhSoDoGhe" => "gsdfghdsfht"
        ];
        echo "data";
        print_r($data);
        $answer = 0;
        $answer1 = $this->getProductService($uri, 'POST', $data);
        //thêm vô bảng khuyến mãi
        if ($answer1 == 1) {
            echo "vô khuyến mãi";
            $dataSuKien = $this->getProductService("sukien/getSuKienByIdDoiTac/$iddoitac");
            $idsuKienNew = count($dataSuKien);
            if (isset($_POST["khuyenMaiList"]) && $_POST["khuyenMaiList"] != null) {
                $idList = $_POST["khuyenMaiList"];
                $idArray = json_decode($idList, true);

                foreach ($idArray as $id) {
                    // echo "ID: " . $id . "<br>";
                    $urikm = "khuyenmai/UpdateIDSuKien/$id/$idsuKienNew";
                    $this->getPurchaseService($urikm, 'POST', $data);
                    $answer = 1;
                }
            }
        }
        // Điều hướng đến view và template
        $VIEW = "./view/adminSuKien/taoSuKien.php";
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

    public function getSuKien($uri)
    {

        $data = $this->getProductService($uri);
        $VIEW = "./view/khachHang/phanHoiSuKien.php";
        require("./template/template.php");
    }

    public function getdsVe($uri)
    {

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
        // echo $sukien;
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

    public function chiTietSuKien($portGateway, $idsuKien, $iddoiTac)
    {
        // Gọi đến API Gateway để lấy dữ liệu
        $sukien = $this->getProductService2("sukien/getSuKienByIDSuKien-IdDoiTac?IDSuKien=$idsuKien&IDDoiTac=$iddoiTac");
        $uri = "suatdien/getSuatDienByIdSuKien-IdDoiTac?IDSuKien=$idsuKien&IDDoiTac=$iddoiTac";
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
            // Gán các giá trị vào $sukien
            $sukien['thoiGianBatDau'] = date('d/m/Y H:i:s', $minStartTime);
            $sukien['thoiGianKetThuc'] = date('d/m/Y H:i:s', $maxEndTime);
        }
        // Điều hướng đến view và template
        $VIEW = "./view/chiTietSuKien.php";
        require("./template/template.php");
    }
    public function chonSuatDienLoaiVe($portGateway, $idsuKien, $iddoiTac)
    {
        // Gọi đến API Gateway để lấy dữ liệu
        $sukien = $this->getProductService2("sukien/getSuKienByIDSuKien-IdDoiTac?IDSuKien=$idsuKien&IDDoiTac=$iddoiTac");
        $uri = "suatdien/getSuatDienByIdSuKien-IdDoiTac?IDSuKien=$idsuKien&IDDoiTac=$iddoiTac";
        $suatdien = $this->getProductService2($uri);
        // Điều hướng đến view và template
        $VIEW = "./view/khachHang/chonSuatDienLoaiVe.php";
        require("./template/template.php");
    }

    public function chiTietVe($portGateway, $idVe, $idsuKien, $iddoiTac)
    {
        $_SESSION['id_nguoidung'] = 1;
        $idnguoidung = $_SESSION['id_nguoidung'];
        $uri = 'vedamua/getAllVeDaMuaByIdNguoiDung/' . $idnguoidung;
        // Gọi đến API Gateway để lấy dữ liệu
        $data = $this->getProductService($uri);
        $thongTinVe = [
            'idVe' => $idVe,
            'idsuKien' => $idsuKien,
            'iddoiTac' => $iddoiTac
        ];
        // Điều hướng đến view và template
        $VIEW = "./view/khachHang/chiTietVe.php";
        require("./template/template.php");
    }

    //     public function chiTietSuKien($portGateway, $idsuKien, $iddoiTac)
    //     {
    //         // Gọi đến API Gateway để lấy dữ liệu
    //         $sukien = $this->getProductService2("sukien/getSuKienByIDSuKien-IdDoiTac?IDSuKien=$idsuKien&IDDoiTac=$iddoiTac");
    //         $uri = "suatdien/getSuatDienByIdSuKien-IdDoiTac?IDSuKien=$idsuKien&IDDoiTac=$iddoiTac";
    //         $suatdien = $this->getProductService2($uri);
    //         $minStartTime = PHP_INT_MAX;
    //         $maxEndTime = 0;
    //         if (!$suatdien == null) {
    //             foreach ($suatdien['suatDienItemDTO'] as $item) {
    //                 // Chuyển đổi định dạng thời gian
    //                 $startTime = date_create_from_format('d/m/Y H:i:s', $item['thoiGianBatDau']);
    //                 $startTime = $startTime->getTimestamp();
    //                 $endTime = date_create_from_format('d/m/Y H:i:s', $item['thoiGianKetThuc']);
    //                 $endTime = $endTime->getTimestamp();

    //                 if ($startTime < $minStartTime) {
    //                     $minStartTime = $startTime;
    //                 }
    //                 if ($endTime > $maxEndTime) {
    //                     $maxEndTime = $endTime;
    //                 }
    //             }
    //             // Gán các giá trị vào $sukien
    //             $sukien['thoiGianBatDau'] = date('d/m/Y H:i:s', $minStartTime);
    //             $sukien['thoiGianKetThuc'] = date('d/m/Y H:i:s', $maxEndTime);
    //         }
    //         // Điều hướng đến view và template
    //         $VIEW = "./view/chiTietSuKien.php";
    //         require ("./template/template.php");
    //     }
    //     public function chonSuatDienLoaiVe($portGateway, $idsuKien, $iddoiTac)
    //     {
    //         // Gọi đến API Gateway để lấy dữ liệu
    //         $sukien = $this->getProductService2("sukien/getSuKienByIDSuKien-IdDoiTac?IDSuKien=$idsuKien&IDDoiTac=$iddoiTac");
    //         $uri = "suatdien/getSuatDienByIdSuKien-IdDoiTac?IDSuKien=$idsuKien&IDDoiTac=$iddoiTac";
    //         $suatdien = $this->getProductService2($uri);
    //         // Điều hướng đến view và template
    //         $VIEW = "./view/khachHang/chonSuatDienLoaiVe.php";
    //         require ("./template/template.php");
    //     }

    //     public function chiTietVe($portGateway, $idVe, $idsuKien, $iddoiTac)
    //     {
    //         $_SESSION['id_nguoidung'] = 1;
    //         $idnguoidung = $_SESSION['id_nguoidung'];
    //         $uri = 'vedamua/getAllVeDaMuaByIdNguoiDung/' . $idnguoidung;
    //         // Gọi đến API Gateway để lấy dữ liệu
    //         $data = $this->getProductService($uri);
    //         $thongTinVe = [
    //             'idVe' => $idVe,
    //             'idsuKien' => $idsuKien,
    //             'iddoiTac' => $iddoiTac
    //         ];
    //         // Điều hướng đến view và template
    //         $VIEW = "./view/khachHang/chiTietVe.php";
    //         require ("./template/template.php");
    //     }
    // }
}
