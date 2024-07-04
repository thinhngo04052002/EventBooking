<?php
$answer;
?>
<style>
    .login-container {
        display: flex;
        justify-content: flex-end;
        width: 100%;
        align-items: center;
    }

    .image-container {
        text-align: center;
        padding: 20px;
    }
    .registration-form-container {
  width: 100%;
  max-width: 600px;
  padding:20px;
  background-color: #fff;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  box-sizing: border-box;
  margin-top: 10px;
  margin-bottom:10px;
  margin-left:30px;
  margin-right:30px;
}

.registration-form-container h1 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
  font-family:Arial, Helvetica, sans-serif;
}

.registration-form-group {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
  font-family: Arial;
}

.registration-label {
  flex: 1;
  margin-right: 10px;
  color: #555;
  text-align: left;
}

.registration-input,
.registration-select {
  flex: 2;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
}

.registration-btn {
  width: 50%;
  padding: 15px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}
.registration-btn-group {
  display: flex;
  justify-content: flex-end;
}

.registration-btn:hover {
  background-color: #0056b3;
}

.registration-success-message,
.registration-error-message {
  text-align: center;
  margin-top: 20px;
}

.registration-success-message {
  color: green;
}

.registration-error-message {
  color: red;
}

.registration-link {
  text-align: center;
  display: block;
  margin-top: 5px;
  color: #007bff;
  text-decoration: none;
}

.registration-link:hover {
  text-decoration: underline;
}

.registration-success-message {
  color: green;
}
.registration-error-message {
  color: red;
}
.error-messages {
  color: red;
  margin-top: 15px;
}
.message {
  padding: 10px;
  margin-top: 10px;
  border-radius: 5px;
  text-align: center;
  width: 100%;
  max-width: 600px;
}
.success {
  background-color: #d4edda;
  color: #155724;
  border: 1px solid #c3e6cb;
}
.error {
  background-color: #f8d7da;
  color: #721c24;
  border: 1px solid #f5c6cb;
}
</style>
<div class='login-container'>
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
                <button type="submit" class="registration-btn" name=' login'>Đăng nhập </button>
            </div>
            <div class="registration-btn-group">
                <p><a href="index.php?action=dangNhap" class="registration-link">Đăng ký</a></p>
            </div>
        </form>

    </div>
</div>