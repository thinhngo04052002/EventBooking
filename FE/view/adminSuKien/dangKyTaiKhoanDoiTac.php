<?php
$answer;
?>
<div class="form-container">
    <h3>Đây là tài khoản dùng cho các doanh nghiệp tạo sự kiện!!!</h3>
    <h1>Đăng ký tài khoản</h1>
    <div class="form-group">
        <input type="text" placeholder="Nhập tên đăng nhập">
    </div>
    <div class="form-group">
        <input type="password" placeholder="Nhập mật khẩu">
    </div>
    <div class="form-group">
        <input type="email" placeholder="Nhập địa chỉ email">
    </div>
    <button class="btn">Đăng ký đối tác</button>
    <?php
    if (isset($answer) && ($answer == 1)) {
    ?>
        <p class="success-message">Đăng kí thành công</p>
    <?php
    } else if (isset($answer) && ($answer == 0)) {
    ?>
        <p class="error-message">Đăng kí không thành công</p>
    <?php
    } ?>

    <p><a href="index.php?action=dangNhap">Đã có tài khoản? Đăng nhập ngay!</a></p>
</div>