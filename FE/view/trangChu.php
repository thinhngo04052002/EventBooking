<?php
$events = $sukien;

// Số sự kiện hiển thị trên mỗi trang
$eventsPerPage = 3;

// Tính tổng số sự kiện
$totalEvents = count($events);

// Tính tổng số trang
$totalPages = ceil($totalEvents / $eventsPerPage);

// Lấy số trang hiện tại từ tham số URL (ví dụ: ?page=2)
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

$url = "index.php?action=home&page=";
$pagination = "<div class='pagination'>";
for ($i = 1; $i <= $totalPages; $i++) {
    $pagination .= "<a href='" . $url . $i . "' class='" . ($currentPage == $i ? 'active' : '') . "'>$i</a>";
}
$pagination .= "</div>";

// Tính vị trí bắt đầu của sự kiện trên trang hiện tại
$startIndex = ($currentPage - 1) * $eventsPerPage;

// Lấy các sự kiện cho trang hiện tại
$eventsOnPage = array_slice($events, $startIndex, $eventsPerPage);
?>

<head>
    <title>Trang chủ</title>
    <link rel="stylesheet" type="text/css" href="css\TuyetCSS\trangChu.css">
</head>


<!-- html -->
<div class="primary-container">
    <div class="search-and-filter">
        <div class="search-box">
            <input type="text" placeholder="Tìm kiếm sự kiện..." />
            <button>Tìm</button>
        </div>
        <div class="combo-box">
            <label for="city">Địa điểm:</label>
            <select id="city">
                <option value="">Toàn quốc</option>
                <option value="ha-noi">Hà Nội</option>
                <option value="da-nang">Đà Nẵng</option>
                <option value="ho-chi-minh">Hồ Chí Minh</option>
            </select>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Tên sự kiện</th>
                    <th>Nơi tổ chức</th>
                    <th>Địa chỉ</th>
                    <th>Thành phố</th>
                    <th>Thể loại</th>
                    <th>Thời điểm bắt đầu</th>
                    <th>Thời điểm kết thúc</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventsOnPage as $event): ?>
                <tr data-id="<?php echo 'idsuKien=' . $event['idsuKien'] . '&iddoiTac=' . $event['iddoiTac']; ?>">
                    <td><?php echo $event['tenSuKien']; ?></td>
                    <td><?php echo $event['diaDiem']['noiToChuc']; ?></td>
                    <td><?php echo $event['diaChi']; ?></td>
                    <td><?php echo $event['diaDiem']['thanhPho']; ?></td>
                    <td><?php echo $event['theLoai']; ?></td>
                    <td><?php if (isset($event['thoiGianBatDau'])) {
                            echo $event['thoiGianBatDau'];
                        } else {
                            echo '';
                        } ?>
                    </td>
                    <td><?php if (isset($event['thoiGianKetThuc'])) {
                            echo $event['thoiGianKetThuc'];
                        } else {
                            echo '';
                        } ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
    echo $pagination;
    ?>
</div>

<script>
// Thêm sự kiện click vào các dòng <tr>
var rows = document.querySelectorAll('.table-container tbody tr');
rows.forEach(function(row) {
    row.addEventListener('click', function() {
        var eventId = this.getAttribute('data-id');
        // Chuyển hướng đến view mới với ID của sự kiện
        uri = 'index.php?action=chiTietSuKien&' + eventId;
        window.location.href = uri;
    });
});
</script>