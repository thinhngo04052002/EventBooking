<?php
$answer;
$data;
?>
<?php
//việt nam
$jsonContent_vietNam = file_get_contents('vietNam.json');
$data_vn = json_decode($jsonContent_vietNam, true);
if ($data_vn === null && json_last_error() !== JSON_ERROR_NONE) {
    die('Lỗi khi đọc file JSON');
}
//các nước trên thế giới
$jsonContent_country = file_get_contents('country-by-cities.json');
$data_country = json_decode($jsonContent_country, true);
if ($data_country === null && json_last_error() !== JSON_ERROR_NONE) {
    die('Lỗi khi đọc file JSON');
}

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
<form id="uploadForm" class="form-container" action="index.php" method="post" enctype="multipart/form-data">
    <h1>Thông tin doanh nghiệp</h1>
    <div class="form-group1" style="height: 413px;">
        <div class="upload-container">
            <input type="file" id="eventImageInput" name="eventImageInput" style="display:none; " accept="image/*" />
            <div class="upload-box" style="width: 275px; height: 275px;" id="uploadBox">
                <img src="css/images/image_icon.png" alt="Icon" class="upload-icon" id="uploadIcon">
                <p id="uploadText">Ảnh logo doanh nghiệp</p>
                <p>(275x275)</p>
            </div>
            <p id="errorMessage" class="error-message"></p>
        </div>

        <div class="form-group2">
            <div class="form-group">
                <label for="tendoitac">Tên doanh nghiệp</label>
                <input type="text" id="tendoitac" name="tendoitac" placeholder="Ví dụ: IME">
            </div>
            <div class="form-group">
                <label for="sdt">Số điện thoại</label>
                <input type="text" id="sdt" name="sdt" placeholder="Ví dụ: 0123456789">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Ví dụ: 1525@gmail.com">
            </div>
            <div class="form-group">
                <label for="nguoidaidien">Người đại diện</label>
                <input type="text" id="nguoidaidien" name="nguoidaidien" placeholder="Ví dụ: Lê Văn A">
            </div>
            <div class="form-group">
                <label for="masothue">Mã số thuế</label>
                <input type="text" id="masothue" name="masothue" placeholder="Ví dụ: 0123456789">
            </div>
        </div>
    </div>



    <label for="country">Địa chỉ</label>
    <div class="form-group1" style="height: 165x;">

        <div class="form-group2" style="margin-left: 40px;">
            <div class="form-group">
                <select id="QuocGia" value="" name="QuocGia" required onchange="updateCityList(this.value)">
                    <option value="">Quốc gia</option>
                    <?php foreach ($data_country as $key => $country) : ?>
                        <option value="<?php echo $country['country']; ?>"><?php echo $country['country']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <select id="QuanHuyen" name="QuanHuyen" required onchange="updateWardList(this.value,citycodeGlobal)">
                    <option value="">Quận/Huyện</option>
                </select>
            </div>


        </div>

        <div class="form-group2">

            <div class="form-group">
                <select id="ThanhPho" name="ThanhPho" required onchange="updateDistrictList(this.value)">
                    <option value="">Thành Phố/Tỉnh</option>
                </select>
            </div>
            <div class="form-group">
                <select id="PhuongXa" name="PhuongXa" required>
                    <option value="">Phường/Xã</option>
                </select>
            </div>

        </div>
    </div>
    <div style="text-align: left; margin-left:47px; ">
        <input style="width:46%;margin-right:65px;" type="text" id="soNhaTenDuong" name="soNhaTenDuong" placeholder="Số nhà, tên đường">
        <!-- <button class="btn" type="submit">Lưu</button> -->
        <input class="btn" type="button" value="Lưu" onclick=" return check()">
        <input type="hidden" name="action" value="thongTinDoanhNghiepClick" />
    </div>

    <?php
    if (isset($answer) && ($answer['status_code'] == 200)) {
    ?>
        <p class="success-message">Đăng kí thành công</p>
    <?php
    } else if (isset($answer) && ($answer['status_code'] != 200)) {
    ?>
        <p class="error-message">Đăng kí không thành công</p>
    <?php
    } ?>
</form>
<script>
    function check() {
        console.log("kiểm tra hàm check");
        // Kiểm tra các điều kiện trước khi submit
        const tendoitac = document.getElementById('tendoitac').value;
        const sdt = document.getElementById('sdt').value;
        const email = document.getElementById('email').value;
        const nguoidaidien = document.getElementById('nguoidaidien').value;
        const masothue = document.getElementById('masothue').value;
        const PhuongXa = document.getElementById('PhuongXa').value;
        const ThanhPho = document.getElementById('ThanhPho').value;
        const QuanHuyen = document.getElementById('QuanHuyen').value;
        const QuocGia = document.getElementById('QuocGia').value;
        const soNhaTenDuong = document.getElementById('soNhaTenDuong').value;
        const eventImageInput = document.getElementById('eventImageInput').files[0];

        if (!tendoitac || !PhuongXa || !sdt || !email || !nguoidaidien || !masothue || !QuocGia || !ThanhPho || !QuanHuyen || !soNhaTenDuong) {
            document.getElementById('responseMessage').textContent = 'Vui lòng điền đầy đủ thông tin.';
            return;
        }

        if (!eventImageInput) {
            document.getElementById('responseMessage').textContent = 'Vui lòng chọn ảnh nền sự kiện.';
            return;
        }
        document.getElementById('uploadForm').submit();
    }
