<script>
    let agendaItems = [];
    let ticketList = [];
    let staffMembers = [];
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
<form id="form-load" action="index.php" method="post">
    <section class="event-form">
        <h1>Suất diễn & loại vé</h1>
        <div class="datetime-picker">
            <div>
                <label>Thời gian bắt đầu chương trình</label>
                <input type="date">
                <input type="time">
            </div>
            <div>
                <label>Thời gian kết thúc chương trình</label>
                <input type="date">
                <input type="time">
            </div>
        </div>

        <div class="agenda">
            <label>Agenda</label>
            <div id="agenda-container">
                <div class="agenda-item">
                    <input type="text" placeholder="Thời gian">
                    <input type="text" placeholder="Hoạt động">
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
                    <input type="text">
                    <label>Mô tả</label>
                    <textarea></textarea>
                    <label>Giá vé</label>
                    <input type="text">
                    <label>VND</label>
                    <label>Số lượng</label>
                    <input type="number"> vé
                    <label>Số lượng vé tối đa trong một đơn hàng</label>
                    <input type="number"> vé
                    <label>Thời gian bắt đầu bán vé</label>
                    <input type="date">
                    <input type="time">
                    <label>Thời gian kết thúc bán vé</label>
                    <input type="date">
                    <input type="time">
                    <button class="btn red" onclick="removeTicketItem(this)">Xóa</button>
                </div>
            </div>
            <button class="btn gray" onclick="addTicketItem()">Thêm loại vé</button>
        </div>

        <div class="participants">
            <label>Người tham gia</label>
            <input type="text" placeholder="Ví dụ: JiSoo, Lisa, Rose, Jenney">
        </div>

        <div class="staff">
            <h2>Nhân sự</h2>
            <div class="staff-member">
                <label>Họ và Tên</label>
                <input type="text" value="" placeholder="Ví dụ: Nguyễn Văn A">
                <label>Vai trò</label>
                <select>
                    <option value="Chủ sự kiện">Chủ sự kiện</option>
                    <option value="Quản trị viên">Quản trị viên</option>
                    <option value="Quản lý">Quản lý</option>
                    <option value="Nhân viên">Nhân viên</option>
                </select>
                <label>Email</label>
                <input type="email" value="" placeholder="Ví dụ: nguyenvan1@gmail.com">
                <label>Số điện thoại</label>
                <input type="tel" value="" placeholder="Ví dụ: 0123456789">
                <button class="btn red">Xóa</button>
            </div>
            <button class="btn gray">Thêm nhân sự</button>
        </div>

        <div class="submit-section">
            <button class="btn green">+ Thêm suất diễn</button>
            <input type="hidden" name="action" value="taoSuKien2Click" />
        </div>
    </section>
