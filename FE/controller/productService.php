<?php
function callProductService($endpoint)
{
    $url = 'http://localhost:8000/product/' . $endpoint;

    $ch = curl_init();

    // Lấy token CSRF từ meta tag
    $token = $_POST['_token'] ?? $_GET['_token'] ?? null;

    // Thêm token CSRF vào header request
    $headers = [
        'X-CSRF-TOKEN: ' . $token,
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
