<?php
$dataKhuyenMai; ?>
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
    var iDLoaiVe = 1;
</script>

<style>
    .btn {
        padding: 10px 20px;
        cursor: pointer;
        border: none;
        margin: 5px;
        border-radius: 10px;
    }

    .btn.gray {
        background-color: #ccc;
    }

    .btn.blue {
        background-color: #3498db;
    }

    .btn.red {
        background-color: #dc3545;
        color: white;
    }

    .btn.green {
        background-color: #28a745;
        color: white;
    }

    /* suất diễn */
    .section-container {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 20px;
    }

    .section-title {
        margin-top: 0;
    }

    .datetime-picker {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .agenda-item,
    .ticket-item,
    .staff-item {
        margin-bottom: 10px;
    }

    label {
        display: block;
        margin-top: 5px;
    }

    input,
    select,
    textarea {
        width: 100%;
        margin-bottom: 5px;
    }
</style>
<h1>Tạo sự kiện</h1>

<form class="form-container" style="padding: 20px 20px 59px 20px  ;" action="index.php" method="post" enctype="multipart/form-data">
    <div class="section-container">
        <h2 class="section-title">Thông tin sự kiện</h2>
        <div class="section-content">

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
            <div class="form-group1">
                <div class="form-group2">
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
            <label for="loiCamOn">Tin nhắn xác nhận đến người tham gia sau khi đặt vé thành công</label>
            <textarea id="loiCamOn" required name="loiCamOn"></textarea>
        </div>
    </div>

    <div class="section-container">
        <h2 class="section-title">Suất diễn và loại vé</h2>
        <div class="section-content">
            <div class="suatdien-container">
                <div class="datetime-picker">
                    <div>
                        <label>Thời gian bắt đầu chương trình</label>
                        <input type="date" name="date_bd" required>
                        <input type="time" name="time_bd" required>
                    </div>
                    <div>
                        <label>Thời gian kết thúc chương trình</label>
                        <input type="date" name="date_kt" required>
                        <input type="time" name="time_kt" required>
                    </div>
                </div>

                <div class="agenda">
                    <label>Agenda</label>
                    <div id="agenda-container">
                        <div class="agenda-item">
                            <input type="text" name="agenda_time" placeholder="Thời gian">
                            <input type="text" name="agenda_activity" placeholder="Hoạt động">
                            <button class="btn red" onclick="removeAgendaItem(this)">Xóa</button>
                        </div>
                    </div>
                    <div>
                        <button class="btn gray" onclick="addAgendaItem()">Thêm lịch trình</button>
                        <input type="hidden" name="agendaList" id="agendaList" value="">
                    </div>
                </div>

                <div class="ticket-type">
                    <label>Loại vé</label>
                    <div id="ticket-container">
                        <div class="ticket-item">
                            <label>Tên loại vé</label>
                            <input type="text" required name="tenLoaiVe" id="tenLoaiVe">
                            <label>Mô tả</label>
                            <textarea id="moTa" required name="moTa"></textarea>
                            <label>Giá vé</label>
                            <input type="text" required name="giaVe" id="giaVe"> VND
                            <label>Số lượng</label>
                            <input type="number" required name="soLuong" id="soLuong"> vé
                            <label>Số lượng vé tối đa trong một đơn hàng</label>
                            <input type="number" required name="soVeToiDaTrongMotDonHang" id="soVeToiDaTrongMotDonHang"> vé
                            <label>Thời gian bắt đầu bán vé</label>
                            <input type="date" required name="time_bd_banve" id="time_bd_banve">
                            <input type="time" required name="date_bd_banve" id="date_bd_banve">
                            <label>Thời gian kết thúc bán vé</label>
                            <input type="date" required name="time_kt_banve" id="time_kt_banve">
                            <input type="time" required name="date_kt_banve" id="date_kt_banve">
                            <button class="btn red" onclick="removeTicketItem(this)">Xóa</button>
                        </div>
                        <div>
                            <button class="btn gray" onclick="addTicketItem()">Thêm loại vé</button>
                            <input type="hidden" name="loaiVeList" id="loaiVeList" value="">
                        </div>
                    </div>
                </div>

                <div class="participants">
                    <label>Người tham gia</label>
                    <input type="text" id="nguoiThamGia" name="nguoiThamGia" placeholder="Ví dụ: JiSoo, Lisa, Rose, Jenney">
                </div>

                <div class="staff">
                    <label>Nhân sự</label>
                    <div class="staff-container">
                        <div class="staff-item">
                            <label>Họ và Tên</label>
                            <input type="text" required value="" id="ten" name="ten" placeholder="Ví dụ: Nguyễn Văn A">
                            <label>Vai trò</label>
                            <select id="vaiTro" required name="vaiTro">
                                <option value="Chủ sự kiện">Chủ sự kiện</option>
                                <option value="Quản trị viên">Quản trị viên</option>
                                <option value="Quản lý">Quản lý</option>
                                <option value="Nhân viên">Nhân viên</option>
                            </select>
                            <label>Email</label>
                            <input type="email" required id="email" name="email" value="" placeholder="Ví dụ: nguyenvan1@gmail.com">
                            <label>Số điện thoại</label>
                            <input type="tel" required value="" id="soDienThoai" name="soDienThoai" placeholder="Ví dụ: 0123456789">
                            <button class="btn red" onclick="removeNhanSuItem(this)">Xóa</button>
                        </div>
                        <div>
                            <button class="btn gray" onclick="addNhanSuItem()">Thêm nhân sự</button>
                            <input type="hidden" name="NhanSuList" id="NhanSuList" value="">
                        </div>
                    </div>

                </div>
            </div>
            <input type="hidden" name="SuatDienList" id="SuatDienList" value="">
        </div>
    </div>

    <div class="section-container">
        <h2 class="section-title">Sơ đồ ghế</h2>
        <div class="section-content">
            <div class="upload-container">
                <input name="anhSoDoGhe" type="file" id="anhSoDoGhe" style="display:none;" accept="image/*" />
                <div class="upload-box" style="width: 1280px; height: 1000px;" id="uploadBox-soDoGhe">
                    <img src="css/images/image_icon.png" alt="Icon" class="upload-icon" id="uploadIcon">
                    <p id="uploadText">Thêm ảnh sơ đồ ghế</p>
                    <p>(1280x1000)</p>
                </div>
                <p id="errorMessage" class="error-message"></p>
            </div>
        </div>
    </div>

    <div class="section-container">
        <h2 class="section-title">Áp dụng khuyến mãi</h2>
        <div class="section-content">
            <table>
                <tr>
                    <td><input type='checkbox' name="khuyenMaiCheck" onclick='checkKhuyenMai()' value="<?php echo $dataKhuyenMai['id']; ?>" /></td>
                    <td><?php echo $dataKhuyenMai["makhuyenmai"] ?><?php echo " - chiết khấu " ?><?php echo $dataKhuyenMai["chietkhau"] ?></td>

                </tr>
            </table>
            <input type="hidden" name="khuyenMaiList" id="selectKhuyenMaiID" value="">
        </div>
    </div>

    <div class="section-container">
        <h2 class="section-title">Thông tin thanh toán</h2>
        <div class="section-content">
            <h3>Sau khi sự kiện kết thúc, trong vòng 7 ngày ticketshop sẽ gởi bạn tiền bán vé. <br>
                Tiền hoa hồng của chúng tôi là 20% tổng số tiền vé gốc. <br>
                Nếu bạn muốn nhận tiền sớm hơn hãy liên hệ chúng tôi qua số điện thoại 0123456789</h3>
            <label for="soTaiKhoan">Số tài khoản</label>
            <input type="text" id="soTaiKhoan" name="soTaiKhoan">

            <label for="chuTaiKhoan">Chủ tài khoản</label>
            <input type="text" id="chuTaiKhoan" name="chuTaiKhoan" placeholder="viết hoa không dấu">

            <label for="tenNganHang">Tên ngân hàng</label>
            <input type="text" id="tenNganHang" name="tenNganHang">

            <label for="tenChiNhanh">Tên chi nhánh</label>
            <input type="text" id="tenChiNhanh" name="tenChiNhanh">
        </div>
    </div>
    <div class="submitbtnform">
        <input id="btnSuKien" type="button" value="Tạo sự kiện" onclick=" return check()">
        <input type="hidden" name="action" value="taoSuKienClick" />
    </div>
</form>




<script>
    // Lấy danh sách các phần tử tiêu đề để thêm sự kiện click
    const sectionTitles = document.querySelectorAll('.section-title');

    sectionTitles.forEach(title => {
        title.addEventListener('click', () => {
            const content = title.nextElementSibling; // Lấy phần nội dung kế tiếp của tiêu đề
            content.classList.toggle('active'); // Thêm hoặc xóa lớp active để mở rộng/gấp
        });
    });
</script>

<!-- xử lý section 1 -->
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

<!-- xử lý ảnh section sơ đồ ghế -->
<script>
    document.getElementById('uploadBox-soDoGhe').addEventListener('click', function() {
        document.getElementById('anhSoDoGhe').click();
    });

    document.getElementById('anhSoDoGhe').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const img = new Image();
            img.onload = function() {
                if (img.width === 1280 && img.height === 1000) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const uploadBox = document.getElementById('uploadBox-soDoGhe');
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
                    errorMessage.textContent = 'Kích thước ảnh không đúng. Vui lòng chọn ảnh có kích thước 1280x1000.';
                    document.getElementById('anhSoDoGhe').value = ''; // Clear the file input
                }
            };
            img.src = URL.createObjectURL(file);
        }
    });
