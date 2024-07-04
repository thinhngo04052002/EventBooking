<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$answer;
?>
<?php
if (isset($answer) && ($answer !== "")) {
    print_r($answer);
}
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
    justify-content: space-around;
    gap: 20px;
}

.card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 300px;
    margin: 10px;
}

.card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.card-content {
    padding: 15px;
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
            <div class="card">
                <img src="your-image-url.jpg" alt="Event Image">
                <div class="card-content">
                    <h2>GlassTech Asia and Fenestration Asia 2024</h2>
                    <p>Saigon Exhibition and Convention Center</p>
                    <p>Free</p>
                    <p>MMI Asia Pte. Ltd</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Đánh giá</button>
                </div>
            </div>
            <div class="card">
                <img src="your-image-url.jpg" alt="Event Image">
                <div class="card-content">
                    <h2>HortEx Vietnam 2025</h2>
                    <p>Wed, Mar 12 • 9:00 AM</p>
                    <p>Saigon Exhibition and Convention Center</p>
                    <p>Free</p>
                    <p>Nova Exhibitions BV</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" >Đánh giá</button>
                </div>
            </div>
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
        <form>
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

<script>
    const exampleModal = document.getElementById('exampleModal')
    if (exampleModal) {
    exampleModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        // const recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an Ajax request here
        // and then do the updating in a callback.

        // Update the modal's content.
        const modalTitle = exampleModal.querySelector('.modal-title')
        const modalBodyInput = exampleModal.querySelector('.modal-body input')

        modalTitle.textContent = `Đánh giá sự kiện`
        modalBodyInput.value = recipient
    })
    }
</script>