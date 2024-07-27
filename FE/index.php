<?php

session_start();

require_once("./controller/userService.php");
require_once("./controller/crmService.php");
require_once("./controller/logService.php");
require_once("./controller/productService.php");
require_once("./controller/purchaseService.php");
require_once("./controller/userService.php");
require_once("./controller/crmService.php");
require_once("./controller/logService.php");
require_once("./controller/productService.php");
require_once("./controller/purchaseService.php");

$portGateway = 8001;

$action = "home";
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "home";
// $action = "home";
// $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "home";


switch ($action) {
    case "dangNhap":
        $uri = 'taikhoan/login';
        $uri = 'taikhoan/login';
        $controller = new UserController();
        $controller->dangNhap($uri);
        break;

    case "logout":
        $controller = new UserController();
        $controller->logOut();
        break;
    case "dangKy":
        $uri = 'taikhoan/register';
        $uri = 'taikhoan/register';
        $controller = new UserController();
        $controller->dangKy($uri);
        break;
        //khách hàng
    case "userProfile":
        $uri = 'nguoidung/info/userid=';
        $controller = new UserController();
        $controller->thongtinKhachHang($uri);
        break;
    case "danhGia":
        if (isset($_SESSION['id'])) {
            $idNguoiDung = $_SESSION['id'];
            $uri = 'vedamua/getAllVeDaMuaByIdNguoiDung/' . $idNguoiDung;
            $controller = new ProductController();
            $controller->getSuKien($uri);
        } else {
            // Xử lý trường hợp người dùng chưa đăng nhập
            echo "Vui lòng đăng nhập để xem thông tin vé.";
        }
        break;

    case "danhGia1":
        if (isset($_GET['idsk'])) {
            $idsk = $_GET['idsk'];
            $uri = 'get_danhgia_by_idsk/?idsk=' . $idsk;
            $controller = new CrmController();
            $controller->danhGia1($uri);
        } else {
            // Handle the case where idsk is not set
            echo "ID sự kiện không hợp lệ.";
        }
        break;
    case 'createProfile':
        $uri = "nguoidung/create";
        $controller = new UserController();
        $controller->createProfile($uri);
        break;
    case 'edit_profile':
        $uri = "nguoidung/update/id=" . $_SESSION['id_nguoidung'];
        $controller = new UserController();
        $controller->editProfile($uri);
        break;
    case 'editDoanhNghiep':
        $uri = "doitac/update/id=" . $_SESSION['idDoitac'];
        $controller = new UserController();
        $controller->editDoanhNghiep($uri);
        break;



    case "dsVe":
        if (isset($_SESSION['id'])) {
            $idNguoiDung = $_SESSION['id'];
            $uri = 'vedamua/getAllVeDaMuaByIdNguoiDung/' . $idNguoiDung;
            $controller = new ProductController();
            $controller->getdsVe($uri);
        } else {
            // Xử lý trường hợp người dùng chưa đăng nhập
            echo "Vui lòng đăng nhập để xem thông tin vé.";
        }
        break;

    case "submitDanhGia":
        $uri = 'create_danhgia/';
        $controller = new CrmController();
        $controller->danhGiaSK($uri);
        break;

        //admin sự kiện


    case "danhGia1":
        if (isset($_GET['idsk'])) {
            $idsk = $_GET['idsk'];
            $uri = 'get_danhgia_by_idsk/?idsk=' . $idsk;
            $controller = new CrmController();
            $controller->danhGia1($uri);
        } else {
            // Handle the case where idsk is not set
            echo "ID sự kiện không hợp lệ.";
        }
        break;
    case 'createProfile':
        $uri = "nguoidung/create";
        $controller = new UserController();
        $controller->createProfile($uri);
        break;
    case 'edit_profile':
        $uri = "nguoidung/update/id=" . $_SESSION['id_nguoidung'];
        $controller = new UserController();
        $controller->editProfile($uri);
    case 'editDoanhNghiep':
        $uri = "doitac/update/id=" . $_SESSION['idDoitac'];
        $controller = new UserController();
        $controller->editDoanhNghiep($uri);



    case "dsVe":
        if (isset($_SESSION['id'])) {
            $idNguoiDung = $_SESSION['id'];
            $uri = 'vedamua/getAllVeDaMuaByIdNguoiDung/' . $idNguoiDung;
            $controller = new ProductController();
            $controller->getdsVe($uri);
        } else {
            // Xử lý trường hợp người dùng chưa đăng nhập
            echo "Vui lòng đăng nhập để xem thông tin vé.";
        }
        break;

    case "submitDanhGia":
        $uri = 'create_danhgia/';
        $controller = new CrmController();
        $controller->danhGiaSK($uri);
        break;

        //admin sự kiện
    case "taoSuKien":
        $controller = new ProductController();
        $controller->taoSuKien();
        break;

    case "taoSuKienClick":
        $controller = new ProductController();
        $uri = "sukien/themSuKien";
        $controller->taoSuKienClick($uri);
        break;
        // case "dangKyDoiTac":
        //     $controller = new UserController();
        //     $controller->dangKyDoiTac($portGateway);
        //     break;
        // case "dangKyDoiTac":
        //     $controller = new UserController();
        //     $controller->dangKyDoiTac($portGateway);
        //     break;
    case "thongTinDoanhNghiep":
        $uri = 'doitac/info/id=';
        $controller = new UserController();
        $controller->thongTinDoanhNghiep($uri);
        break;
    case 'createDoiTac':
        $uri = "doitac/create";
        $controller = new UserController();
        $controller->createDoiTac($uri);
        break;

    case "thongTinDoanhNghiepClick":
        $controller = new UserController();
        $uri = "doitac/create";
        $controller->thongTinDoanhNghiepClick($uri);
        break;

    case "home":
        $controller = new ProductController();
        $controller->getAllSuKienSuatDien();
        break;
        //post qua body
    case "testTaoVe":
        $controller = new ProductController();
        $controller->testTaoVe($portGateway);
        break;

    case "testTaoVeClick":
        $controller = new ProductController();
        $uri = "ve/postVe";
        $controller->testTaoVeClick($uri);
        break;
        //post qua tham số thì cứ chỉnh url cho khớp giống swagger
    case "chiTietSuKien":
        $controller = new ProductController();
        $idsuKien = $_REQUEST['idsuKien'];
        $iddoiTac = $_REQUEST['iddoiTac'];
        $controller->chiTietSuKien($portGateway, $idsuKien, $iddoiTac);
        break;
    case "chonSuatDienLoaiVe":
        $controller = new ProductController();
        $idsuKien = $_REQUEST['idsuKien'];
        $iddoiTac = $_REQUEST['iddoiTac'];
        $controller->chonSuatDienLoaiVe($portGateway, $idsuKien, $iddoiTac);
        break;
    case "chuanBiThanhToan":
        $controller = new PurchaseController();
        $idsuKien = $_REQUEST['idsuKien'];
        $iddoiTac = $_REQUEST['iddoiTac'];
        $idsuatDien = $_REQUEST['idsuatdien'];
        $veDaChon = $_REQUEST['veDaChon'];
        $controller->chuanBiThanhToan($portGateway, $idsuKien, $iddoiTac, $idsuatDien, $veDaChon);
        break;
    case "chiTietVe":
        $controller = new ProductController();
        $idVe = $_REQUEST['idVe'];
        $idsuKien = $_REQUEST['idsuKien'];
        $iddoiTac = $_REQUEST['iddoiTac'];
        $controller->chiTietVe($portGateway, $idVe, $idsuKien, $iddoiTac);
        break;
    case "goiAPIThanhToan":
        $controller = new PurchaseController();
        $orderId = $_REQUEST['orderId'];
        $orderinfo = $_REQUEST['orderinfo'];
        $idsuKien = $_REQUEST['idsuKien'];
        $iddoiTac = $_REQUEST['iddoiTac'];
        $thanhTien = $_REQUEST['thanhTien'];
        $makhuyenmai = $_REQUEST['makhuyenmai'];
        $idtaikhoan = $_REQUEST['idtaikhoan'];
        $danhSachVe = $_REQUEST['danhSachVe'];
        $controller->goiAPIThanhToan($portGateway, $orderId, $orderinfo, $idsuKien, $iddoiTac, $thanhTien, $makhuyenmai, $idtaikhoan, $danhSachVe);
        break;
    case "listUser":
        $uri = 'taikhoan/listALL';
        $controller = new UserController();
        $controller->listUser($uri);
        break;
    default:
        $controller = new ProductController();
        $uri = "sukien/getAllSuKien";
        $controller->getAllSuKien($uri);
        break;
}