</script>
<!-- hàm kiểm tra trước khi gởi đi -->
<script>
    //kiểm tra thông tin
    function check() {
        //lưu thông tin suất diễn
        saveAgendaItem();
        saveTicketItem();
        saveNhanSuItem();

        //lấy thông tin section 1
        var TenSuKien = document.getElementById('TenSuKien').value;
        var TheLoai = document.getElementById('TheLoai').value;
        var QuocGia = document.getElementById('QuocGia').value;
        var ThanhPho = document.getElementById('ThanhPho').value;
        var QuanHuyen = document.getElementById('QuanHuyen').value;
        var PhuongXa = document.getElementById('PhuongXa').value;
        var NoiToChuc = document.getElementById('NoiToChuc').value;
        var ThongTinSuKien = document.getElementById('ThongTinSuKien').value;
        // var AnhNenSuKien = document.getElementById('AnhNenSuKien').value;

        //lấy thông tin section 2
        var date_bd = document.getElementById('date_bd').value;
        var time_bd = document.getElementById('time_bd').value;
        var date_kt = document.getElementById('date_kt').value;
        var time_kt = document.getElementById('time_kt').value;
        var agendaList = document.getElementById('agendaList').value;
        var loaiVeList = document.getElementById('loaiVeList').value;
        var nguoiThamGia = document.getElementById('nguoiThamGia').value;
        var NhanSuList = document.getElementById('NhanSuList').value;


        //lấy thông tin section 3

        //lấy thông tin section 4

        //lấy thông tin section 5
        if (!agendaList) {
            alert("Không thể bỏ trống lịch trình!");
            return false;
        }
        if (!loaiVeList) {
            alert("Ít nhất phải có một loại vé!");
            return false;
        }
        if (!nguoiThamGia) {
            alert("Người tham gia không được bỏ trống!");
            return false;
        }
        if (!SuatDienList) {
            alert("Bạn chưa điền thông tin suất diễn!");
            return false;
        }
        if (date_bd == "") {
            alert("Bạn chưa nhập ngày bắt đầu!");
            return false;
        }
        if (date_kt == "") {
            alert("Bạn chưa nhập ngày bắt đầu!");
            return false;
        }
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
<!-- hàm lấy thông tin hành chính địa lý -->
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

<!-- hàm lấy thông tin khuyến mãi -->
<script>
    function checkKhuyenMai() {
        var list = "";
        var checkboxes = document.getElementsByName('khuyenMaiCheck');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                list = list + checkboxes[i].value + ',';
            }
        }
        var newList = "";
        newList = list.slice(0, -1);
        // console.log(newList);
        document.getElementById('selectKhuyenMaiID').value = newList;
        console.log("selectKhuyenMaiID " + newList);
    }
