<?php
$answer;
?>
<?php
if (isset($answer) && ($answer !== "")) {
    print_r($answer);
}
?>
<!-- resources/views/form.blade.php -->
<form action="index.php" method="POST">

    <label for="idve">ID Vé:</label>
    <input type="number" id="idve" name="idve" required><br>

    <label for="idloaiVe">ID Loại Vé:</label>
    <input type="number" id="idloaiVe" name="idloaiVe" required><br>

    <label for="idSuatDien">ID Suất Diễn:</label>
    <input type="number" id="idSuatDien" name="idSuatDien" required><br>

    <label for="idDoiTac">ID Đối Tác:</label>
    <input type="number" id="idDoiTac" name="idDoiTac" required><br>

    <label for="trangThaiBan">Trạng Thái Bán:</label>
    <input type="text" id="trangThaiBan" name="trangThaiBan" required><br>

    <label for="soSeri">Số Seri:</label>
    <input type="text" id="soSeri" name="soSeri" required><br>

    <label for="trangThaiDung">Trạng Thái Dùng:</label>
    <input type="text" id="trangThaiDung" name="trangThaiDung" required><br>

    <label for="idsuKien">ID Sự Kiện:</label>
    <input type="number" id="idsuKien" name="idsuKien" required><br>

    <input type="hidden" name="action" value="testTaoVeClick" />
    <button type="submit">Gửi</button>
</form>