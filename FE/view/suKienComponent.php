<form action="index.php" method="POST" id="dangNhap">
    <input type="text" name="keyWord" id="inputSearch" onsubmit="return checkKeyword(event)">
    <input id="btnSearch" type="submit" value="Tìm kiếm">
    <input type="hidden" name="pageNum" value="1">
    <input type="hidden" name="action" value="search" />
</form>
<!-- đăng nhập xong nếu chưa nhập thông tin thì quay về màn hình nhập thông tin -->