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

        <div class="registration-form-container">
            <h1>Thiết lập thông tin</h1>
            <?php
        
            if (isset($answer)) {
              
                header('Location: index.php?action=userProfile');
                exit();
            }
            ?>
            <form action="index.php?action=createProfile" method="post" class="registration-form" id="registration-form">
                <div class="registration-form-group">
                    <label for="hoten" class="registration-label">Họ và tên</label>
                    <input type="text" id="hoten" name="hoten" placeholder="Nhập họ tên" class="registration-input" required>
                </div>
                <div class="registration-form-group">
                    <label for="gioitinh" class="registration-label">Giới tính</label>
                    <select id="gioitinh" name="gioitinh" class="registration-select" required>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>
                <div class="registration-form-group">
                    <label for="ngaysinh" class="registration-label">Ngày sinh</label>
                    <input type="date" id="ngaysinh" name="ngaysinh" placeholder="Nhập ngày sinh" class="registration-input" required>
                </div>
                <div class="registration-form-group">
                    <label for="sdt" class="registration-label">Số điện thoại</label>
                    <input type="text" id="sdt" name="sdt" placeholder="Nhập số điện" class="registration-input" required>
                </div>


                <div class="registration-form-group">
                    <label for="diachi" class="registration-label">Địa chỉ</label>
                    <input type="text" id="địa chỉ" name="diachi" placeholder="Nhập địa chỉ " class="registration-input" required>
                </div>

                <div class="registration-btn-group">
                    <button type="submit" class="registration-btn" name='createProfile'>Hoàn Tất</button>
                </div>

                <div id="error-messages" class="error-messages"></div>
            </form>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('registration-form');

            form.addEventListener('submit', function(event) {
                var hoten = document.getElementById('hoten').value.trim();
                var sdt = document.getElementById('sdt').value.trim();
                var gioitinh = document.getElementById('gioitinh').value.trim();
                var diachi = document.getElementById('diachi').value.trim();
                var ngaysinh = document.getElementById('ngaysinh').value;

                var errorMessages = [];

                // Kiểm tra bắt buộc nhập
                if (hoten === '') {
                    errorMessages.push('Vui lòng ho và tên');
                }

                if (sdt === '') {
                    errorMessages.push('Vui lòng nhập số điên thoại');
                }

                if (gioitinh === '') {
                    errorMessages.push('Vui lòng nhập giới tính');
                }

                if (diachi === '') {
                    errorMessages.push('Vui lòng nhập địa chỉ ');
                }

                if (ngaysinh === '') {
                    errorMessages.push('Vui lòng ngày sinh');
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