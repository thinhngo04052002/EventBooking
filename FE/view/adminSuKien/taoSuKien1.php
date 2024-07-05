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
<script>
    var citycodeGlobal = "";
</script>
<form id="taoSuKien1" class="form-container" style="padding: 20px 20px 59px 20px  ;" action="index.php" method="post" enctype="multipart/form-data">

    <h1>Sự kiện</h1>
    <div class="upload-container">
        <input name="AnhNenSuKien" type="file" id="eventImageInput" style="display:none;" accept="image/*" />
        <div class="upload-box" style="width: 1280px; height: 720px;" id="uploadBox">
            <img src="css/images/image_icon.png" alt="Icon" class="upload-icon" id="uploadIcon">
            <p id="uploadText">Thêm ảnh nền sự kiện</p>
            <p>(1280x720)</p>
        </div>
        <p id="errorMessage" class="error-message"></p>
    </div>



    <label for="TenSuKien">Tên sự kiện</label>
    <input type="text" value="" id="TenSuKien" name="TenSuKien" required>

    <label for="TheLoai">Thể loại</label>
    <select id="TheLoai" name="TheLoai" required>
        <option value="">-- chọn --</option>
        <option value="Nhạc sống">Nhạc sống</option>
        <option value="Sân khấu">Sân khấu</option>
        <option value="Cải lương">Cải lương</option>
        <option value="Hài kịch">Hài kịch</option>
        <option value="Thể thao">Thể thao</option>
        <option value="Show giải trí">Show giải trí</option>
        <option value="Khác">Khác</option>
    </select>

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
                <select id="ThanhPho" name="ThanhPho" required onchange="updateDistrictList(this.value)">
                    <option value="">Thành Phố/Tỉnh</option>
                </select>
            </div>
        </div>

        <div class="form-group2">
            <div class="form-group">
                <select id="QuanHuyen" name="QuanHuyen" required onchange="updateWardList(this.value,citycodeGlobal)">
                    <option value="">Quận/Huyện</option>
                </select>
            </div>

            <div class="form-group">
                <select id="PhuongXa" name="PhuongXa" required>
                    <option value="">Phường/Xã</option>
                </select>
            </div>

        </div>
    </div>
    <input style="width:46%;margin-right:65px;" name="soNhaTenDuong" type="text" id="address" placeholder="Số nhà, tên đường">
    <label for="NoiToChuc">Nơi tổ chức</label>
    <input type="text" id="NoiToChuc" required name="NoiToChuc" placeholder="ví dụ: sân vận động Mỹ Đình">

    <label for="ThongTinSuKien">Thông tin sự kiện</label>
    <textarea id="ThongTinSuKien" required name="ThongTinSuKien"></textarea>

    <input id="btnSuKien" type="button" value="Trang sau" onclick=" return check()">
    <input type="hidden" name="action" value="taoSuKien1Click" />
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
<script>
    //kiểm tra thông tin
    function check() {
        //lấy thông tin
        var TenSuKien = document.getElementById('TenSuKien').value;
        var TheLoai = document.getElementById('TheLoai').value;
        var QuocGia = document.getElementById('QuocGia').value;
        var ThanhPho = document.getElementById('ThanhPho').value;
        var QuanHuyen = document.getElementById('QuanHuyen').value;
        var PhuongXa = document.getElementById('PhuongXa').value;
        var NoiToChuc = document.getElementById('NoiToChuc').value;
        var ThongTinSuKien = document.getElementById('ThongTinSuKien').value;
        //hàm kiểm tra
        // console.log(category);
        // console.log(status);
        const chiChuaKhoangTrang = (dc) => {
            const addressRegex = /^\s+$/;

            return addressRegex.test(dc);
        };
        const hopLe = (dc) => {
            const addressRegex = /^[^a-zA-Z0-9]+$/;

            return addressRegex.test(dc);
        };
        //
        if (!TenSuKien) {
            alert("Bạn chưa nhập tên sự kiện!");
            return false;
        }
        if (hopLe(TenSuKien)) {
            alert("Tên sự kiện không hợp lệ!");
            return false;
        }
        if (chiChuaKhoangTrang(TenSuKien)) {
            alert("Tên sự kiện không hợp lệ!");
            return false;
        }
        //
        if (!TheLoai) {
            alert("Bạn chưa chọn thể loại!");
            return false;
        }
        //
        if (!QuocGia) {
            alert("Bạn chưa chọn quốc gia!");
            return false;
        }
        if (!ThanhPho) {
            alert("Bạn chưa chọn thành phố!");
            return false;
        }
        //
        if (!QuanHuyen) {
            alert("Quận huyện không được để trống!");
            return false;
        }
        if (hopLe(QuanHuyen)) {
            alert("Quận huyện không hợp lệ!");
            return false;
        }
        if (chiChuaKhoangTrang(QuanHuyen)) {
            alert("Quận huyện không hợp lệ!");
            return false;
        }
        //
        if (!PhuongXa) {
            alert("Phường xã không được để trống!");
            return false;
        }
        if (hopLe(PhuongXa)) {
            alert("Phường xã không hợp lệ!");
            return false;
        }
        if (chiChuaKhoangTrang(PhuongXa)) {
            alert("Phường xã không hợp lệ!");
            return false;
        }
        //
        if (!NoiToChuc) {
            alert("Bạn chưa nhập nơi tổ chức!");
            return false;
        }
        if (hopLe(NoiToChuc)) {
            alert("Nơi tổ chức không hợp lệ!");
            return false;
        }
        if (chiChuaKhoangTrang(NoiToChuc)) {
            alert("Nơi tổ chức không hợp lệ!");
            return false;
        }
        //
        if (!ThongTinSuKien) {
            alert("Bạn chưa nhập thông tin sự kiện!");
            return false;
        }
        if (hopLe(ThongTinSuKien)) {
            alert("Thông tin sự kiện không hợp lệ!");
            return false;
        }
        if (chiChuaKhoangTrang(ThongTinSuKien)) {
            alert("Thông tin sự kiện không hợp lệ!");
            return false;
        }
        document.getElementById('taoSuKien1').submit();
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