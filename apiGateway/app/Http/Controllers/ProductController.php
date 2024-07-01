<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProductController extends Controller
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    public function callProductService(Request $request, $path)
    {
        $method = $request->getMethod();
        $url = getenv('PRODUCT_SERVICE_URL') . '/api/product/' . $path;

        $options = [];
        if ($method === 'GET') {
            $options['query'] = $request->query->all();
        } else {
            $options['json'] = json_decode($request->getContent(), true);
        }

        try {
            $response = $this->client->request($method, $url, $options);
            return response($response->getContent(), $response->getStatusCode());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function callAllSuKien(Request $request, $path)
    {
        $method = $request->getMethod();
        $url = getenv('PRODUCT_SERVICE_URL') . '/api/product/' . $path;

        $options = [];
        if ($method === 'GET') {
            $options['query'] = $request->query->all();
        } else {
            $options['json'] = json_decode($request->getContent(), true);
        }

        try {
            $response = $this->client->request($method, $url, $options);
            return response($response->getContent(), $response->getStatusCode());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
