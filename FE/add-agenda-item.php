<?php
// Lấy dữ liệu từ yêu cầu AJAX
$time = $_POST['time'];
$activity = $_POST['activity'];

// Lưu trữ dữ liệu vào cơ sở dữ liệu hoặc xử lý theo cách khác
// ...

// Tạo mã HTML mới để cập nhật giao diện
$new_item_html = '<div class="agenda-item">
  <input type="text" placeholder="Thời gian" value="' . $time . '">
  <input type="text" placeholder="Hoạt động" value="' . $activity . '">
  <button class="btn red" onclick="removeAgendaItem(this)">Xóa</button>
</div>';

// Trả về mã HTML mới
// echo $new_item_html;