</script>
<!-- agenda -->
<script>
    function addAgendaItem() {
        const agendaContainer = document.getElementById('agenda-container');
        const newAgendaItem = document.createElement('div');
        newAgendaItem.className = 'agenda-item';
        newAgendaItem.innerHTML = `
                <input type="text" name="agenda_time" placeholder="Thời gian">
                <input type="text" name="agenda_activity" placeholder="Hoạt động">
                <button class="btn red" onclick="removeAgendaItem(this)">Xóa</button>
            `;
        agendaContainer.appendChild(newAgendaItem);
    }

    function removeAgendaItem(button) {
        const agendaItem = button.parentNode;
        agendaItem.parentNode.removeChild(agendaItem);
    }

    function saveAgendaItem() {
        const agendaItems = document.querySelectorAll('.agenda-item');
        const agendaList = [];

        agendaItems.forEach(item => {
            const time = item.querySelector('input[name="agenda_time"]').value;
            const activity = item.querySelector('input[name="agenda_activity"]').value;
            if (time && activity) {
                agendaList.push({
                    time,
                    activity
                });
            }
        });

        document.getElementById('agendaList').value = JSON.stringify(agendaList);
        console.log('Saved Agenda List:', agendaList);
        // alert('Đã lưu lịch trình!');
    }
