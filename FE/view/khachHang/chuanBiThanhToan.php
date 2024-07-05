<head>
    <title>Thanh toán đơn hàng</title>
    <link rel="stylesheet" type="text/css" href="css\TuyetCSS\chuanBiThanhToan.css">
</head>
<?php
$loaiVe1 = [
    'tenLoaiVe' => 'Vé VIP',
    'giaVe' => 1000000,
    'soLuong' => 1
];
$loaiVe2 = [
    'tenLoaiVe' => 'Vé Khu A',
    'giaVe' => 800000,
    'soLuong' => 2
];
$loaiVeDaChon = array($loaiVe1, $loaiVe2);

// Tính tổng tiền đặt vé
$tongTien = 0;
foreach ($loaiVeDaChon as $veTT) {
    $tongTien += $veTT['soLuong'] * $veTT['giaVe'];
}
?>

<script type="text/javascript" language="javascript">
    function btnApDung() {
        var khuyenmai = document.getElementsByClassName("input-ma-khuyen-mai")[0].value;
        console.log('khuyen mai: ' + khuyenmai);
        if (khuyenmai != null) {
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function () {
                if (this.readyState == 4) { // Đã hoàn thành yêu cầu
                    var chietkhau = this.responseText;
                    if (!isNaN(chietkhau)) {
                        var ck = parseFloat(this.responseText);
                        var tongTien = parseFloat(<?php echo $tongTien ?>);
                        var tienKhuyenMai = tongTien * 0.01 * ck;
                        var thanhTien = tongTien - tienKhuyenMai;
                        if (this.status == 200) { // Thành công
                            document.querySelector('#tong_tien_khuyen_mai .value').textContent = tienKhuyenMai + 'đ';
                            document.querySelector('#thanh_tien .value').textContent = thanhTien + 'đ';

                        } else { // Lỗi
                            document.querySelector('#tong_tien_khuyen_mai .value').textContent = 'Đã xảy ra lỗi.';
                        }
                    }
                }
            }

            // Lấy đường dẫn tương đối của file hiện tại
            var currentPath = window.location.pathname;
            // Tách phần tên file ra khỏi đường dẫn
            var fileName = currentPath.substring(currentPath.lastIndexOf('/') + 1);
            // Lấy đoạn đường dẫn trước index.php
            var pathBeforeIndex = currentPath.substring(0, currentPath.lastIndexOf('/'));
            // Đường dẫn đến file xử lý ajax
            var serverURL = pathBeforeIndex + '/controller/AjaxApDungKhuyenMai.php?makhuyenmai =' + khuyenmai +
                '&idsuKien=' + <?php echo $sukien['idsuKien'] ?> + '&iddoiTac=' + <?php echo $sukien['iddoiTac'] ?>;
            console.log('url: ' + serverURL);

            xmlHttp.open("get", serverURL, true);

            xmlHttp.send(null);
        }
    }
</script>
<?php
// Tạo chuỗi random cho orderId
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$orderId = generateRandomString();

?>
<div class="event-info">
    <h2><?php echo $sukien['tenSuKien']; ?></h2>
    <p><i class="fa fa-map-marker"></i> <?php echo $sukien['diaChi']; ?></p>
    <p><i class="fa fa-calendar"></i> <?php echo $sukien['thoiGianBatDau']; ?> -
        <?php echo $sukien['thoiGianKetThuc']; ?>
    </p>
</div>
<div class="primary-container">
    <h1>Thanh toán</h1>
    <table>
        <tr>
            <td>
                <div class="payment-form">
                    <form>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email"
                                placeholder="Vui lòng nhập email nhận thông tin thẻ" require>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại:</label>
                            <input type="text" id="phone" name="phone" value="0334445556" readonly>
                        </div>
                        <div class="form-group" id="pttt">
                            <label>Phương thức thanh toán:</label>
                            <div class="payment-methods">
                                <label>
                                    Ví MoMo
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </td>
            <td>
                <div class="order-details">
                    <div class="section">
                        <h3>Thông tin đặt vé</h3>
                        <?php foreach ($loaiVeDaChon as $veTT): ?>
                            <div class="detail">
                                <span class="label">Loại vé:</span>
                                <span class="value"><?php echo $veTT['tenLoaiVe']; ?></span>
                            </div>
                            <div class="detail">
                                <span class="label">Số lượng:</span>
                                <span class="value"><?php echo $veTT['soLuong']; ?></span>
                            </div>
                        <?php endforeach; ?>
                        <div class="ma-khuyen-mai">
                            <input type="text" placeholder="Nhập mã khuyến mãi" class="input-ma-khuyen-mai">
                            <button class="btn-ap-dung" onclick='btnApDung();'>Áp dụng</button>
                        </div>
                        <h3>Thông tin đơn hàng</h3>
                        <div class="detail">
                            <span class="label">Tổng tiền đặt vé:</span>
                            <span class="value"><?php echo $tongTien . 'đ'; ?></span>
                        </div>
                        <div class="detail" id="tong_tien_khuyen_mai">
                            <span class="label">Tổng tiền khuyến mãi:</span>
                            <span class="value"></span>
                        </div>
                        <hr>
                        <div class="detail" id="thanh_tien">
                            <span class="label">Thành tiền:</span>
                            <span class="value"><?php echo $tongTien . 'đ'; ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-actions" method="GET" action="index.php">
                    <input type="hidden" name="action" value="goiAPIThanhToan" />
                    <button type="submit" class="btn btn-primary">Thanh toán</button>
                    <input type="hidden" name="orderId" value="<?php echo $orderId; ?>" />
                    <input type="hidden" name="orderinfo" value="mua vé xem sự kiện" />
                    <input type="hidden" name="thanhTien" value="1980000" />
                    <input type="hidden" name="makhuyenmai" value="km111" />
                    <input type="hidden" name="idtaikhoan" value="<?php echo $_SESSION['id'] ?>" />
                    <input type="hidden" name="danhSachVe" value="[]" />
                </div>
            </td>
        </tr>
    </table>
</div>