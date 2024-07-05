<?php
require_once ('purchaseService.php');
$makhuyenmai = $_REQUEST['makhuyenmai_'];
$idsuKien = $_REQUEST['idsuKien'];
$iddoiTac = $_REQUEST['iddoiTac'];

// Gọi đến API Gateway để lấy dữ liệu
$controller = new PurchaseController();
$uri = 'khuyenmai/getkhuyenmaibyMakhuyenmaiIdsukienIddoitac?idsukien=' . $idsuKien . '&iddoitac=' . $iddoiTac . '&maKhuyenMai=' . $makhuyenmai;
$khuyenmai = $controller->getPurchaseService($uri);

$chietKhau = $khuyenmai['chietkhau'];
echo $chietKhau;
json_encode(['chietKhau' => $chietKhau]);