


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
                
                    header('Location: index.php?action=userProfile');
                    exit();
            
            }
            ?>

        <div class="registration-form-container">
            <h1>Cập nhật thông tin</h1>
            
            <form action="index.php?action=edit_profile" method="post" class="registration-form" id="registration-form">
                <div class="registration-form-group">
                    <label for="hoten" class="registration-label">Họ và tên</label>
                    <input type="text" id="hoten" name="hoten" value='<?php echo $profile['hoten'];?>' placeholder="Nhập họ tên" class="registration-input" required>
                </div>
                <div class="registration-form-group">
                    <label for="gioitinh" class="registration-label">Giới tính</label>
                    <select id="gioitinh" name="gioitinh" value='<?php echo $profile['gioitinh'];?>'class="registration-select" required>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>
                <div class="registration-form-group">
                    <label for="ngaysinh" class="registration-label">Ngày sinh</label>
                    <input type="date" id="ngaysinh" name="ngaysinh"  placeholder="Nhập ngày sinh" class="registration-input" required>
                </div>
                <div class="registration-form-group">
                    <label for="sdt" class="registration-label">Số điện thoại</label>
                    <input type="text" id="sdt" name="sdt" placeholder="Nhập số điện"value='<?php echo $profile['sdt'];?>' class="registration-input" required>
                </div>


                <div class="registration-form-group">
                    <label for="diachi" class="registration-label">Địa chỉ</label>
                    <input type="text" id="địa chỉ" name="diachi" placeholder="Nhập địa chỉ " value='<?php echo $profile['diachi'];?>'class="registration-input" required>
                </div>

                <div class="registration-btn-group">
                    <button type="submit" class="registration-btn" name='editProfile'>Hoàn Tất</button>
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