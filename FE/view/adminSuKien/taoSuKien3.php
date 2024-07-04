<?php
function callProductService2($endpoint, $data)
{
    $url = 'http://localhost:8000/product/' . $endpoint;
    echo $url;
    $ch = curl_init();

    // Lấy token CSRF từ meta tag
    // $token = $_POST['_token'] ?? $_GET['_token'] ?? null;
    // echo $token;
    // Thêm token CSRF vào header request
    $headers = [
        // 'X-CSRF-TOKEN: ' . $token,
        'Content-Type: application/json'
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    curl_close($ch);

    return json_decode($response, true);
}
$data = [
    "idve" => 13,
    "idloaiVe" => 1,
    "idSuatDien" => 1,
    "idDoiTac" => 1,
    "trangThaiBan" => 'Chưa bán',
    "soSeri" => '000566641414',
    "trangThaiDung" => 'Chưa check in',
    "idsuKien" => 2
];
print_r($data);
$response = callProductService2('ve/postVe', $data);
print_r($response);
