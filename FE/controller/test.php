<!-- https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap -->
<?php
echo "demo cURL <br>";

// khoi tao curl
$curl = curl_init();

// Disable SSL/TLS certificate verification
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

// set cac thuoc tinh trong curl

curl_setopt_array($curl, [

    CURLOPT_URL => "https://api.ipify.org?format=json"
]);



// thuc thi cau lenh
// var_dump($curl);
$data = curl_exec($curl);
// var_dump($data);

if ($data === false) {
    $error = curl_error($curl);
    echo "cURL error: " . $error;
} else {
    // Process the API response
    $response = json_decode($data, true);
    // print_r($response);
}

// $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
// echo "<br>Response code: " . $response_code;



// $error = curl_error($curl);
// var_dump($error);

//ket thuc va giai phong curl

curl_close($curl);
