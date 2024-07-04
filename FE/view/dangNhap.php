<?php
$answer;
?>

<div class="registration-form-container">
    <h1>Đăng nhập</h1>
    <?php
        if (isset($answer)) {
           
            echo '<p class="message error">' . $answer . '</p>';

           
            
        }
        ?>
    <form action="index.php?action=dangNhap" method="post" class="registration-form">
        <div class="registration-form-group">
            <label for="username" class="registration-label">Tên đăng nhập</label>
            <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" class="registration-input" required>
        </div>
        <div class="registration-form-group">
            <label for="password" class="registration-label">Mật khẩu</label>
            <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" class="registration-input" required>
        </div>
        
        <div class="registration-btn-group">
            <button type="submit" class="registration-btn" name='login'>Đăng nhập </button>
        </div>
        <div class="registration-btn-group">
        <p><a href="index.php?action=dangNhap" class="registration-link">Đăng ký</a></p>
        </div>
    </form>
    
</div>