</script>
<!-- loại vé -->
<script>
    function addTicketItem() {
        const ticketContainer = document.getElementById('ticket-container');
        const newTicketItem = document.createElement('div');
        newTicketItem.className = 'ticket-item';
        newTicketItem.innerHTML = `
                <label>Tên loại vé</label>
                <input type="text" required name="tenLoaiVe" placeholder="Tên loại vé">
                <label>Mô tả</label>
                <textarea required name="moTa" placeholder="Mô tả"></textarea>
                <label>Giá vé</label>
                <input type="text" required name="giaVe" placeholder="Giá vé"> VND
                <label>Số lượng</label>
                <input type="number" required name="soLuong" placeholder="Số lượng"> vé
                <label>Số lượng vé tối đa trong một đơn hàng</label>
                <input type="number" required name="soVeToiDaTrongMotDonHang" placeholder="Số lượng vé tối đa trong một đơn hàng"> vé
                <label>Thời gian bắt đầu bán vé</label>
                <input type="date" required name="time_bd_banve">
                <input type="time" required name="date_bd_banve">
                <label>Thời gian kết thúc bán vé</label>
                <input type="date" required name="time_kt_banve">
                <input type="time" required name="date_kt_banve">
                <button class="btn red" onclick="removeTicketItem(this)">Xóa</button>
            `;
        ticketContainer.appendChild(newTicketItem);
    }

    function removeTicketItem(button) {
        const ticketItem = button.parentNode;
        ticketItem.parentNode.removeChild(ticketItem);
    }

    function saveTicketItem() {
        const ticketItems = document.querySelectorAll('.ticket-item');
        const loaiVeList = [];

        ticketItems.forEach(item => {
            const tenLoaiVe = item.querySelector('input[name="tenLoaiVe"]').value;
            const moTa = item.querySelector('textarea[name="moTa"]').value;
            const giaVe = item.querySelector('input[name="giaVe"]').value;
            const soLuong = item.querySelector('input[name="soLuong"]').value;
            const soVeToiDaTrongMotDonHang = item.querySelector('input[name="soVeToiDaTrongMotDonHang"]').value;
            const time_bd_banve = item.querySelector('input[name="time_bd_banve"]').value;
            const date_bd_banve = item.querySelector('input[name="date_bd_banve"]').value;
            const time_kt_banve = item.querySelector('input[name="time_kt_banve"]').value;
            const date_kt_banve = item.querySelector('input[name="date_kt_banve"]').value;

            if (tenLoaiVe && moTa && giaVe && soLuong && soVeToiDaTrongMotDonHang && time_bd_banve && date_bd_banve && time_kt_banve && date_kt_banve) {
                loaiVeList.push({
                    iDLoaiVe,
                    tenLoaiVe,
                    moTa,
                    giaVe,
                    soLuong,
                    soVeToiDaTrongMotDonHang,
                    time_bd_banve,
                    date_bd_banve,
                    time_kt_banve,
                    date_kt_banve
                });
            }
        });
        iDLoaiVe = 2;
        document.getElementById('loaiVeList').value = JSON.stringify(loaiVeList);
        console.log('Saved Ticket List:', loaiVeList);
        // alert('Đã lưu loại vé!');
    }
