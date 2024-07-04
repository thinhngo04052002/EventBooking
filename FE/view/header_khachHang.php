<div class="header">
  <div class="nameShop"><a href="#">Ticketshop</a></div>
  <div class="search">
    <input placeholder="search" class="searchInput" type="text" value="" name="type">
  </div>
  <div class="dropdown">
    <button class="dropbtn"><?php echo $_SESSION['username']?></button>
    <div class="dropdown-content">
      <a href="#">Vé đã mua</a>
      <a href="index?action=userProfile">Thông tin cá nhân</a>
      <a href="index.php?action=logout">Đăng xuất</a>
    </div>
  </div>

</div>
</div>