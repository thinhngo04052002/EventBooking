<?php
class UserController
{
    public function getUserService($uri, $method = 'GET', $data = [])
    {

        $url = 'http://localhost:8001/user?uri=' . $uri;
        $ch = curl_init();

        // Thêm token CSRF vào header request
        $headers = [
            'Content-Type: application/json'
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


        // Nếu là phương thức POST
        if ($method == 'POST') {

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        // print_r($response);
        if (curl_errno($ch)) {
            printf($response);
        }
        curl_close($ch);


        return json_decode($response, true);
    }


    public function dangNhap($uri)
    {


        if (isset($_POST['login'])) {
            $data = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
            ];
            $answer = $this->getUserService($uri, 'POST', $data);
            if (isset($answer) && isset($answer['access_token'])) {
                session_start();
                $_SESSION['IsLogined'] = true;
                $_SESSION['access_token'] = $answer['access_token'];
                $_SESSION['token_type'] = $answer['token_type'];
                $_SESSION['role'] = $answer['role'];
                $_SESSION['id'] = $answer['id'];
                header('Location:index.php');
                exit();
            } else {
                $answer = "Sai thông tin đăng nhập / Tài khoản bị khoá ";
                $VIEW = "./view/dangNhap.php";
            }
        } else {
            $data = "";
            $VIEW = "./view/dangNhap.php";
        }
        require("./template/template.php");
    }
    public function dangKy($uri)
    {
        if (isset($_POST['login'])) {
            $data = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                'vaitro' => $_POST['vaitro'],
                'tinhtrang' => 'Hoạt động'
            ];
            $answer = $this->getUserService($uri, 'POST', $data);
            $VIEW = "./view/dangKy.php";
            require("./template/template.php");
        } else {
            $data = "";
            $VIEW = "./view/dangKy.php";
            require("./template/template.php");
        }


        // Điều hướng đến view và template

    }

    public function thongTinDoanhNghiep($portGateway)
    {
        $portGateway;
        // Điều hướng đến view và template
        $VIEW = "./view/adminSuKien/thongTinDoanhNghiep.php";
        require("./template/template.php");
    }

    public function thongTinDoanhNghiepClick($uri)
    {
        $data = [
            'idve' => $_REQUEST["idve"],
            'idloaiVe' => $_REQUEST["idloaiVe"],
            'idSuatDien' => $_REQUEST["idSuatDien"],
            'idDoiTac' => $_REQUEST["idDoiTac"],
            'trangThaiBan' => $_REQUEST["trangThaiBan"],
            'soSeri' => $_REQUEST["soSeri"],
            'trangThaiDung' => $_REQUEST["trangThaiDung"],
            'idsuKien' => $_REQUEST["idsuKien"]
        ];
        // echo "hàm tạo vé  ";
        // print_r($data);
        $answer = $this->getUserService($uri, 'POST', $data);
        $VIEW = "./view/adminSuKien/thongTinDoanhNghiep.php";
        require("./template/template.php");
    }
}
