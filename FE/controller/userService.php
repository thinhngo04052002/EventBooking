<?php
class UserController
{
    public function getUserService($uri, $method = 'GET', $data = [])
    {

        $url = 'http://localhost:8001/user?uri=' . $uri;
        $ch = curl_init();
printf($url);
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
        if ($method == 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        printf($response);
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
                $_SESSION['isLogined'] = true;
                $_SESSION['access_token'] = $answer['access_token'];
                $_SESSION['token_type'] = $answer['token_type'];
                $_SESSION['role'] = $answer['role'];
                $_SESSION['id'] = $answer['id'];
                $_SESSION['username'] = $answer['username'];
                if ($_SESSION['role']=='KH'){
                header('Location:index.php?action=userProfile');
                }
                if ($_SESSION['role']=='ADDVSK'){
                header('Location:index.php?action=thongTinDoanhNghiep');
                }


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
    public function editProfile($uri)
    {
        
        if (isset($_POST['editProfile'])) {
            $data = [
                'hoten' => $_POST['hoten'],
                'sdt' => $_POST['sdt'],
                'diachi' => $_POST['diachi'],
                'gioitinh' => $_POST['gioitinh'],
                'ngaysinh' => $_POST['ngaysinh']
            ];
            $answer = $this->getUserService($uri, 'PUT', $data);
            $VIEW = "./view/khachHang/editProfile.php";
            $uri_data="nguoidung/info/userid=" .$_SESSION['id'];
            $profile = $this->getUserService($uri_data, 'GET');
            require("./template/template.php");
        } else {
            $data = "";
            $uri_data="nguoidung/info/userid=" .$_SESSION['id'];
            $profile = $this->getUserService($uri_data, 'GET');
            $VIEW = "./view/khachHang/editProfile.php";
            require("./template/template.php");
        }


        // Điều hướng đến view và template

    }
    public function editDoanhNghiep($uri)
    {
        
        if (isset($_POST['editDoanhNghiep'])) {
            $data = [
                'tendoitac' => $_POST['tendoitac'],
                'sdt' => $_POST['sdt'],
                'diachi' => $_POST['diachi'],
                'email' => $_POST['email'],
                'nguoidaidien' => $_POST['nguoidaidien'],
                'masothue' => $_POST['masothue'],
                'logo' => $_POST['logo'],
            ];
            $answer = $this->getUserService($uri, 'PUT', $data);
            $VIEW = "./view/adminSuKien/editDoanhNghiep.php";
            $uri_data="doitac/info/id=" .$_SESSION['id'];
            $profile = $this->getUserService($uri_data, 'GET');
            require("./template/template.php");
        } else {
            $data = "";
            $uri_data="doitac/info/id=" .$_SESSION['id'];
            $profile = $this->getUserService($uri_data, 'GET');
            $VIEW = "./view/adminSuKien/editDoanhNghiep.php";
            require("./template/template.php");
        }


        // Điều hướng đến view và template

    }

    public function logout()
    {
        unset($_SESSION["isLogined"]);
        header("Location:index.php?action=dangNhap");
    }
    public function thongtinKhachHang($uri)
    {
        $uri = $uri . $_SESSION['id'];
        $data = [];
        $VIEW = './view/khachHang/thongTinKhachHang.php';
        $answer = $this->getUserService($uri, 'GET', $data);
        $_SESSION['id_nguoidung']=$answer['id'];
        require("./template/template.php");
    }
    public function listUser($uri)
    {
    
        $VIEW = './view/adminHeThong/quanLiHeThong.php';
        $a=[];
        
        
        $data = $this->getUserService($uri, 'GET', $a);
        require("./template/template.php");
    }
    public function createProfile($uri)
    {
        if (isset($_POST['createProfile'])) {
            $data = [
                'hoten' => $_POST['hoten'],
                'sdt' => $_POST['sdt'],
                'diachi' => $_POST['diachi'],
                'gioitinh' => $_POST['gioitinh'],
                'ngaysinh' => $_POST['ngaysinh'],
                'id_taikhoan' => $_SESSION['id']
            ];
            $answer = $this->getUserService($uri, 'POST', $data);
            $VIEW = "./view/khachHang/taoHoSo.php";
            require("./template/template.php");
        } else {
            $data = "";
            $VIEW = "./view/khachHang/taoHoSo.php";
            require("./template/template.php");
        }


        // Điều hướng đến view và template

    }
    public function createDoiTac($uri)
    {
        if (isset($_POST['createDoiTac'])) {
            $data = [
                'id_taikhoan' => $_SESSION['id'],
                'tendoitac' => $_POST['tendoitac'],
                'sdt' => $_POST['sdt'],
                'diachi' => $_POST['diachi'],
                'email' => $_POST['email'],
                'nguoidaidien' => $_POST['nguoidaidien'],
                'masothue' => $_POST['masothue'],
                'logo' => $_POST['logo'],
            ];
            $answer = $this->getUserService($uri, 'POST', $data);
            if($answer==null){
                $answer=1;
            }
            $VIEW = "./view/adminSuKien/taoDoiTac.php";
            require("./template/template.php");
        } else {
            $data = "";
            $VIEW = "./view/adminSuKien/taoDoiTac.php";
            require("./template/template.php");
        }


        // Điều hướng đến view và template

    }
    
    public function thietLapNganHang($uri)
    {
        if (isset($_POST['thietLapNganHang'])) {
            $data = [
                'id_doitac' =>$_SESSION['idDoitac'],
                'tenNganhang' => $_POST['tenNganhang'],
                'sotaikhoan' => $_POST['sotaikhoan'],
                'chinhanh' => $_POST['chinhanh'],
                'chuTaikhoan' => $_POST['chutaikhoan']
            ];
            $answer = $this->getUserService($uri, 'POST', $data);
            $VIEW = "./view/adminSuKien/thietLapNganHang.php";
            if($answer==null){
                $answer=1;
            }
            require("./template/template.php");
        } else {
            $data = "";
            $VIEW = "./view/adminSuKien/thietLapNganHang.php";
            require("./template/template.php");
        }


        // Điều hướng đến view và template

    }

    public function thongTinDoanhNghiep($uri)
    {
        $uri = $uri . $_SESSION['id'];
        $data = [];


        // Điều hướng đến view và template
        $VIEW = "./view/adminSuKien/thongTinDoanhNghiep.php";
        $answer = $this->getUserService($uri, 'GET', $data);
        $_SESSION['idDoitac']=$answer['id'];
        
        $uri_b="doitac/nganhang/doitacid=" .    $_SESSION['idDoitac'];
        $bank=$this->getUserService($uri_b, 'GET', $data);
     

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
