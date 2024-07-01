<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProxyController extends Controller
{
    public function handeRequestFromLogService($url = '')
    {

        $https = 'http'; // http or https
        $domain = 'localhost:8083'; // domain or subdomain that you want to proxy to

        // setup headers
        $client = new Client();
        $headers = collect(request()->headers->all())
            ->map(function ($item, $key) {
                return $item[0];
            })
            ->all(); // this gets all headers sent to this request, and formats them as 'header-name' => 'value'
        $headers['host'] = $domain; // you can now overwrite any header

        // setup params
        $opts = [
            'http_errors' => false, // if this is true, will throw any error directly
            'verify' => false, // this skips any ssl verification. remove this if you need to verify an valid ssl
            'allow_redirects' => ['max' => 10], // only useful if the target has some redirects
            'timeout' => 10, // if you don't set a timeout limit, when the target api does not work, you will wait a long time to get http error
            'connect_timeout' => 10,
            'read_timeout' => 10,
            'headers' => $headers,
            'body' => json_encode(request()->all()), // this sends the same body that we get, to remote target in json format.
            // 'form_params' => request()->all(), // use form params instead of body, if server wants clasic form body
        ];

        // make request
        $response = $client->request(
            request()->method(),
            $https . '://' . $domain . '/Log' . '/' . $url,
            $opts
        );

        // read body and parse json
        $body = $response->getBody()->getContents();
        $body = json_decode($body, true); // remove this line if api is xml, or other format than json

        // // log response and debug data // only for debugging. works great with laravel/telescope
        logger()->debug('PROXY Request ' . request()->method() . ' ' . $https . '://' . $domain . '/' . $url, [
            'request_opts' => $opts,
            'response_status_code' => $response->getStatusCode(),
            'response_headers' => $response->getHeaders(),
            'response_body' => $body,
        ]);
        return $response->getBody();
        // return $response->getStatusCode();
    }
    public function handePostAddLogMuaVeLogService()
    {
        $domain = 'localhost:8083'; // domain or subdomain that you want to proxy to

        // setup headers
        $client = new Client();
        $headers = collect(request()->headers->all())
            ->map(function ($item, $key) {
                return $item[0];
            })
            ->all(); // this gets all headers sent to this request, and formats them as 'header-name' => 'value'
        $headers['host'] = $domain; // you can now overwrite any header
        $headers['content-type'] = 'application/json';

        $body = '{
        "tongTien": ' . request()->input('tongTien') . ',
        "idKhachHang": ' . request()->input('idKhachHang') . ',
        "danhSachVe": [' . implode(",", request()->input('danhSachVe')) . ']
        }';

        $opts = [
            'http_errors' => false, // if this is true, will throw any error directly
            'verify' => false, // this skips any ssl verification. remove this if you need to verify an valid ssl
            'allow_redirects' => ['max' => 10], // only useful if the target has some redirects
            'timeout' => 10, // if you don't set a timeout limit, when the target api does not work, you will wait a long time to get http error
            'connect_timeout' => 10,
            'read_timeout' => 10,
            'headers' => $headers,
            'body' => $body, // this sends the same body that we get, to remote target in json format.
        ];
        // make request
        $response = $client->request(
            'POST',
            'http://localhost:8083/Log/addLogMuaVe',
            $opts
        );
        // read body and parse json
        $body = $response->getBody()->getContents();
        $body = json_decode($body, true); // remove this line if api is xml, or other format than json

        return [
            'statusCode' => (string) $response->getStatusCode(),
            'body' => (string) $response->getBody()
        ];
    }

    public function handePostVe()
    {
        $domain = 'localhost:8005'; // domain or subdomain that you want to proxy to
        $https = 'http';
        // setup headers
        $client = new Client();
        $headers = collect(request()->headers->all())
            ->map(function ($item, $key) {
                return $item[0];
            })
            ->all(); // this gets all headers sent to this request, and formats them as 'header-name' => 'value'
        $headers['host'] = $domain; // you can now overwrite any header
        $headers['content-type'] = 'application/json';

        $body = '{
        "idve": ' . request()->input('idve') . ',
        "idloaiVe": ' . request()->input('idloaiVe') . ',
        "idSuatDien": ' . request()->input('idSuatDien') . ',
        "idDoiTac": ' . request()->input('idDoiTac') . ',
        "trangThaiBan": ' . request()->input('trangThaiBan') . ',
        "soSeri": ' . request()->input('soSeri') . ',
        "trangThaiDung": ' . request()->input('trangThaiDung') . ',
        "idsuKien": ' . request()->input('idsuKien') . '
        }';
        $opts = [
            'http_errors' => true, // if this is true, will throw any error directly
            'verify' => false, // this skips any ssl verification. remove this if you need to verify an valid ssl
            'allow_redirects' => ['max' => 10], // only useful if the target has some redirects
            'timeout' => 10, // if you don't set a timeout limit, when the target api does not work, you will wait a long time to get http error
            'connect_timeout' => 10,
            'read_timeout' => 10,
            'headers' => $headers,
            'body' => $body, // this sends the same body that we get, to remote target in json format.
        ];
        // make request
        $response = $client->request(
            'http://localhost:8005/product/ve/postVe',
            $opts
        );
        // read body and parse json
        $body = $response->getBody()->getContents();
        $body = json_decode($body, true); // remove this line if api is xml, or other format than json

        return [
            'statusCode' => (string) $response->getStatusCode(),
            'body' => (string) $response->getBody()
        ];
    }
}