</script>
<!-- nhân sự -->
<script>
    function addNhanSuItem() {
        const staffContainer = document.getElementById('staff-container');
        const newStaffItem = document.createElement('div');
        newStaffItem.className = 'staff-item';
        newStaffItem.innerHTML = `
                <label>Họ và Tên</label>
                <input type="text" required name="ten" placeholder="Ví dụ: Nguyễn Văn A">
                <label>Vai trò</label>
                <select required name="vaiTro">
                    <option value="Chủ sự kiện">Chủ sự kiện</option>
                    <option value="Quản trị viên">Quản trị viên</option>
                    <option value="Quản lý">Quản lý</option>
                    <option value="Nhân viên">Nhân viên</option>
                </select>
                <label>Email</label>
                <input type="email" required name="email" placeholder="Ví dụ: nguyenvan1@gmail.com">
                <label>Số điện thoại</label>
                <input type="tel" required name="soDienThoai" placeholder="Ví dụ: 0123456789">
                <button class="btn red" onclick="removeNhanSuItem(this)">Xóa</button>
            `;
        staffContainer.appendChild(newStaffItem);
    }

    function removeNhanSuItem(button) {
        const staffItem = button.parentNode;
        staffItem.parentNode.removeChild(staffItem);
    }

    function saveNhanSuItem() {
        const staffItems = document.querySelectorAll('.staff-item');
        const NhanSuList = [];

        staffItems.forEach(item => {
            const ten = item.querySelector('input[name="ten"]').value;
            const vaiTro = item.querySelector('select[name="vaiTro"]').value;
            const email = item.querySelector('input[name="email"]').value;
            const soDienThoai = item.querySelector('input[name="soDienThoai"]').value;

            if (ten && vaiTro && email && soDienThoai) {
                NhanSuList.push({
                    ten,
                    vaiTro,
                    email,
                    soDienThoai
                });
            }
        });

        document.getElementById('NhanSuList').value = JSON.stringify(NhanSuList);
        console.log('Saved Staff List:', NhanSuList);
        alert('Đã lưu nhân sự!');
    }
</script>
<!-- hàm ngăn load lại trang -->
<script>
    document.querySelector('.btn.green').addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của nút
        // addSuatDienItem();
        addNhanSuItem();
        addTicketItem();
        addAgendaItem();
    });
    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('btn.red')) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của nút
            // removeSuatDienItem(event.target);
            removeNhanSuItem(event.target);
            removeTicketItem(event.target);
            removeAgendaItem(event.target);
        }
    });
    document.querySelector('.btn.blue').addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của nút
        // saveSuatDienItem();
        saveAgendaItem();
        saveTicketItem();
        saveNhanSuItem();
    });
</script>