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
    public function getUserService2($uri, $method = 'GET', $data = [])
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
        // echo " chưa lấy http";
        // Lấy mã trạng thái HTTP
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // echo "lấy http: $httpCode";
        if (curl_errno($ch)) {
            printf($response);
        }
        curl_close($ch);

        return [
            'status_code' => $httpCode,
            'data' => json_decode($response, true)
        ];
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
                header('Location:index.php?action=dangKy');
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
    public function logout()
    {
        unset($_SESSION["isLogined"]);
        header("Location:index.php?action=dangNhap");
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
        // echo $_FILES['eventImageInput'];
        if (isset($_FILES['eventImageInput'])) {
            $file = $_FILES['eventImageInput'];
            $fileTmpName = $file['tmp_name']; // Đường dẫn tới file tạm thời
            $fileError = $file['error']; // Mã lỗi nếu có

            // Kiểm tra lỗi upload
            if ($fileError === 0) {
                // Đặt tên file mới
                $newFileName = $_SESSION['id'];

                // Lấy phần mở rộng của file gốc để giữ nguyên định dạng
                $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

                // Đặt đường dẫn lưu file với tên mới và phần mở rộng
                $fileDestination = 'uploads/' . $newFileName . '.' . $fileExtension;

                // Di chuyển file từ thư mục tạm thời tới đích
                move_uploaded_file($fileTmpName, $fileDestination);
            } else {
                echo "Error uploading file: $fileError";
            }
        } else {
            echo "No file was uploaded.";
        }

        $data = [
            'id_taikhoan' => $_SESSION['id'],
            'tendoitac' => $_POST["tendoitac"],
            'sdt' => $_POST["sdt"],
            'diachi' => $_POST["soNhaTenDuong"] . ', ' . $_POST["PhuongXa"] . ', ' . $_POST["QuanHuyen"] . ', ' . $_POST["ThanhPho"] . ', ' . $_POST["QuocGia"],
            'email' => $_POST["email"],
            'nguoidaidien' => $_POST["nguoidaidien"],
            'masothue' => $_POST["masothue"],
            'logo' => $fileDestination
        ];
        // echo "hàm tạo vé  ";
        // print_r($data);
        $answer = $this->getUserService2($uri, 'POST', $data);
        // echo "answer " . $answer['status_code'];
        $VIEW = "./view/adminSuKien/thongTinDoanhNghiep.php";
        require("./template/template.php");
    }
}
