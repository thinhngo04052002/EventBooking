<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let agendaItems = [];
    let ticketList = [];
    let staffMembers = [];
    var events = [];
</script>
<style>
    #form-load {
        padding: 20px;
        max-width: 1000px;
        margin: 0 auto;
    }

    .event-form h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .datetime-picker,
    .agenda,
    .ticket-type,
    .participants,
    .staff,
    .submit-section {
        border: 1px solid #ccc;
        padding: 20px;
        margin-bottom: 20px;
    }

    .datetime-picker div,
    .ticket-type .ticket,
    .staff .staff-member {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }

    .datetime-picker label,
    .agenda label,
    .ticket-type label,
    .staff label,
    .participants label {
        flex: 1 1 100%;
        margin-bottom: 10px;
    }

    .datetime-picker input,
    .agenda input,
    .ticket-type input,
    .ticket-type textarea,
    .staff input,
    .staff select,
    .participants input {
        flex: 1 1 100%;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
    }

    .ticket-type textarea {
        resize: none;
    }

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

    .btn.red {
        background-color: #dc3545;
        color: white;
    }

    .btn.green {
        background-color: #28a745;
        color: white;
    }
</style>
<h1>Suất diễn & loại vé</h1>
<form id="form-load" action="index.php" method="post">
    <section class="event-form">

        <div class="datetime-picker">
            <div>
                <label>Thời gian bắt đầu chương trình</label>
                <input type="date" name="date_bd">
                <input type="time" name="time_bd">
            </div>
            <div>
                <label>Thời gian kết thúc chương trình</label>
                <input type="date" name="date_kt">
                <input type="time" name="time_kt">
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
            <button class="btn gray" onclick="addAgendaItem()">Thêm lịch trình</button>
        </div>

        <div class="ticket-type">
            <h2>Loại vé</h2>
            <div id="ticket-container">
                <div class="ticket">
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
            </div>
            <button class="btn blue" onclick="saveTicketItem()">Thêm loại vé</button>
            <button class="btn gray" onclick="addTicketItem()">Thêm loại vé</button>
        </div>

        <div class="participants">
            <label>Người tham gia</label>
            <input type="text" placeholder="Ví dụ: JiSoo, Lisa, Rose, Jenney">
        </div>

        <div class="staff">
            <label>Nhân sự</label>
            <div class="staff-member">
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
                    <button class="btn blue" onclick="saveNhanSuItem()">Lưu</button>
                    <input type="hidden" name="NhanSuList" id="NhanSuList" value="">
                </div>
            </div>
        </div>
    </section>
    <div class="truoc-sau">
        <div class="sau">
            <input id="btnSuKien" type="button" value="Trang sau" onclick=" return check()">
            <input type="hidden" name="action" value="taoSuKien2Click" />
        </div>
        <div class="truoc">
            <input id="btnSuKien" type="button" value="Trang trước" onclick=" return check()">
            <input type="hidden" name="action" value="taoSuKien1" />
        </div>
    </div>
</form>
<!-- Add jQuery library -->


<script>
    // Function to add a new event section
    function addEventSection() {
        var newSection = $('.event-form').clone(); // Clone the event form section
        newSection.find('input, textarea').val(''); // Clear input values if needed
        $('.event-form').append(newSection); // Append cloned section to the form
    }

    // Function to remove an event section
    function removeEventSection(button) {
        $(button).closest('.event-form').remove(); // Remove the closest event section
    }
</script>
<script>
    function collectAgendaItems(eventForm) {
        var agendaItems = [];
        $(eventForm).find('.agenda-item').each(function() {
            var agendaTime = $(this).find('input[name="agenda_time"]').val();
            var agendaActivity = $(this).find('input[name="agenda_activity"]').val();
            agendaItems.push({
                time: agendaTime,
                activity: agendaActivity
            });
        });
        return agendaItems;
    }

    function addEventSection(eventForm) {
        // Lấy thông tin từ form sự kiện được truyền vào
        var startTime = $(eventForm).find('.datetime-picker input[type="date"]:first').val() + ' ' + $(eventForm).find('.datetime-picker input[type="time"]:first').val();
        var endTime = $(eventForm).find('.datetime-picker input[type="date"]:last').val() + ' ' + $(eventForm).find('.datetime-picker input[type="time"]:last').val();
        var agendaItems = collectAgendaItems(eventForm);

        // Kiểm tra nếu có lỗi trong agenda items (nếu cần)
        if (agendaItems === null) {
            console.log('Có lỗi trong agenda items, không thể thêm sự kiện mới.');
            return; // Hoặc thực hiện xử lý lỗi khác
        }

        // Tạo đối tượng newEvent từ các thông tin lấy được
        var newEvent = {
            startTime: startTime,
            endTime: endTime,
            agenda: agendaItems, // Các agenda items từ collectAgendaItems()
            // Các thông tin khác của sự kiện có thể lấy từ form
        };

        // Thêm newEvent vào mảng events (ví dụ)
        events.push(newEvent);

        // Sau khi thêm sự kiện, có thể làm sạch form hoặc các xử lý khác
        clearFormFields(eventForm); // Ví dụ: clearFormFields là hàm để làm sạch form
    }
</script>