</form>
<script>
    function addAgendaItem() {
        // Lấy dữ liệu từ form
        const time = document.getElementById('agenda-time').value;
        const activity = document.getElementById('agenda-activity').value;

        // Tạo đối tượng AJAX
        const xhr = new XMLHttpRequest();

        // Cấu hình yêu cầu AJAX
        xhr.open('POST', 'add-agenda-item.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Xử lý phản hồi từ server
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Cập nhật giao diện mà không load lại trang
                updateAgendaContainer(xhr.responseText);
            }
        };

        // Gửi yêu cầu lên server
        xhr.send('time=' + encodeURIComponent(time) + '&activity=' + encodeURIComponent(activity));
    }

    function updateAgendaContainer(html) {
        // Cập nhật nội dung của #agenda-container
        document.getElementById('agenda-container').innerHTML = html;

        // Gắn lại các event handler cho các nút "Xóa"
        const deleteButtons = document.querySelectorAll('.agenda-item .btn.red');
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', removeAgendaItem);
        });
        agendaItems.push({
            time: timeInput.value,
            activity: activityInput.value
        });
    }

    // function removeAgendaItem(button) {
    //     // Lấy phần tử mục lịch trình
    //     const agendaItem = button.parentNode;

    //     // Tìm vị trí của mục lịch trình trong mảng
    //     const index = Array.from(agendaContainer.children).indexOf(agendaItem);

    //     // Xóa mục lịch trình khỏi mảng
    //     agendaItems.splice(index, 1);

    //     // Xóa phần tử DOM
    //     agendaItem.parentNode.removeChild(agendaItem);
    // }
    function removeAgendaItem(button) {
        // Lấy phần tử mục lịch trình
        const agendaItem = button.parentNode;

        // Tạo một yêu cầu AJAX để xóa mục lịch trình
        const xhr = new XMLHttpRequest();
        xhr.open('DELETE', '/agenda-items/' + agendaItem.dataset.id, true); // Thay '/agenda-items/' bằng đường dẫn API của bạn
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Xóa phần tử DOM
                agendaItem.parentNode.removeChild(agendaItem);

                // Cập nhật mảng agendaItems nếu cần
                const index = Array.from(agendaContainer.children).indexOf(agendaItem);
                agendaItems.splice(index, 1);
            } else {
                // Xử lý lỗi nếu có
                console.error('Error deleting agenda item:', xhr.status, xhr.statusText);
            }
        };

        xhr.send(JSON.stringify({
            id: agendaItem.dataset.id
        })); // Gửi ID của mục lịch trình cần xóa
    }
    //loại vé

    // Hàm thêm mới một loại vé
    function addTicketItem() {
        // Tạo một phần tử div mới để chứa thông tin của loại vé
        const newTicket = document.createElement('div');
        newTicket.classList.add('ticket');

        // Thêm các trường nhập liệu vào phần tử div mới
        newTicket.innerHTML = `
    <label>Tên loại vé</label>
    <input type="text">
    <label>Mô tả</label>
    <textarea></textarea>
    <label>Giá vé</label>
    <input type="text">
    <label>VND</label>
    <label>Số lượng</label>
    <input type="number"> vé
    <label>Số lượng vé tối đa trong một đơn hàng</label>
    <input type="number"> vé
    <label>Thời gian bắt đầu bán vé</label>
    <input type="date">
    <input type="time">
    <label>Thời gian kết thúc bán vé</label>
    <input type="date">
    <input type="time">
    <button class="btn red" onclick="removeTicketItem(this)">Xóa</button>
  `;

        // Thêm phần tử div mới vào container
        const ticketContainer = document.getElementById('ticket-container');
        ticketContainer.appendChild(newTicket);
    }

    // Hàm xóa một loại vé
    function removeTicketItem(button) {
        // Tìm phần tử div chứa nút "Xóa" được nhấn
        const ticketItem = button.closest('.ticket');

        // Xóa phần tử div chứa nút "Xóa" được nhấn
        ticketItem.remove();

        // Cập nhật mảng lưu trữ thông tin các loại vé
        ticketList = ticketList.filter(ticket => ticket !== ticketItem);
    }

    // Hàm lưu thông tin loại vé
    function saveTicketInfo() {
        // Tìm tất cả các phần tử div chứa thông tin loại vé
        const ticketItems = document.querySelectorAll('.ticket');

        // Duyệt qua từng phần tử div và lưu thông tin vào mảng
        ticketList = [];
        ticketItems.forEach(ticket => {
            const ticketInfo = {
                name: ticket.querySelector('input[type="text"]').value,
                description: ticket.querySelector('textarea').value,
                price: ticket.querySelector('input[type="text"]').value,
                quantity: ticket.querySelector('input[type="number"]:nth-of-type(1)').value,
                maxQuantity: ticket.querySelector('input[type="number"]:nth-of-type(2)').value,
                startDate: ticket.querySelector('input[type="date"]').value,
                startTime: ticket.querySelector('input[type="time"]:nth-of-type(1)').value,
                endDate: ticket.querySelector('input[type="date"]:nth-of-type(2)').value,
                endTime: ticket.querySelector('input[type="time"]:nth-of-type(2)').value
            };
            ticketList.push(ticketInfo);
        });

        // Hiển thị mảng lưu trữ thông tin các loại vé
        console.log(ticketList);
    }
    //nhân sự
    function addStaffMember() {
        // Tạo một phần tử div.staff-member mới
        const staffMember = document.createElement('div');
        staffMember.classList.add('staff-member');

        // Thêm nội dung HTML vào div.staff-member
        staffMember.innerHTML = `
    <label>Họ và Tên</label>
    <input type="text" value="" placeholder="Ví dụ: Nguyễn Văn A">
    <label>Vai trò</label>
    <select>
      <option value="Chủ sự kiện">Chủ sự kiện</option>
      <option value="Quản trị viên">Quản trị viên</option>
      <option value="Quản lý">Quản lý</option>
      <option value="Nhân viên">Nhân viên</option>
    </select>
    <label>Email</label>
    <input type="email" value="" placeholder="Ví dụ: nguyenvan1@gmail.com">
    <label>Số điện thoại</label>
    <input type="tel" value="" placeholder="0123456789">
    <button class="btn red" onclick="removeStaffMember(this)">Xóa</button>
  `;

        // Thêm div.staff-member mới vào phần tử cha
        const staffContainer = document.querySelector('.staff');
        staffContainer.appendChild(staffMember);

        // Lưu thông tin nhân sự vào mảng
        const staffInfo = {
            name: staffMember.querySelector('input[type="text"]').value,
            role: staffMember.querySelector('select').value,
            email: staffMember.querySelector('input[type="email"]').value,
            phone: staffMember.querySelector('input[type="tel"]').value
        };
        staffMembers.push(staffInfo);
    }

    // Hàm xóa nhân sự
    function removeStaffMember(button) {
        const staffMember = button.closest('.staff-member');
        const index = Array.from(staffMember.parentNode.children).indexOf(staffMember);

        // Xóa phần tử div.staff-member khỏi DOM
        staffMember.remove();

        // Xóa thông tin nhân sự tương ứng khỏi mảng
        staffMembers.splice(index, 1);
    }

    // Gắn sự kiện click vào nút "Thêm nhân sự"
    document.querySelector('.staff button.gray').addEventListener('click', addStaffMember);
</script>