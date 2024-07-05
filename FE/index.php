<?php

session_start();

require_once("./controller/userService.php");
require_once("./controller/crmService.php");
require_once("./controller/logService.php");
require_once("./controller/productService.php");
require_once("./controller/purchaseService.php");

$portGateway = 8001;

$action = "thongTinDoanhNghiep";
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "thongTinDoanhNghiep";
// $action = "thongTinDoanhNghiep";
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "thongTinDoanhNghiep";

switch ($action) {
    case "dangNhap":
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
        $controller = new CrmController();
        $controller->danhGia($portGateway);
        break;

    case "filterSuKienCuaKH":
        $controller = new CrmController();
        $controller->filterSuKienCuaKH($portGateway);
        break;
    case 'createProfile':
        $uri = "nguoidung/create";
        $controller = new UserController();
        $controller->createProfile($uri);
        break;




        //admin sự kiện
    case "taoSuKien1":
        $controller = new ProductController();
        $controller->taoSuKien1();
        break;
    case "taoSuKien2":
        $controller = new ProductController();
        $controller->taoSuKien2();
        break;
    case "taoSuKien3":
        $controller = new ProductController();
        $controller->taoSuKien3();
        break;
    case "taoSuKien4":
        $controller = new ProductController();
        $controller->taoSuKien4();
        break;
    case "taoSuKien5":
        $controller = new ProductController();
        $controller->taoSuKien5();
        break;
    case "taoSuKien6":
        $controller = new ProductController();
        $controller->taoSuKien6();
        break;
    case "taoSuKienClick":
        $controller = new ProductController();
        $uri = "sukien/postThemSuKien";
        $controller->taoSuKienClick($uri);
        break;
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
        //admin hệ thống
    case "listUser":
        $uri = 'taikhoan/listALL';
        $controller = new UserController();
        $controller->listUser($uri);
        break;
    case "thietLapNganHang":
        $uri = 'doitac/nganhang/create';
        $controller = new UserController();
        $controller->thietLapNganHang($uri);
        break;

        //demo
        //get
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
    default:
        $controller = new ProductController();
        $uri = "sukien/getAllSuKien";
        $controller->getAllSuKien($uri);
        break;
}
