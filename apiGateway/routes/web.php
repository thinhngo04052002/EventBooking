<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiGatewayController;

use Illuminate\Http\Request;
use GuzzleHttp\Client;



//nằm trong folder resources/view
Route::get('/', function () {
    return view('welcome');
});

Route::get('/abc', function () {
    return view('abc');
});

Route::middleware('apiGateway')->group(function () {
    Route::prefix('Log')->group(function () {
        Route::get('/{url?}', 'App\Http\Controllers\ProxyController@handeRequestFromLogService');
        Route::post('/addLogMuaVe', 'App\Http\Controllers\ProxyController@handePostAddLogMuaVeLogService')->name('addLogMuaVe');
        Route::post('/addLogHuyVe', 'App\Http\Controllers\ProxyController@handePostAddLogHuyVeLogService')->name('addLogHuyVe');
        // ...
    });
});
// Route::middleware('apiGateway')->group(function () {
//     Route::prefix('product')->group(function () {
//         Route::post('/ve/postVe', 'App\Http\Controllers\ProxyController@handePostVe')->name('addTaoVe');
//     });
// });
Route::post('/product/ve/postVe', 'App\Http\Controllers\ProxyController@handePostVe')->name('addTaoVe');
Route::get('/product/ve/get-all-ve', function (Request $request) {
    // Tạo một instance của GuzzleHTTP Client
    $client = new Client();

    // Gửi yêu cầu GET đến API của bạn
    try {
        $response = $client->get('http://localhost:8005/product/ve/getAllVe');

        // Trả về phản hồi dưới dạng JSON
        return response()->json(json_decode($response->getBody()->getContents()), $response->getStatusCode());
    } catch (\Exception $e) {
        // Trả về lỗi nếu có vấn đề xảy ra
        return response()->json(['error' => 'Unable to fetch data'], 500);
    }
});
