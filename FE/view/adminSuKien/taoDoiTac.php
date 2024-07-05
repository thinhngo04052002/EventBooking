<!DOCTYPE html>
<html lang="en">
<?php
?>
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

        <div class="registration-form-container">
            <h1>Thiết lập hồ sơ đối tác </h1>
            <?php
        
            if (isset($answer)) {
              

                    header('Location: index.php?action=thongTinDoanhNghiep');
                    exit();
            }
        
            ?>
            <form action="index.php?action=createDoiTac" method="post" class="registration-form" id="registration-form">
                <div class="registration-form-group">
                    <label for="tendoitac" class="registration-label">Tên doanh nghiệp</label>
                    <input type="text" id="tendoitac" name="tendoitac" placeholder="Nhập tên doanh nghiệp" class="registration-input" required>
                </div>
                <div class="registration-form-group">
                    <label for="masothue" class="registration-label">Mã Số Thuế</label>
                    <input type="text" id="masothue" name="masothue" placeholder="Mã số thuế" class="registration-input" required>
                </div>
                <div class="registration-form-group">
                    <label for="logo" class="registration-label">Logo doanh nghiệp ( nếu có )</label>
                    <input type="text" id="logo" name="logo" placeholder="Mã số thuế" value='css/images/admin-avt.png'class="registration-input" required>
                </div>
               
                <div class="registration-form-group">
                    <label for="nguoidaidien" class="registration-label">Người đại diện</label>
                    <input type="text" id="nguoidaidien" name="nguoidaidien" placeholder="Người đại diện" class="registration-input" required>
                </div>
                <div class="registration-form-group">
                    <label for="sdt" class="registration-label">Số điện thoại</label>
                    <input type="text" id="sdt" name="sdt" placeholder="Nhập số điện" class="registration-input" required>
                </div>


                <div class="registration-form-group">
                    <label for="diachi" class="registration-label">Địa chỉ</label>
                    <input type="text" id="diachi" name="diachi" placeholder="Nhập địa chỉ " class="registration-input" required>
                </div>
                <div class="registration-form-group">
                    <label for="email" class="registration-label">Email</label>
                    <input type="text" id="email" name="email"placeholder="Nhập địa chỉ email" class="registration-input" required>
                </div>

                <div class="registration-btn-group">
                    <button type="submit" class="registration-btn" name='createDoiTac'>Hoàn Tất</button>
                </div>

                <div id="error-messages" class="error-messages"></div>
            </form>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('registration-form');

            form.addEventListener('submit', function(event) {
                var tendoitac = document.getElementById('tendoitac').value.trim();
                var sdt = document.getElementById('sdt').value.trim();
                var masothue = document.getElementById('masothue').value.trim();
                var diachi = document.getElementById('diachi').value.trim();
                var email = document.getElementById('email').value;
                var nguoidaidien = document.getElementById('nguoidaidien').value;

                var errorMessages = [];

                // Kiểm tra bắt buộc nhập
                if (tendoitac === '') {
                    errorMessages.push('Vui lòng nhập tên doanh nghiệp');
                }

                if (sdt === '') {
                    errorMessages.push('Vui lòng nhập số điên thoại');
                }

                if (masothue === '') {
                    errorMessages.push('Vui lòng nhập mã số thuế');
                }

                if (diachi === '') {
                    errorMessages.push('Vui lòng nhập địa chỉ ');
                }

                if (email === '') {
                    errorMessages.push('Vui lòng nhập email');
                }
                if (nguoidaidien === '') {
                    errorMessages.push('Vui lòng nhập người đại diện');
                }

                // Kiểm tra mật khẩu và nhập lại mật khẩu có trùng khớp không


                // Nếu có lỗi thì ngăn không submit form và hiển thị thông báo lỗi
                if (errorMessages.length > 0) {
                    event.preventDefault(); // Ngăn không submit form

                    var errorContainer = document.getElementById('error-messages');
                    errorContainer.innerHTML = ''; // Xóa các thông báo lỗi trước đó

                    errorMessages.forEach(function(message) {
                        var p = document.createElement('p');
                        p.textContent = message;
                        errorContainer.appendChild(p);
                    });


                }
            });
        });
    </script>
</body>

</html>