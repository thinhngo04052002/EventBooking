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
<style>
.primary-container {
    background-color: #fff;
    padding-top: 20px;
    padding-bottom: 20px;
    font-family: sans-serif;
}

/* Tạo viền bảng */
table {
    border-collapse: collapse;
    border: 2px solid #ddd;
}

thead {
    height: 50px;
    font-size: 15px;
}

/* Định dạng tiêu đề bảng */
th {
    padding: 8px;
    color: #fff;
    text-align: center;
    background-color: #007bff;
    border-bottom: 1px solid #ddd;
}

/* Định dạng nội dung bảng */
td {
    padding: 15px 5px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

/* Căn giữa bảng */
.table-container {
    display: flex;
    justify-content: center;
    font-size: 14px;
}

/* Đặt chiều rộng bảng bằng 80% chiều rộng trang */
table {
    width: 90%;
}

.search-and-filter {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
    margin-bottom: 30px;
}

.search-box {
    display: flex;
    margin-right: 20px;
}

.search-box input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px 0 0 5px;
    width: 300px;
    font-size: 16px;
}

.search-box button {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 0 5px 5px 0;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
}

.search-box button:hover {
    background-color: #0056b3;
}

.combo-box {
    display: flex;
    align-items: center;
}

.combo-box label {
    margin-right: 10px;
    font-weight: bold;
}

.combo-box select {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination a {
    display: inline-block;
    padding: 8px 16px;
    text-decoration: none;
    border: 1px solid #ddd;
    margin: 0 4px;
    border-radius: 4px;
    color: #333;
}

.pagination a.active {
    background-color: #007bff;
    color: white;
    border-color: #4CAF50;
}

.pagination a:hover:not(.active) {
    background-color: #ddd;
}
</style>



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
                <tr>
                    <td><?php echo $event['tenSuKien']; ?></td>
                    <td><?php echo $event['diaDiem']['noiToChuc']; ?></td>
                    <td><?php echo $event['diaChi']; ?></td>
                    <td><?php echo $event['diaDiem']['thanhPho']; ?></td>
                    <td><?php echo $event['theLoai']; ?></td>
                    <td><?php if (isset($event['thoiGianBatDau'])) { echo $event['thoiGianBatDau']; } else { echo ''; } ?>
                    </td>
                    <td><?php if (isset($event['thoiGianKetThuc'])) { echo $event['thoiGianKetThuc']; } else { echo ''; } ?>
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