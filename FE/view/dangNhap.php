<?php
$answer;
?>

<div class="registration-form-container">
    <h1>Đăng nhập</h1>
    <form action="index.php?action=dangNhap" method="post" class="registration-form">
        <div class="registration-form-group">
            <label for="username" class="registration-label">Tên Người Dùng</label>
            <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" class="registration-input" required>
        </div>
        <div class="registration-form-group">
            <label for="password" class="registration-label">Mật khẩu</label>
            <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" class="registration-input" required>
        </div>
        
        <div class="registration-btn-group">
            <button type="submit" class="registration-btn">Đăng nhập </button>
        </div>
        <div class="registration-btn-group">
        <p><a href="index.php?action=dangKy" class="registration-link">Đăng ký</a></p>
        </div>
    </form>
    <?php
    if (isset($answer)) {
        if ($answer == 1) {
            echo '<p class="registration-success-message">Đăng kí thành công</p>';
        } else if ($answer == 0) {
            echo '<p class="registration-error-message">Đăng kí không thành công</p>';
        }
    }
    ?>
</div>
