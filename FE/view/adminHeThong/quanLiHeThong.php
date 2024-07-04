<title> Danh sách tài khoản </title>
<?php
// Giả sử $data chứa dữ liệu đã được trả về


// Tổng số phần tử
$total_records = count($data);

// Số phần tử trên mỗi trang
$limit = 10;

// Tính tổng số trang
$total_pages = ceil($total_records / $limit);

// Xác định trang hiện tại
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_page = max(1, min($current_page, $total_pages));

// Tính toán chỉ số bắt đầu
$start_index = ($current_page - 1) * $limit;

// Lọc dữ liệu theo vai trò nếu có yêu cầu
$filter_role = isset($_GET['role']) ? $_GET['role'] : ''; // Lấy tham số 'role' từ URL

if ($filter_role !== '') {
    $filtered_data = array_filter($data, function($user) use ($filter_role) {
        return $user['vaitro'] === $filter_role;
    });
    $total_records = count($filtered_data); // Cập nhật tổng số phần tử sau khi lọc
    $total_pages = ceil($total_records / $limit); // Cập nhật tổng số trang
    $current_page_data = array_slice($filtered_data, $start_index, $limit); // Lấy dữ liệu cho trang hiện tại sau khi lọc
} else {
    // Nếu không có lọc, sử dụng dữ liệu ban đầu
    $current_page_data = array_slice($data, $start_index, $limit);
}
?>


    <style>
       h2{
        font-family: Arial, Helvetica, sans-serif;
       }

        .user-list {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border-collapse: collapse;
            font-family: Arial, Helvetica, sans-serif;
        }

        .user-list th, .user-list td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .user-list th {
            background-color: #f2f2f2;
            text-align: left;
            text-align: center;

        }

        .user-list tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .user-list tr:hover {
            background-color: #ddd;
        }

        .user-list th {
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #4CAF50;
            color: white;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 16px;
            text-decoration: none;
            color: #4CAF50;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            font-family: Arial, Helvetica, sans-serif;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }

        .filter-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .filter-buttons a {
            display: inline-block;
            margin: 0 5px;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color:#4CAF90;
            border: 1px solid #4CAF80;
            border-radius: 5px;
            cursor: pointer;
        }

        .filter-buttons a.active {
            background-color: #45a020;
            border: 1px solid #45a040;
        }
    </style>
</head>


<h2>Danh sách người dùng</h2>

<div class="filter-buttons">
    <a href="index.php?action=listUser" class="<?php echo $filter_role === '' ? 'active' : ''; ?>">Tất cả</a>
    <a href="index.php?action=listUser&role=KH" class="<?php echo $filter_role === 'KH' ? 'active' : ''; ?>">Khách hàng (KH)</a>
    <a href="index.php?action=listUser&role=ADDVSK" class="<?php echo $filter_role === 'ADDVSK' ? 'active' : ''; ?>">Đối tác (ADDVSK)</a>
    <a href="index.php?action=listUser&role=ADNT" class="<?php echo $filter_role === 'ADNT' ? 'active' : ''; ?>">Admin (ADNT)</a>
</div>

<table class="user-list">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên người dùng</th>
            <th>Email</th>
            <th>Vai trò</th>
            <th>Tình trạng</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($current_page_data as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['vaitro']; ?></td>
                <td><?php echo $user['tinhtrang']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="pagination">
    <?php if ($current_page > 1): ?>
        <a href="index.php?action=listUser&page=<?php echo $current_page - 1; ?><?php echo $filter_role !== '' ? '&role=' . $filter_role : ''; ?>">&laquo; Trang trước</a>
    <?php endif; ?>
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="index.php?action=listUser&page=<?php echo $i; ?><?php echo $filter_role !== '' ? '&role=' . $filter_role : ''; ?>" class="<?php echo $i == $current_page ? 'active' : ''; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
    <?php if ($current_page < $total_pages): ?>
        <a href="index.php?action=listUser&page=<?php echo $current_page + 1; ?><?php echo $filter_role !== '' ? '&role=' . $filter_role : ''; ?>">Trang kế &raquo;</a>
    <?php endif; ?>
</div>


