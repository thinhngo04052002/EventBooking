<head>
    <title>THÔNG TIN SỰ KIỆN</title>
    <link rel="stylesheet" type="text/css" href="css\TuyetCSS\chonSuatDienLoaiVe.css">
</head>


<?php
// Kiểm tra xem người dùng đã đăng nhập chưa, nếu chưa chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['id'])) {
    // Chuyển hướng đến trang index.php
    header("Location: index.php?action=dangNhap");
    exit(); // Dừng thực thi các đoạn mã khác sau khi chuyển hướng
}
// Kiểm tra xem $suatdien có chứa dữ liệu không
if (isset($suatdien) && is_array($suatdien) && isset($suatdien['suatDienItemDTO']) && is_array($suatdien['suatDienItemDTO'])) {
    // Lấy thông tin về các loại vé
    $loaiVe = $suatdien['suatDienItemDTO'][0]['loaiVe'];

?>
    <script>
        function updateSelectedShowtime() {
            var showtimeSelect = document.getElementById('showtime');
            var selectedShowtime = showtimeSelect.options[showtimeSelect.selectedIndex].value;
            document.getElementById('selectedShowtime').value = selectedShowtime;
        }

        function updateQuantity(button, change) {
            var quantityInput = button.parentElement.querySelector('.ticket-quantity');
            var currentQuantity = parseInt(quantityInput.value);
            var newQuantity = currentQuantity + change;
            if (newQuantity >= 0) {
                quantityInput.value = newQuantity;
            }
        }

        function submitForm() {
            var ticketQuantities = document.querySelectorAll('.ticket-quantity');
            var ticketData = [];

            ticketQuantities.forEach(function(input) {
                var ticketId = input.getAttribute('data-id');
                var quantity = input.value;
                if (quantity > 0) {
                    var price = input.parentElement.previousElementSibling.getAttribute('data-price');
                    var name = input.parentElement.previousElementSibling.previousElementSibling.getAttribute(
                        'data-name');
                    ticketData.push({
                        id: ticketId,
                        soLuong: quantity,
                        giaVe: price,
                        tenLoaiVe: name
                    });
                }
            });

            document.getElementById('ticketData').value = JSON.stringify(ticketData);
            document.getElementById('ticketForm').submit();
        }
    </script>
    <div class="primary-container">
        <h2>Chọn suất diễn và loại vé cho sự kiện "<?php echo $sukien['tenSuKien'] ?>"</h2>
        <div class="ccce">
            <div>
                <select id="showtime" onchange="updateSelectedShowtime()">
                    <option value="">Chọn suất diễn</option>
                    <?php foreach ($suatdien['suatDienItemDTO'] as $show) {
                        echo "<option value='" . $show['soThuTu'] . "'>" . $show['thoiGianBatDau'] . " - " . $show['thoiGianKetThuc'] . "</option>";
                    } ?>
                </select>
            </div>
            <!-- <?php
                    // foreach ($suatdien['suatDienItemDTO'][0]['loaiVe'] as $type) {
                    //     echo "<option value='" . $type['iDLoaiVe'] . "'>" . $type['tenLoaiVe'] . " - " . $type['giaVe'] . " VND</option>";
                    // }
                    ?> -->
            <table id="chon_ve">
                <thead>
                    <tr>
                        <th>Loại vé</th>
                        <th>Giá bán</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($loaiVe as $type) {
                        echo "<tr>";
                        echo "<td class='ticket-price' data-name='" . $type['tenLoaiVe'] . "'>" . $type['tenLoaiVe'] . "</td>";
                        echo "<td class='ticket-price' data-price='" . $type['giaVe'] . "'>" . $type['giaVe'] . " VND</td>";
                        echo "<td> 
                            <button type='button' class='minus-btn' onclick='updateQuantity(this, -1)'>-</button> 
                            <input type='text' value='0' class='ticket-quantity' data-id='" . $type['iDLoaiVe'] . "' readonly> 
                            <button type='button' class='plus-btn' onclick='updateQuantity(this, 1)'>+</button> 
                          </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <form method="get" action="index.php" id="ticketForm">
                <input type="hidden" name="action" value="chuanBiThanhToan" />
                <input type="hidden" name="idsuKien" value="<?php echo $sukien['idsuKien']; ?>" />
                <input type="hidden" name="iddoiTac" value="<?php echo $sukien['iddoiTac']; ?>" />
                <input type="hidden" name="idsuatdien" id="selectedShowtime" />
                <input type="hidden" name="veDaChon" id="ticketData" />

                <div class="button-container">
                    <button class="buttonMuaVe" type="button" onclick="submitForm()"><b>Mua vé</b></button>
                </div>
            </form>
        </div>
    </div>
<?php
} else {
    echo '<div class="primary-container">';
    echo '<br><br><br>';
    echo '<h2>Hiện không có suất diễn nào cho sự kiện này!</h2>';
    echo '<br><br><br>';
    echo '</div>';
}
?>