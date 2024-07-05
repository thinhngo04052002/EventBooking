<head>
    <title>THÔNG TIN SỰ KIỆN</title>
    <link rel="stylesheet" type="text/css" href="css\TuyetCSS\chonSuatDienLoaiVe.css">
</head>


<?php
// Kiểm tra xem $suatdien có chứa dữ liệu không
if (isset($suatdien) && is_array($suatdien) && isset($suatdien['suatDienItemDTO']) && is_array($suatdien['suatDienItemDTO'])) {
    // Lấy thông tin về các loại vé
    $loaiVe = $suatdien['suatDienItemDTO'][0]['loaiVe'];

    ?>
<div class="primary-container">
    <h2>Chọn suất diễn và loại vé cho sự kiện "<?php echo $sukien['tenSuKien'] ?>"</h2>
    <div class="choice">
        <div>
            <label for="showtime">Chọn suất diễn:</label>
            <br>
            <br>
            <select id="showtime">
                <option value="">Chọn suất diễn</option>
                <?php
                    foreach ($suatdien['suatDienItemDTO'] as $show) {
                        echo "<option value='" . $show['soThuTu'] . "'>" . $show['thoiGianBatDau'] . " - " . $show['thoiGianKetThuc'] . "</option>";
                    }
                    ?>
            </select>
        </div>
        <!-- <div>
            <label for="ticket-type">Chọn loại vé:</label>
            <br>
            <br>
            <select id="ticket-type">
                <option value="">Chọn loại vé</option>
                <?php
                foreach ($suatdien['suatDienItemDTO'][0]['loaiVe'] as $type) {
                    echo "<option value='" . $type['iDLoaiVe'] . "'>" . $type['tenLoaiVe'] . " - " . $type['giaVe'] . " VND</option>";
                }
                ?>
            </select>
        </div> -->
        <table id="chon_ve">
            <thead>
                <tr>
                    <th>Loại vé</th>
                    <th>Giá bán</th>
                    <th>Số lượng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($loaiVe as $type) {
                        echo "<tr>";
                        echo "<td>" . $type['tenLoaiVe'] . "</td>";
                        echo "<td>" . $type['giaVe'] . " VND</td>";
                        echo "<td> <button class='minus-btn'>-</button> 
                            <input type='text' value='0' class='ticket-quantity'> 
                            <button class='plus-btn'>+</button> </td>";
                        echo "</tr>";
                    } ?>
            </tbody>
        </table>
        <form method="get" action="index.php">
            <input type="hidden" name="action" value="chuanBiThanhToan" />
            <div class="button-container">
                <button class="buttonMuaVe"><b>Mua vé</b></button>
            </div>
            <input type="hidden" name="idsuKien" value="<?php echo $sukien['idsuKien']; ?>" />
            <input type="hidden" name="iddoiTac" value="<?php echo $sukien['iddoiTac']; ?>" />
        </form>
    </div>
</div>
<script>
// Thêm event listener cho các combobox
document.getElementById('showtime').addEventListener('change', function() {
    // Xử lý sự kiện khi người dùng chọn suất diễn
    console.log('Suất diễn được chọn: ', this.value);
});

// Lấy các nút tăng/giảm và số lượng
const minusBtn = document.querySelectorAll('.minus-btn');
const plusBtn = document.querySelectorAll('.plus-btn');
const quantityInput = document.querySelectorAll('.ticket-quantity');

// Thêm sự kiện click cho các nút tăng/giảm
minusBtn.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        let quantity = parseInt(quantityInput[index].value);
        if (quantity > 0) {
            quantityInput[index].value = quantity - 1;
        }
    });
});

plusBtn.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        let quantity = parseInt(quantityInput[index].value);
        quantityInput[index].value = quantity + 1;
    });
});
</script>
<?php
} else {
    echo '<div class="primary-container">';
    echo '<br><br><br>';
    echo '<h2>Hiện không có suất diễn nào cho sự kiện này!</h2>';
    echo '<br><br><br>';
    echo '</div>';
}
?>