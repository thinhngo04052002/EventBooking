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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
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
    <!-- <div class="form-container">
        <div class="filterForm">
            <form action="index.php" method="GET" id="filterSuKienCuaKH">
                <select id="selectFilter" name="keyWord">
                    <option value="">--chọn--</option>
                    <option value="allTask">Tất cả</option>
                    <option value="nearingDeadline">Đã đánh giá</option>
                    <option value="finishedTask">Chưa đánh giá</option>
                    <input class="btnFilter" type="submit" value="Lọc">
                    <input type="hidden" name="action" value="filterSuKienCuaKH" />
                </select>
            </form>
        </div>
    </div> -->


    <div class="container">
    <?php if (isset($data['danhSachVeDaMua'])): ?>
        <?php foreach ($data['danhSachVeDaMua'] as $ticket): ?>
            <div class="card">
                <!-- <img src="your-image-url.jpg" alt="Event Image"> -->
                <div class="card-content">
                    <h2><?php echo htmlspecialchars($ticket['tenSuKien']); ?></h2>
                    <p><?php echo htmlspecialchars($ticket['diaDiem']['noiToChuc']); ?> --- <?php echo htmlspecialchars($ticket['diaDiem']['thanhPho']); ?> --- <?php echo htmlspecialchars($ticket['diaDiem']['quocGia']); ?></p>
                    <p><?php echo htmlspecialchars($ticket['thoiGian']['thoiDiemBatDau']); ?> - <?php echo htmlspecialchars($ticket['thoiGian']['thoiDiemKetThuc']); ?></p>
                    <p><?php echo htmlspecialchars($ticket['loaiVe']); ?></p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    data-idnd="<?php echo htmlspecialchars($_SESSION['id']); ?>"
                    data-idsk="<?php echo htmlspecialchars($ticket['iDSuKien']); ?>">Đánh giá</button>
                    <a href="index.php?action=danhGia1&idsk=<?php echo $ticket['iDSuKien']; ?>" class="btn btn-primary">Xem đánh giá</a>
                </div>
            </div>
            
        <?php endforeach; ?>
        <?php else: ?>
            <p>Không có vé nào được tìm thấy.</p> 
        <?php endif; ?>     
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Đánh giá</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="reviewForm" method="post" action="index.php?action=submitDanhGia">
        <input type="hidden" name="idnd" id="idnd">
        <input type="hidden" name="idsk" id="idsk">
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Gửi</button>
      </div>
    </div>
  </div>
</div>


<!-- <script>
    const exampleModal = document.getElementById('exampleModal')
    if (exampleModal) {
    exampleModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        // const recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an Ajax request here
        // and then do the updating in a callback.
        const idnd = button.getAttribute('data-idnd');
        const idsk = button.getAttribute('data-idsk');

        // Update the modal's content.
        const modalTitle = exampleModal.querySelector('.modal-title')
        const modalBodyInput = exampleModal.querySelector('.modal-body input')

        modalTitle.textContent = `Đánh giá sự kiện`
        modalBodyInput.value = recipient
    })
    }
</script> -->
<script>
    const exampleModal = document.getElementById('exampleModal');
    if (exampleModal) {
        exampleModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const idnd = button.getAttribute('data-idnd');
            const idsk = button.getAttribute('data-idsk');

            const modal = exampleModal;
            modal.querySelector('#idnd').value = idnd;
            modal.querySelector('#idsk').value = idsk;
        });

        document.getElementById('submitReviewButton').addEventListener('click', () => {
            document.getElementById('reviewForm').submit();
        });
    }
</script>



