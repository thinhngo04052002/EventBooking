<?php
session_start(); // Bắt đầu session
$answer;
?>
<?php
if (isset($answer) && ($answer !== "")) {
    print_r($answer);
}
?>
<div class="form-container">
    <div class="filterForm">
        <form action="index.php" method="GET" id="filterSuKienCuaKH">
            <select id="selectFilter" name="keyWord">
                <option value="">--chọn--</option>
                <option value="allTask">Tất cả</option>
                <option value="nearingDeadline">Đã đánh giá</option>
                <option value="finishedTask">Chưa đánh giá</option>
                <input id="btnFilter" type="submit" value="Lọc">
                <input type="hidden" name="action" value="filterSuKienCuaKH" />
            </select>
        </form>
    </div>
</div>