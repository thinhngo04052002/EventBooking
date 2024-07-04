
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    
</head>
<body>
    <div class="registration-form-container">
        <h1>Đăng ký tài khoản</h1>
        <?php
        if (isset($answer)) {
            if (isset($answer['error']) && $answer['error'] == "Request failed with status code 400") {
                $errorMessage = "Tên đăng nhập đã tồn tại";
                echo '<p class="message error">' . $errorMessage . '</p>';
          
            } else {
                header('Location: /index.php');
                exit();
            }
        }
        ?>
        <form action="index.php?action=dangKy" method="post" class="registration-form" id="registration-form">
            <div class="registration-form-group">
                <label for="username" class="registration-label">Tên Người Dùng</label>
                <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" class="registration-input" required>
            </div>
            <div class="registration-form-group">
                <label for="password" class="registration-label">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" class="registration-input" required>
            </div>
            <div class="registration-form-group">
                <label for="re-enter-password" class="registration-label">Nhập lại mật khẩu</label>
                <input type="password" id="re-enter-password" name="re_enter_password" placeholder="Nhập mật khẩu" class="registration-input" required>
            </div>
            <div class="registration-form-group">
                <label for="email" class="registration-label">Email</label>
                <input type="email" id="email" name="email" placeholder="Nhập địa chỉ email" class="registration-input" required>
            </div>
            <div class="registration-form-group">
                <label for="vaitro" class="registration-label">Bạn cần</label>
                <select id="vaitro" name="vaitro" class="registration-select" required>
                    <option value="KH">Mua vé</option>
                    <option value="ADDVSK">Tổ chức sự kiện</option>
                </select>
            </div>
            <div class="registration-btn-group">
                <button type="submit" class="registration-btn" name='login'>Đăng ký tài khoản</button>
            </div>
            <div class="registration-btn-group">
                <p><a href="index.php?action=dangNhap" class="registration-link">Đã có tài khoản? Đăng nhập ngay!</a></p>
            </div>
            <div id="error-messages" class="error-messages"></div>
        </form>
        
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('registration-form');

        form.addEventListener('submit', function(event) {
            var username = document.getElementById('username').value.trim();
            var password = document.getElementById('password').value.trim();
            var confirmPassword = document.getElementById('re-enter-password').value.trim();
            var email = document.getElementById('email').value.trim();
            var vaitro = document.getElementById('vaitro').value;

            var errorMessages = [];

            // Kiểm tra bắt buộc nhập
            if (username === '') {
                errorMessages.push('Vui lòng nhập tên đăng nhập');
            }

            if (password === '') {
                errorMessages.push('Vui lòng nhập mật khẩu');
            }

            if (confirmPassword === '') {
                errorMessages.push('Vui lòng nhập lại mật khẩu');
            }

            if (email === '') {
                errorMessages.push('Vui lòng nhập địa chỉ email');
            }

            if (vaitro === '') {
                errorMessages.push('Vui lòng chọn vai trò');
            }

            // Kiểm tra mật khẩu và nhập lại mật khẩu có trùng khớp không
            if (password !== confirmPassword) {
                errorMessages.push('Mật khẩu và nhập lại mật khẩu không khớp');
            }

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
