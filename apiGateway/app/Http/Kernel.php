<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
class Kernel extends HttpKernel{
    protected $routeMiddleware = [
    // ...
    'apiGateway' => \App\Http\Middleware\ApiGatewayMiddleware::class,
    ];
}