</script>
<script>
    function updateCityList(countryCode) {
        var cityList = document.getElementById("ThanhPho");
        cityList.innerHTML = "";

        // Thêm tùy chọn mặc định
        var chonThanhPho = document.createElement("option");
        chonThanhPho.textContent = "Thành Phố/Tỉnh";
        chonThanhPho.value = "";
        cityList.appendChild(chonThanhPho);

        // Lấy danh sách thành phố tương ứng với quốc gia đã chọn
        var cityData;
        if (countryCode == 'Vietnam') {
            // console.log(countryCode);
            // Nếu quốc gia là Việt Nam, lấy dữ liệu từ file JSON Việt Nam
            cityData = <?php echo json_encode($data_vn); ?>;
            for (var code in cityData) {
                if (cityData.hasOwnProperty(code)) {
                    console.log(countryCode);
                    var option = document.createElement("option");
                    option.value = cityData[code].name;
                    option.textContent = cityData[code].name;
                    cityList.appendChild(option);
                }
            }
        } else {
            // Nếu không phải Việt Nam, lấy dữ liệu từ $data_country
            cityData = <?php echo json_encode($data_country); ?>;
            for (var i = 0; i < cityData.length; i++) {
                if (cityData[i].country == countryCode) {
                    var cities = cityData[i].cities;
                    for (var j = 0; j < cities.length; j++) {
                        var option = document.createElement("option");
                        option.value = cities[j];
                        option.textContent = cities[j];
                        cityList.appendChild(option);
                    }
                    break;
                }
            }
        }
    }
    // cập nhật danh sách quận/huyện
    function updateDistrictList(cityCode) {
        // console.log("Selected city code:", cityCode);
        citycodeGlobal = cityCode;
        var districtList = document.getElementById("QuanHuyen");
        districtList.innerHTML = "";

        // Thêm tùy chọn mặc định
        var chonQuanHuyen = document.createElement("option");
        chonQuanHuyen.textContent = "Quận/Huyện";
        chonQuanHuyen.value = "";
        districtList.appendChild(chonQuanHuyen);

        // Lấy danh sách quận/huyện tương ứng với thành phố đã chọn
        var districtData = <?php echo json_encode($data_vn); ?>;
        // console.log("District data:", districtData);
        for (var code_city in districtData) {
            if (districtData[code_city].name == cityCode) {
                var districts = districtData[code_city]["quan-huyen"];
                // console.log("Districts:", districts);

                for (var code in districts) {
                    if (districts.hasOwnProperty(code)) {
                        var option = document.createElement("option");
                        option.value = districts[code].name;
                        option.textContent = districts[code].name;
                        districtList.appendChild(option);
                    }
                }
                break;
            }
        }

    }
    // cập nhật danh sách phường/xã
    function updateWardList(districtCode, citycodeGlobal) {
        var wardList = document.getElementById("PhuongXa");
        wardList.innerHTML = "";
        // Thêm tùy chọn mặc định
        var chonPhuongXa = document.createElement("option");
        chonPhuongXa.textContent = "Phường/Xã";
        chonPhuongXa.value = "";
        wardList.appendChild(chonPhuongXa);

        // Lấy danh sách Phường/Xã tương ứng với thành phố đã chọn
        var districtData = <?php echo json_encode($data_vn); ?>;
        for (var code_city in districtData) {
            if (districtData[code_city].name == citycodeGlobal) {
                var districts = districtData[code_city]["quan-huyen"];

                for (var code in districts) {
                    if (districts[code].name === districtCode) {
                        var wards = districts[code]["xa-phuong"];
                        for (var code_ward in wards) {
                            if (wards.hasOwnProperty(code_ward)) {
                                var option = document.createElement("option");
                                option.value = wards[code_ward].name;
                                option.textContent = wards[code_ward].name;
                                wardList.appendChild(option);
                            }
                        }
                        break;
                    }

                }
                break;
            }
        }
    }
</script>
<script>
    document.getElementById('uploadBox').addEventListener('click', function() {
        document.getElementById('eventImageInput').click();
    });

    document.getElementById('eventImageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const img = new Image();
            img.onload = function() {
                if (img.width === 275 && img.height === 275) {
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
                    errorMessage.textContent = 'Kích thước ảnh không đúng. Vui lòng chọn ảnh có kích thước 275x275.';
                    document.getElementById('eventImageInput').value = ''; // Clear the file input
                }
            };
            img.src = URL.createObjectURL(file);
        }
    });
</script>