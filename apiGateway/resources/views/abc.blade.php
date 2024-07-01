<!DOCTYPE html>
<br lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
{{--
<label>Ghi log mua vé</label>
<form action="{{ route('addLogMuaVe') }}" method="POST">
    @csrf
    <label for="name">Tổng tiền:</label>
    <input type="text" id="name" name="tongTien" required>

    <label for="name">Khách hàng:</label>
    <input type="text" id="email" name="idKhachHang" required>

    <label for="name">Danh sách vé:</label>
    <input type="text" id="name" name="danhSachVe[]" required>

    <button type="submit">Tạo</button>
</form>
<br>
<hr>
<label>Ghi log hủy vé</label>
<form action="{{ route('addLogHuyVe') }}" method="POST">
    @csrf
    <label for="name">Số tiền hoàn:</label>
    <input type="text" id="name" name="soTienHoan" required>

    <label for="name">Khách hàng:</label>
    <input type="text" id="email" name="idKhachHang" required>

    <label for="name">ID vé hủy:</label>
    <input type="text" id="name" name="idVe" required>

    <button type="submit">Tạo</button>
</form> --}}


<label>Tao ve</label>
<form action="{{ route('addTaoVe') }}" method="POST">

    @csrf
    <label for="name">idve:</label>
    <input type="text" id="name" name="idve" required>

    <label for="name">idloaiVe:</label>
    <input type="text" id="email" name="idloaiVe" required>

    <label for="name">idSuatDien:</label>
    <input type="text" id="name" name="idSuatDien" required>

    <label for="name">idDoiTac:</label>
    <input type="text" id="name" name="idDoiTac" required>

    <label for="name">trangThaiBan:</label>
    <input type="text" id="email" name="trangThaiBan" required>

    <label for="name">soSeri:</label>
    <input type="text" id="name" name="soSeri" required>
    <label for="name">trangThaiDung:</label>
    <input type="text" id="name" name="trangThaiDung" required>

    <label for="name">idsuKien:</label>
    <input type="text" id="email" name="idsuKien" required>


    <button type="submit">Tạo</button>
</form>
</body>

</html>
