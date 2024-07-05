<?php
if (isset($answer['error']) && $answer['error'] == "Request failed with status code 404") {
    header('Location: index.php?action=createDoiTac');
    exit();
}
?>
<?php
if (isset($bank['error']) && $bank['error'] == "Request failed with status code 404") {
    header('Location: index.php?action=thietLapNganHang');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin đối tác</title>
    <style>
        .info-container {
            display: flex;
            justify-content: flex-end;
            width: 100%;
            align-items: center;
            font-family: Arial, Helvetica, sans-serif;
        }

        .info-space {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin: 10px;
            width: 90%;
            max-width: 600px;
            height: auto;
            text-align: left;
            animation: fadeIn 1s ease-in-out;
            box-shadow: 0 2px 8px rgba(129, 188, 2, 0.696);
        }

        .avatar-space {
            padding: 20px;
            margin: 10px;
            width: 90%;
            max-width: 600px;
            height: 400px;
            text-align: left;
            animation: fadeIn 1s ease-in-out;
        }

        .info-space h1{
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
            text-transform: uppercase;
        }
        .info-space h3{
            color: #333;
            margin-bottom: 20px;
            font-size: 20px;
            text-transform: uppercase;
        }

        .info p {
            margin-top: 30px;
            margin-bottom: 30px;
            font-size: 18px;
            line-height: 1.5;
        }

        .info .label {
            font-weight: bold;
            color: #444;
        }

        .info-image img {
            width: 300px;
            height: 300px;
            object-fit: cover;
            margin: 60px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="info-container">
        <div class="avatar-space">
            <div class="info-image">
                <img src="<?php echo $answer['logo'];?>" alt="avt-doanhnghiep"> 
            </div>
        </div>
        <div class="info-space">
            <h1><?php echo $answer['tendoitac']; ?></h1>
            <div class="info">
                <p><span class="label">Người đại diện:</span> <?php echo $answer['nguoidaidien']; ?></p>
                <p><span class="label">Số điện thoại:</span> <?php echo $answer['sdt']; ?></p>
                <p><span class="label">Địa chỉ:</span> <?php echo $answer['diachi']; ?></p>
                <a href="index.php?action=editDoanhNghiep" class="btn btn-outline-primary">Chỉnh sửa </a>
                <h3>Thông tin ngân hàng</h3>
                <p><span class="label">Tên ngân hàng:</span> <?php echo $bank['tenNganhang']; ?></p>
                <p><span class="label">Số tài khoản:</span> <?php echo $bank['sotaikhoan']; ?></p>
                <p><span class="label">Chi nhánh:</span> <?php echo $bank['chinhanh']; ?></p>
                <p><span class="label">Chủ tài khoản:</span> <?php echo $bank['chuTaikhoan']; ?></p>
            </div>
        </div>
    </div>
</body>
</html>
