<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>


</head>

<body>
    <div class="profile_form_container">
        <!-- <div class="image-container">
            <img src="css/images/information-icon.png" alt="Chibi Cat on Box">
        </div> -->
        <?php
        if (isset($answer)) {

            header('Location: index.php?action=thongTinDoanhNghiep');
            exit();
        }
        ?>

        <div class="registration-form-container">
            <h1>Cập nhật thông tin</h1>

            <form action="index.php?action=editDoanhNghiep" method="post" class="registration-form" id="registration-form">
                <div class="registration-form-group">
                    <label for="tendoitac" class="registration-label">Tên doanh nghiệp</label>
                    <input value='<?php echo $profile['tendoitac']?>'type="text" id="tendoitac" name="tendoitac" placeholder="Nhập tên doanh nghiệp" class="registration-input" required>
                </div>
                <div class="registration-form-group">
                    <label for="masothue" class="registration-label">Mã Số Thuế</label>
                    <input value='<?php echo $profile['masothue']?>'type="text" id="masothue" name="masothue" placeholder="Mã số thuế" class="registration-input" required>
                </div>
                <div class="registration-form-group">
                    <label for="logo" class="registration-label">Logo doanh nghiệp ( nếu có )</label>
                    <input value='<?php echo $profile['logo']?>'type="text" id="logo" name="logo" placeholder="Mã số thuế" value='css/images/admin-avt.png' class="registration-input" required>
                </div>

                <div class="registration-form-group">
                    <label for="nguoidaidien" class="registration-label">Người đại diện</label>
                    <input value='<?php echo $profile['nguoidaidien']?>' type="text" id="nguoidaidien" name="nguoidaidien" placeholder="Người đại diện" class="registration-input" required>
                </div>
                <div class="registration-form-group">
                    <label for="sdt" class="registration-label">Số điện thoại</label>
                    <input value='<?php echo $profile['sdt']?>'type="text" id="sdt" name="sdt" placeholder="Nhập số điện" class="registration-input" required>
                </div>


                <div class="registration-form-group">
                    <label for="diachi" class="registration-label">Địa chỉ</label>
                    <input value='<?php echo $profile['diachi']?>'type="text" id="diachi" name="diachi" placeholder="Nhập địa chỉ " class="registration-input" required>
                </div>
                <div class="registration-form-group">
                    <label for="email" class="registration-label">Email</label>
                    <input value='<?php echo $profile['email']?>'type="text" id="email" name="email" placeholder="Nhập địa chỉ email" class="registration-input" required>
                </div>

                <div class="registration-btn-group">
                    <button type="submit" class="registration-btn" name='editDoanhNghiep'>Hoàn Tất</button>
                </div>

                <div id="error-messages" class="error-messages"></div>
            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const dateInput = document.getElementById('ngaysinh');

            // Định dạng ngày tháng theo yyyy-mm-dd
            function formatDate(input) {
                const date = new Date(input.value);
                let day = date.getDate();
                let month = date.getMonth() + 1; // Tháng trong JavaScript bắt đầu từ 0
                let year = date.getFullYear();

                if (day < 10) {
                    day = '0' + day;
                }
                if (month < 10) {
                    month = '0' + month;
                }

                // Định dạng lại giá trị của input
                input.value = `${year}-${month}-${day}`;
            }

            // Lắng nghe sự kiện thay đổi của input date
            dateInput.addEventListener('change', (event) => {
                formatDate(event.target);
            });
        });
    </script>
</body>

</html>