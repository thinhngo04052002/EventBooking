<?php
session_start(); // Bắt đầu session
$answer;
?>
<style>
    .form-group {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .form-group label {
        flex: 1;
        text-align: left;
    }

    .form-group input,
    .form-group select {
        flex: 2;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-left: 10px;
    }

    .form-group img {
        max-width: 100%;
        height: auto;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .btn {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #45a049;
    }


    .form-group1 {
        display: flex;
        align-items: flex-start;
        align-items: center;
        /* Align items to the start */
        gap: 20px;
        /* Optional: Add some space between the two columns */
    }

    .form-group2 {
        /* margin-top: 187px; */
        margin-right: 40px;
    }

    .upload-container {
        margin-top: 0;
    }

    .upload-container,
    .form-group2 {
        flex: 1;
    }

    #address .btn {
        flex: 1;
    }
</style>
<form id="uploadForm" class="form-container" action="index.php" method="post">
    <h1>Thông tin doanh nghiệp</h1>
    <div class="form-group1" style="height: 413px;">
        <div class="upload-container">
            <input type="file" id="eventImageInput" style="display:none; " accept="image/*" />
            <div class="upload-box" style="width: 275px; height: 275px;" id="uploadBox">
                <img src="css/images/image_icon.png" alt="Icon" class="upload-icon" id="uploadIcon">
                <p id="uploadText">Ảnh logo doanh nghiệp</p>
                <p>(275x275)</p>
            </div>
            <p id="errorMessage" class="error-message"></p>
        </div>
        <div class="form-group2">
            <div class="form-group">
                <label for="company_name">Tên doanh nghiệp</label>
                <input type="text" id="company_name" placeholder="Ví dụ: IME">
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" id="phone" placeholder="Ví dụ: 0123456789">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Ví dụ: 1525@gmail.com">
            </div>
            <div class="form-group">
                <label for="representative">Người đại diện</label>
                <input type="text" id="representative" placeholder="Ví dụ: Lê Văn A">
            </div>
            <div class="form-group">
                <label for="tax_code">Mã số thuế</label>
                <input type="text" id="tax_code" placeholder="Ví dụ: 0123456789">
            </div>
        </div>
    </div>



    <label for="country">Địa chỉ</label>
    <div class="form-group1" style="height: 165x;">

        <div class="form-group2" style="margin-left: 40px;">
            <div class="form-group">
                <select id="country">
                    <option value="">Quốc gia</option>
                    <option value="vietnam">Việt Nam</option>
                    <!-- Thêm các quốc gia khác tại đây -->
                </select>
            </div>

            <div class="form-group">
                <select id="city">
                    <option value="">Thành Phố/Tỉnh</option>
                    <option value="hcm">Hồ Chí Minh</option>
                    <!-- Thêm các thành phố/tỉnh khác tại đây -->
                </select>
            </div>

        </div>

        <div class="form-group2">
            <div class="form-group">
                <select id="district">
                    <option value="">Quận/Huyện</option>
                    <option value="tanbinh">Tân Bình</option>
                    <!-- Thêm các quận/huyện khác tại đây -->
                </select>
            </div>

            <div class="form-group">
                <select id="ward">
                    <option value="">Phường/Xã</option>
                    <option value="tanbinh">Tân Bình</option>
                    <!-- Thêm các Phường/Xã khác tại đây -->
                </select>
            </div>

        </div>
    </div>
    <div style="text-align: left; margin-left:47px; ">
        <input style="width:46%;margin-right:65px;" type="text" id="address" placeholder="Số nhà, tên đường">
        <button class="btn" type="submit">Lưu</button>
        <input type="hidden" name="action" value="clickAddTask" />
    </div>

    <?php
    if (isset($answer) && ($answer == 1)) {
    ?>
        <p class="success-message">Đăng kí thành công</p>
    <?php
    } else if (isset($answer) && ($answer == 0)) {
    ?>
        <p class="error-message">Đăng kí không thành công</p>
    <?php
    } ?>
</form>
<script>
    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Kiểm tra các điều kiện trước khi submit
        const companyName = document.getElementById('company_name').value;
        const phone = document.getElementById('phone').value;
        const email = document.getElementById('email').value;
        const representative = document.getElementById('representative').value;
        const taxCode = document.getElementById('tax_code').value;
        const country = document.getElementById('country').value;
        const city = document.getElementById('city').value;
        const district = document.getElementById('district').value;
        const address = document.getElementById('address').value;
        const eventImageInput = document.getElementById('eventImageInput').files[0];

        if (!companyName || !phone || !email || !representative || !taxCode || !country || !city || !district || !address) {
            document.getElementById('responseMessage').textContent = 'Vui lòng điền đầy đủ thông tin.';
            return;
        }

        if (!eventImageInput) {
            document.getElementById('responseMessage').textContent = 'Vui lòng chọn ảnh nền sự kiện.';
            return;
        }

    });
</script>