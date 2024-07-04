<?php
<<<<<<< HEAD
require_once("./controller/userService.php");
require_once("./controller/crmService.php");
require_once("./controller/logService.php");
require_once("./controller/productService.php");
require_once("./controller/purchaseService.php");
session_start();
$portGateway = 8001;

$action = "home";
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "home";

switch ($action) {
=======

session_start();

require_once ("./controller/userService.php");
require_once ("./controller/crmService.php");
require_once ("./controller/logService.php");
require_once ("./controller/productService.php");
require_once ("./controller/purchaseService.php");

$portGateway = 8001;

$action = "thongTinDoanhNghiep";
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "thongTinDoanhNghiep";
// $action = "thongTinDoanhNghiep";
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "thongTinDoanhNghiep";

switch ($action) {
    case "dangNhap":
        $uri='taikhoan/login';
        $controller = new UserController();
        $controller->dangNhap($uri);
        break;
    case "logout":
        $controller = new UserController();
        $controller->logOut();
        break;
    case "dangKy":
        $uri='taikhoan/register';
        $controller = new UserController();
        $controller->dangKy($uri);
        break;
        //khách hàng
    case "danhGia":
        $controller = new CrmController();
        $controller->danhGia($portGateway);
        break;

    case "filterSuKienCuaKH":
        $controller = new CrmController();
        $controller->filterSuKienCuaKH($portGateway);
        break;
>>>>>>> 5ca030c5862863891d08fca66451a89635c7cce8


        //admin sự kiện
    case "taoSuKien1":
        $controller = new ProductController();
        $controller->taoSuKien1();
        break;
    case "taoSuKien1Click":
        $_SESSION["TenSuKien"] = $_POST["TenSuKien"];
        $_SESSION["TheLoai"] = $_POST["TheLoai"];
        $_SESSION["QuocGia"] = $_POST["QuocGia"];
        $_SESSION["ThanhPho"] = $_POST["ThanhPho"];
        $_SESSION["DiaChi"] = $_POST["soNhaTenDuong"] . ', ' . $_POST["PhuongXa"] . ', ' . $_POST["QuanHuyen"] . ', ' . $_POST["ThanhPho"] . ', ' . $_POST["QuocGia"];
        $_SESSION["NoiToChuc"] = $_POST["NoiToChuc"];
        $_SESSION["ThongTinSuKien"] = $_POST["ThongTinSuKien"];
        $controller = new ProductController();
        $controller->taoSuKien1Click();
        break;
    case "taoSuKien2":
        $controller = new ProductController();
        $controller->taoSuKien2();
        break;
    case "taoSuKien2Click":
        $controller = new ProductController();
        $controller->taoSuKien2Click();
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
<<<<<<< HEAD
        //quản lý sự kiện
    case "quanLySuKien":
        $controller = new ProductController();
        $controller->quanLySuKien();
=======
    // case "dangKyDoiTac":
    //     $controller = new UserController();
    //     $controller->dangKyDoiTac($portGateway);
    //     break;
    case "thongTinDoanhNghiep":
        $controller = new UserController();
        $controller->thongTinDoanhNghiep($portGateway);
        break;
    case "thongTinDoanhNghiepClick":
        $controller = new UserController();
        $uri = "doitac/create";
        $controller->thongTinDoanhNghiepClick($uri);
>>>>>>> 5ca030c5862863891d08fca66451a89635c7cce8
        break;
        // case "thongTinDoanhNghiep":
        //     $controller = new UserController();
        //     $controller->thongTinDoanhNghiep($portGateway);
        //     break;
        // case "thongTinDoanhNghiepClick":
        //     $controller = new UserController();
        //     $uri = "doitac/create";
        //     $controller->thongTinDoanhNghiepClick($uri);
        //     break;
        //admin hệ thống


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