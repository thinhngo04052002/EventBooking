<head>
    <title>THÔNG TIN SỰ KIỆN</title>
    <link rel="stylesheet" type="text/css" href="css\TuyetCSS\chiTietSuKien.css">
</head>
<?php
// Kiểm tra xem $suatdien có chứa dữ liệu không
if (isset($suatdien) && is_array($suatdien) && isset($suatdien['suatDienItemDTO']) && is_array($suatdien['suatDienItemDTO'])) {
    // Lấy thông tin về các loại vé
    $loaiVe = $suatdien['suatDienItemDTO'][0]['loaiVe'];
}
?>
<div class="primary-container">
    <h1>THÔNG TIN SỰ KIỆN</h1>
    <div class="event-info-container">
        <div class="event-info">
            <table>
                <tr>
                    <th>Tên sự kiện:</th>
                    <td><?php echo $sukien['tenSuKien']; ?></td>
                </tr>
                <tr>
                    <th>Địa điểm tổ chức:</th>
                    <td><?php echo $sukien['diaDiem']['noiToChuc']; ?></td>
                </tr>
                <tr>
                    <th>Địa chỉ:</th>
                    <td><?php echo $sukien['diaChi']; ?></td>
                </tr>
                <tr>
                    <th>Thể loại:</th>
                    <td><?php echo $sukien['theLoai']; ?></td>
                </tr>
                <tr>
                    <th>Thời gian bắt đầu:</th>
                    <td><?php if (isset($sukien['thoiGianBatDau'])) {
                        echo $sukien['thoiGianBatDau'];
                    } else {
                        echo '';
                    } ?></td>
                </tr>
                <tr>
                    <th>Thời gian kết thúc:</th>
                    <td><?php if (isset($sukien['thoiGianKetThuc'])) {
                        echo $sukien['thoiGianKetThuc'];
                    } else {
                        echo '';
                    } ?></td>
                </tr>
                <tr>
                    <th>Thông tin vé:</th>
                    <td>
                        <table id="thong-tin-ve">
                            <tr>
                                <th>Loại vé</th>
                                <th>Giá vé</th>
                            </tr>
                            <?php
                            // Kiểm tra xem $suatdien có chứa 'suatDienItemDTO' không
                            if (isset($suatdien['suatDienItemDTO']) && is_array($suatdien['suatDienItemDTO'])) {
                                // Kiểm tra xem 'suatDienItemDTO' có chứa 'loaiVe' không
                                if (isset($suatdien['suatDienItemDTO'][0]['loaiVe']) && is_array($suatdien['suatDienItemDTO'][0]['loaiVe'])) {
                                    // Lặp qua các loại vé và in ra tên và giá vé
                                    foreach ($suatdien['suatDienItemDTO'][0]['loaiVe'] as $ve) {
                                        if (isset($ve['tenLoaiVe']) && isset($ve['giaVe'])) {
                                            echo "<tr><td>" . $ve['tenLoaiVe'] . "</td><td>" . $ve['giaVe'] . "</td></tr>";
                                        }
                                    }
                                }
                            }
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div class="event-description">
            <div>
                <p><?php echo $sukien['thongTinSuKien']; ?></p>
            </div>
            <br>
            <i>
                <div class="event-note">
                    <p><b>Lưu ý</b></p>
                    <p>Quý khách sẽ được ban tổ chức gửi thông tin vé và xác nhận đặt chỗ thành công!</p>
                </div>
            </i>
        </div>
    </div>
    <div class="cta">
        <a href="index.php?action=chonSuatDienLoaiVe&idsuKien=<?php echo $sukien['idsuKien']?>&iddoiTac=<?php echo $sukien['iddoiTac']?>"
            class="btn">Mua vé ngay!</a>
    </div>
</div>