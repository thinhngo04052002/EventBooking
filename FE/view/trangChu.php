<?php
foreach ($data as $event) {
    echo "Tên sự kiện: " . $event['tenSuKien'] . "<br>";
    echo "Địa chỉ: " . $event['diaChi'] . "<br>";
    echo "Quốc gia: " . $event['diaDiem']['quocGia'] . "<br>";
    echo "Thành phố: " . $event['diaDiem']['thanhPho'] . "<br>";
    echo "Thể loại: " . $event['theLoai'] . "<br>";
    echo "Nơi tổ chức: " . $event['diaDiem']['noiToChuc'] . "<br>";
    echo "Trạng thái thanh toán: " . $event['thanhToan'] . "<br>";
    echo "<hr>"; // Đường kẻ ngăn cách giữa các sự kiện
}
