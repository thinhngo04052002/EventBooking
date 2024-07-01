<?php
// Route::middleware('apiGateway')->group(function () {
//     // Define routes for different APIs
//     Route::prefix('api1')->group(function () {
//     Route::get('resource1', 'Api1Controller@getResource1');
//     // ...
//     });

//     Route::prefix('api2')->group(function () {
//     Route::get('resource2', 'Api2Controller@getResource2');
//     // ...
//     });

//     // ...

//     Route::prefix('Log')->group(function () {
//     Route::get('/{url?}', 'App\Http\Controllers\ProxyController@handeRequestFromLogService');
//     // ...
//     });
// });

Route::any('/{url?}', 'App\Http\Controllers\ProxyController@handeRequestFromLogService')->where('url', '.*');