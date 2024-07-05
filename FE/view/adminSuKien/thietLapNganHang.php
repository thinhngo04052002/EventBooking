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
            <h1>Thiết lập ngân hàng </h1>
            <?php
        
            if (isset($answer)) {
              

                    header('Location: index.php?action=thongTinDoanhNghiep');
                    exit();
            }
        
            ?>
            <form action="index.php?action=thietLapNganHang" method="post" class="registration-form" id="registration-form">
                <div class="registration-form-group">
                    <label for="tenNganhang" class="registration-label">Ngân hàng</label>
                    <input type="text" id="tenNganhang" name="tenNganhang" placeholder="Nhập ngân hàng" class="registration-input" required>
                </div>
                <div class="registration-form-group">
                    <label for="sotaikhoan" class="registration-label">Số tài khoản</label>
                    <input type="text" id="sotaikhoan" name="sotaikhoan" placeholder="Số tài khoản" class="registration-input" required>
                </div>
                <div class="registration-form-group">
                    <label for="chinhanh" class="registration-label">Chi Nhánh</label>
                    <input type="text" id="chinhanh" name="chinhanh" placeholder="Chi nhánh" class="registration-input" required>
                </div>
               
                <div class="registration-form-group">
                    <label for="chutaikhoan" class="registration-label">Chủ tài khoản</label>
                    <input type="text" id="chutaikhoan" name="chutaikhoan" placeholder="Chủ tài khoản" class="registration-input" required>
                </div>
                

                <div class="registration-btn-group">
                    <button type="submit" class="registration-btn" name='thietLapNganHang'>Hoàn Tất</button>
                </div>

                <div id="error-messages" class="error-messages"></div>
            </form>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('registration-form');

            form.addEventListener('submit', function(event) {
                var tenNganhang= document.getElementById('tenNganhang').value.trim();
                var sotaikhoan = document.getElementById('sotaikhoan ').value.trim();
                var chinhanh = document.getElementById('chinhanh').value.trim();
                var chuTaikhoan = document.getElementById('chuTaikhoan').value.trim();
            
                var errorMessages = [];

                // Kiểm tra bắt buộc nhập
                if (tenNganhang=== '') {
                    errorMessages.push('Vui lòng nhập tên ngân hàng');
                }

                if (sotaikhoan === '') {
                    errorMessages.push('Vui lòng nhập số tài khoản');
                }

                if (chinhanh === '') {
                    errorMessages.push('Vui lòng nhập chi nhánh');
                }

                if (chuTaikhoan === '') {
                    errorMessages.push('Vui lòng nhập tên chủ tài khoản ');
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