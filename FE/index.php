<?php
require_once("./controller/userService.php");
require_once("./controller/crmService.php");
require_once("./controller/logService.php");
require_once("./controller/productService.php");
require_once("./controller/purchaseService.php");

$portGateway = 8001;

$action = "taosukien";
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "taosukien";

switch ($action) {




        //product service


        //crm service
    case "crm":
        $controller = new CrmController();
        $endpoint = "getAllSuKien";
        // $controller->callProductService($endpoint);
        break;



        //user service
    case "dangnhap":
        $controller = new UserController();
        $endpoint = "getAllSuKien";
        // $controller->callProductService($endpoint);
        break;



        //purchase service
    case "muave":
        $controller = new PurchaseController();
        $endpoint = "getAllSuKien";
        // $controller->callProductService($endpoint);
        break;




        //demo
        //get
    case "home":
        $controller = new ProductController();
        $uri = "sukien/getAllSuKien";
        $controller->getAllSuKien($uri);
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
