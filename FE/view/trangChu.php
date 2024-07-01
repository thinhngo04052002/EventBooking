<!-- danh sách sự kiện chưa xảy ra theo thể loại -->
<!-- import use Illuminate\Support\Facades\View; -->
<?php
include './controller/productService.php';

$events = callProductService('ve/get-all-ve');
?>
<ul>
    <?php
    if ($events) {
        foreach ($events as $event) {
            echo "<li>{$event['trangThaiBan']}</li>";
        }
    } else {
        echo "<li>Không có sự kiện nào</li>";
    }
    ?>
</ul>

<!-- <form action="{{ route('productService') }}" method="GET">
    @csrf
    <label for="name">Tổng tiền:</label>
    <input type="text" id="name" name="tongTien" required>

    <label for="name">Khách hàng:</label>
    <input type="text" id="email" name="idKhachHang" required>

    <label for="name">Danh sách vé:</label>
    <input type="text" id="name" name="danhSachVe[]" required>

    <button type="submit">Tạo</button>
</form> -->