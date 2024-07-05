<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();

}
// $answer;

?>
<?php
// if (isset($answer) && ($answer !== "")) {
//     print_r($answer);
// }
?>

<style>

/* Đặt kiểu cho container của form */
.form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 30px; /* Chiều cao toàn bộ trang */
    width: 495px
    background-color: white;
    padding: 0px;
    border: none;
}

/* Đặt kiểu cho form */
.filterForm {
    background: #fff;
    /* padding: 20px; */
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
}

/* Đặt kiểu cho select và button nằm ngang nhau */
#selectFilter {
    padding: 10px;
    margin-right: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    width: 320px;
}

/* Đặt kiểu cho button */
.btnFilter {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.btn btn-primary {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-bottom: 10px;
}

.btn-primary {
    margin-bottom: 10px;
}

/* Đổi màu button khi hover */
.btnFilter:hover {
    background-color: #0056b3;
}

.btn btn-primary:hover {
    background-color: #0056b3;
}


body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 20px;
}

.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    gap: 20px;
}

.card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 300px;
    margin: 10px;
    padding: -10px;

}

.card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.card-content {
    padding: 15px;
}

.card-content h2{
    text-align: center;
}

.card h2 {
    font-size: 1.2em;
    margin: 0 0 10px 0;
}

.card p {
    color: #555;
    margin: 5px 0;
}

.all {
    display: flex;
}
</style>
<div class= all>


    <div class="container">
    <?php if (isset($data['danhSachVeDaMua'])): ?>
        <?php foreach ($data['danhSachVeDaMua'] as $ticket): ?>
            <div class="card">
                <!-- <img src="your-image-url.jpg" alt="Event Image"> -->
                <div class="card-content">
                    <h2><?php echo htmlspecialchars($ticket['tenSuKien']); ?></h2>
                    <p><strong>Địa điểm:</strong> <?php echo htmlspecialchars($ticket['diaDiem']['noiToChuc']); ?> --- <?php echo htmlspecialchars($ticket['diaDiem']['thanhPho']); ?> --- <?php echo htmlspecialchars($ticket['diaDiem']['quocGia']); ?></p>
                    <p><strong>Thời gian:</strong> <?php echo htmlspecialchars($ticket['thoiGian']['thoiDiemBatDau']); ?> - <?php echo htmlspecialchars($ticket['thoiGian']['thoiDiemKetThuc']); ?></p>
                    <p><strong>Loại vé:</strong> <?php echo htmlspecialchars($ticket['loaiVe']); ?></p>
                    <p><strong>Giá tiền:</strong> <?php echo htmlspecialchars($ticket['giaBan']); ?></p>
                </div>
            </div>
            
        <?php endforeach; ?>
        <?php else: ?>
            <p>Không có vé nào được tìm thấy.</p> 
        <?php endif; ?>     
    </div>
</div>