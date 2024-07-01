<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
?>
<form class="form-container" action="upload.php" method="post" enctype="multipart/form-data">
    <h1>Sự kiện</h1>
    <div class="upload-container">
        <input type="file" id="eventImageInput" style="display:none;" accept="image/*" />
        <div class="upload-box" id="uploadBox">
            <img src="css/images/image_icon.png" alt="Icon" class="upload-icon" id="uploadIcon">
            <p id="uploadText">Thêm ảnh nền sự kiện</p>
            <p>(1280x720)</p>
        </div>
        <p id="errorMessage" class="error-message"></p>
    </div>



    <label for="event_name">Tên sự kiện</label>
    <input type="text" id="event_name" name="event_name">

    <label for="category">Thể loại</label>
    <select id="category" name="category">
        <option value="">-- chọn --</option>
        <option value="Nhạc sống">Nhạc sống</option>
        <option value="Sân khấu">Sân khấu</option>
        <option value="Cải lương">Cải lương</option>
        <option value="Hài kịch">Hài kịch</option>
        <option value="Thể thao">Thể thao</option>
        <option value="Show giải trí">Show giải trí</option>
        <option value="Khác">Khác</option>
    </select>

    <label for="address">Địa chỉ</label>
    <input type="text" id="address" name="address">

    <label for="venue">Nơi tổ chức</label>
    <input type="text" id="venue" name="venue" placeholder="ví dụ: sân vận động Mỹ Đình">

    <label for="event_info">Thông tin sự kiện</label>
    <textarea id="event_info" name="event_info"></textarea>

    <input id="btnSuKien" type="submit" value="Trang sau">
</form>
<script>
    document.getElementById('uploadBox').addEventListener('click', function() {
        document.getElementById('eventImageInput').click();
    });

    document.getElementById('eventImageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const img = new Image();
            img.onload = function() {
                if (img.width === 1280 && img.height === 720) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const uploadBox = document.getElementById('uploadBox');
                        const uploadIcon = document.getElementById('uploadIcon');
                        const uploadText = document.getElementById('uploadText');
                        const errorMessage = document.getElementById('errorMessage');

                        // Remove existing content
                        uploadBox.innerHTML = '';

                        // Create new image element
                        const uploadedImage = document.createElement('img');
                        uploadedImage.src = e.target.result;
                        uploadedImage.classList.add('uploaded-image');

                        // Append the new image
                        uploadBox.appendChild(uploadedImage);

                        // Clear error message
                        errorMessage.textContent = '';
                    };
                    reader.readAsDataURL(file);
                } else {
                    const errorMessage = document.getElementById('errorMessage');
                    errorMessage.textContent = 'Kích thước ảnh không đúng. Vui lòng chọn ảnh có kích thước 1280x720.';
                    document.getElementById('eventImageInput').value = ''; // Clear the file input
                }
            };
            img.src = URL.createObjectURL(file);
        }
    });
</script>