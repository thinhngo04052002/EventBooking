<?php
$link = '#'; // Mặc định nếu không có vai trò nào khớp

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'ADDVSK') {
        $link = 'index?action=thongTinDoanhNghiep';
    } elseif ($_SESSION['role'] == 'ADNT') {
        $link = 'index?action=userProfile';
    }
}
?>
<div class="header">
  <div class="nameShop"><a href="#">Ticketshop</a></div>
  <!-- <div class="search">
    <input placeholder="search" class="searchInput" type="text" value="" name="type">
  </div> -->
  <div class="dropdown">
    <button class="dropbtn"><?php echo $_SESSION['username'] ?></button>
    <div class="dropdown-content">
      <a href="<?php echo $link;?>">Thông tin cá nhân</a>
      <a href="#">Đổi mật khẩu</a>
      <a href="index.php?action=logout">Đăng xuất</a>
    </div>
  </div>
</div>
</div>