<head>
    <title>THÔNG TIN SỰ KIỆN</title>
    <link rel="stylesheet" type="text/css" href="css\TuyetCSS\chiTietSuKien.css">
</head>

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
            </table>
        </div>
        <div class="event-description">
            <p><?php echo $sukien['thongTinSuKien']; ?></p>
        </div>
    </div>
    <div class="cta">
        <a href="#" class="btn">Mua vé ngay!</a>
    </div>
</div>