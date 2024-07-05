<head>
    <title>Chi tiết vé</title>
    <link rel="stylesheet" type="text/css" href="css\TuyetCSS\chiTietVe.css">
</head>
<?php
foreach ($data['danhSachVeDaMua'] as $veDaMua) {
    if (
        $veDaMua['iDVe'] == $thongTinVe['idVe'] &&
        $veDaMua['iDSuKien'] == $thongTinVe['idsuKien'] &&
        $veDaMua['iDDoiTac'] == $thongTinVe['iddoiTac']
    ) {
        $ve = $veDaMua;
    }
}
?>

<script>
    function showConfirmationModal() {
        var modal = document.getElementById("confirmationModal");
        modal.style.display = "block";
    }

    function showConfirmationModal1() {
        var modal = document.getElementById("confirmationModal1");
        modal.style.display = "block";
    }


    function hideConfirmationModal() {
        var modal = document.getElementById("confirmationModal");
        modal.style.display = "none";
    }

    function hideConfirmationModal1() {
        var modal = document.getElementById("confirmationModal1");
        modal.style.display = "none";
    }

    function confirmCancellation() {
        // Lấy các phần tử HTML trong modal
        const modalContent = document.querySelector('#confirmationModal .modal-content');

        // Xóa nội dung cũ
        modalContent.innerHTML = '';

        // Thêm nội dung mới
        const successMessage = document.createElement('h4');
        successMessage.textContent =
            'Hủy vé thành công! Tiền vé sẽ được hoàn về cho bạn sau khi trừ đi 20% giá vé gốc trong vòng 7 ngày.';
        const closeButton = document.createElement('button');
        closeButton.textContent = 'Đóng';
        closeButton.onclick = hideConfirmationModal;

        modalContent.appendChild(successMessage);
        modalContent.appendChild(closeButton);
    }
</script>

<div class="primary-container">
    <div class="event-info">
        <h2>THÔNG TIN VÉ</h2>
        <table>
            <tr>
                <td>Tên sự kiện:</td>
                <td><?php echo $ve['tenSuKien']; ?></td>
            </tr>
            <tr>
                <td>Địa điểm tổ chức:</td>
                <td><?php echo $ve['diaDiem']['noiToChuc'] . ' ' . $ve['diaDiem']['thanhPho']; ?></td>
            </tr>
            <tr>
                <td>Thời gian bắt đầu:</td>
                <td><?php echo $ve['thoiGian']['thoiDiemBatDau']; ?></td>
            </tr>
            <tr>
                <td>Thời gian kết thúc:</td>
                <td><?php echo $ve['thoiGian']['thoiDiemKetThuc']; ?></td>
            </tr>
            <tr>
                <td>Mã vé:</td>
                <td><?php echo $ve['iDVe'] . '-' . $ve['iDSuKien'] . '-' . $ve['iDDoiTac']; ?></td>
            </tr>
            <tr>
                <td>Loại vé:</td>
                <td><?php echo $ve['loaiVe']; ?></td>
            </tr>
            <tr>
                <td>Bản đồ chỗ ngồi:</td>
                <td><a
                        href="https://cafefcdn.com/203337114487263232/2023/7/10/bp-fn-1689003518670-168900351877736541426.png">Click
                        để xem!</a></td>
            </tr>
        </table>
    </div>
    <div class="button-container">
        <button class="btn btn-doi-ve" onclick="showConfirmationModal1()">ĐỔI VÉ</button>
        <button class="btn btn-huy-ve" onclick="showConfirmationModal()">HỦY VÉ</button>
    </div>

    <div id="confirmationModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-button" onclick="hideConfirmationModal()">&times;</span>
            <p>Bạn có chắc chắn muốn hủy vé?</p>
            <button onclick="confirmCancellation()">Xác nhận</button>
        </div>
    </div>

    <div id="confirmationModal1" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-button" onclick="hideConfirmationModal1()">&times;</span>
            <p>Bạn có chắc chắn muốn đổi vé sang loại vé khác?</p>
            <button onclick="confirmCancellation1()">Xác nhận</button>
        </div>
    </div>
</div>